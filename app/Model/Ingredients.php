<?php


namespace App\Model;


use Carbon\Carbon;

/**
 * Class Ingredients
 * @package App\Model
 */
class Ingredients extends Model
{
    /**
     * @var string
     */
    protected $fileName = 'ingredients';
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $bestBefore;

    /**
     * @var string
     */
    private $useBy;

    /**
     * @param $item
     * @return mixed|void
     */
    public function fill($item)
    {
        $this->title = $item['title'];
        $this->bestBefore = $item['best-before'];
        $this->useBy = $item['use-by'];
    }

    /**
     * @return bool
     */
    public function isUsable(): bool
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return string
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'title' => $this->title,
            'best-before' => $this->bestBefore,
            'use-by' => $this->useBy,
        );
    }
}
