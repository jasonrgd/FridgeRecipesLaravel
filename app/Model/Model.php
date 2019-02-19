<?php


namespace App\Model;

use App\Library\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

abstract class Model implements ModelInterface
{
    protected $fileName;

    public function get($name = '*')
    {
        if ($name == '*') {
            return $this->all();
        }

        $all = $this->all();
        $found = new static();
        $all->map(function ($item) use ($name, &$found) {
            if ($item->getTitle() == $name) {
                $found = $item;
            }
        });

        return $found;
    }

    public function all()
    {
        return (new Collection($this->query()[$this->fileName]))->map(function ($item) {
            $model = new static();
            $model->fill($item);
            return $model;
        });
    }

    public function getValid()
    {
        $all = $this->all();
        $items = $all->reject(function ($item) {
            if (!$item->isUsable()) {
                return $item;
            }
        });

        return $items->sort(function ($a, $b) {
            if ($a->getCookedByDate() == $b->getCookedByDate()) {
                return 0;
            }

            return $a->getCookedByDate() < $b->getCookedByDate() ? 1 : -1;
        });
    }

    public function query()
    {
        $path = $this->getFilePath();
        $builder = new Builder($path);
        return $builder->load();
    }

    public function getFilePath()
    {

        $path = config('jsonstore.path') . '/' . $this->fileName . '.json';

        if ($path == '' || !Storage::exists($path)) {
            throw new FileNotFoundException($path);
        }

        return Storage::disk('local')->path($path);
    }

    abstract function fill($item);

    abstract function isUsable();
}
