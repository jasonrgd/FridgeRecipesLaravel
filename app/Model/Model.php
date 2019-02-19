<?php


namespace App\Model;

use App\Library\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

/**
 * Class Model
 * @package App\Model
 */
abstract class Model implements ModelInterface
{
    /**
     * @var string
     */
    protected $fileName;

    /**
     * @param string $name
     * @return Model
     */
    public function get($name = '*'): Model
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

    /**
     * @return Collection
     * @throws FileNotFoundException
     */
    public function all(): Collection
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

    /**
     * @return array
     * @throws FileNotFoundException
     */
    public function query()
    {
        $path = $this->getFilePath();
        $builder = new Builder($path);
        return $builder->load();
    }

    /**
     * @return string
     * @throws FileNotFoundException
     */
    public function getFilePath(): string
    {

        $path = config('jsonstore.path') . '/' . $this->fileName . '.json';

        if ($path == '' || !Storage::exists($path)) {
            throw new FileNotFoundException($path);
        }

        return Storage::disk('local')->path($path);
    }

    /**
     * @param $item
     * @return mixed
     */
    abstract function fill($item);

    /**
     * @return bool
     */
    abstract function isUsable(): bool;
}
