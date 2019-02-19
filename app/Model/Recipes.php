<?php


namespace App\Model;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class Recipes extends Model
{
    protected $fileName = 'recipes';

    private $cookedByDate;
    private $title;
    private $ingredients;

    public function fill($item)
    {
        $this->title = $item['title'];
        $this->ingredients = array();
        foreach ($item['ingredients'] as $ingredient) {
            $item = new Ingredients();
            $item = $item->get($ingredient);

            $this->setCookedByDate($item->getBestBefore());
            $this->ingredients[] = $item;
        }
    }

    /**
     * @return bool
     */
    public function isUsable(): bool
    {
        $isUsable = true;
        Collection::make($this->ingredients)->map(function ($item) use (&$isUsable) {
            if (!$item->isUsable()) {
                $isUsable = false;
            }
        });

        return $isUsable;
    }

    /**
     * @param $date
     */
    public function setCookedByDate($date)
    {
        $cookedByDate = Carbon::parse($date);

        if ($this->cookedByDate == null || $this->cookedByDate > $cookedByDate) {
            $this->cookedByDate = $cookedByDate;
        }
    }

    public function getCookedByDate(): Carbon
    {
        return $this->cookedByDate;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */

    public function getIngredients()
    {
        return Collection::make($this->ingredients)->map(function ($item) {
            return $item->toArray();
        })->toArray();
    }
}
