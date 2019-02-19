<?php

namespace Tests\Unit;

use App\Http\Controllers\LunchController;
use App\Transformers\RecipesTransformer;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LunchControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testGetRecipes()
    {
        $recipes = Mockery::mock('App\Model\ModelInterface');

        $recipes->shouldReceive('getValid')->andReturn(Collection::make([$recipes]));
        $recipes->shouldReceive('getTitle')->andReturn('example');
        $recipes->shouldReceive('getIngredients')->andReturn([]);
        $this->app->instance('App\Model\ModelInterface', $recipes);

        $repository = $this->app->make('App\Repositories\FileRepository');

        $lunchController = new LunchController($repository, new RecipesTransformer());

        $this->assertIsArray($lunchController->getRecipes());
        $this->assertCount(1, $lunchController->getRecipes());

        Mockery::close();
    }
}
