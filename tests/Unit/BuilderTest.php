<?php

namespace Tests\Unit;

use App\Library\Builder;
use Tests\TestCase;

class BuilderTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testBuilderLoadsDataAsArray()
    {
        $builder = new Builder(base_path('storage/app/testing/recipes.json'));

        $this->assertIsArray($builder->load());
        $this->assertArrayHasKey('recipes', $builder->load());
    }

    /**
     * @return void
     */
    public function testFileNotFoundByParser()
    {
        $builder = new Builder(base_path('storage/app/testing/recipes1.json'));

        $this->expectException(\ErrorException::class);
        $builder->load();
    }
}
