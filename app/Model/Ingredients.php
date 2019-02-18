<?php


namespace App\Model;


use Carbon\Carbon;

class Ingredients extends Model
{
    protected $fileName = 'ingredients';

    private $title;
    private $bestBefore;
    private $useBy;

    public function fill($item)
    {
       $this->title = $item['title'];
       $this->bestBefore = $item['best-before'];
       $this->useBy = $item['use-by'];
    }

    public function isUsable()
    {

        if ($this->title == null) {
            return false;
        }

        $useBy = Carbon::parse($this->useBy);

        $today = Carbon::today();

        if ($today > $useBy) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return mixed
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    public function toArray(){
        return array(
            'title' => $this->title,
            'best-before' => $this->bestBefore,
            'use-by' => $this->useBy,
        );
    }
}
