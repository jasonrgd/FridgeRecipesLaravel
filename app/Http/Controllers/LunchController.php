<?php


namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;
use App\Transformers\RecipesTransformer;

class LunchController extends Controller
{
    private $repository;
    private $transformer;

    public function __construct(RepositoryInterface $recipes, RecipesTransformer $transformer)
    {
        $this->repository = $recipes;
        $this->transformer = $transformer;
    }

    /**
     * @OA\Get(
     *     path="/lunch/",
     *     tags={"Lunch"},
     *     summary="Fetches all valid recipes",
     *     operationId="getRecipes",
     *     @OA\Response(response="200", description="Success"),
     * )
     */

    /**
     * @return array
     */
    public function getRecipes()
    {
        return $this->transformer->transform($this->repository->getValid());
    }
}
