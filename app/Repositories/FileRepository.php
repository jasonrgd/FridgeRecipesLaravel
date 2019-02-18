<?php

namespace App\Repositories;

use App\Model\ModelInterface;

class FileRepository implements RepositoryInterface
{
    private $model;

    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getValid()
    {
        return $this->model->getValid();
    }
}
