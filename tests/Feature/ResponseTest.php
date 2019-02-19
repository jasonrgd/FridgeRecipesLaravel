<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResponseTest extends TestCase
{
    /**
     * A basic feature test to test endpoint lunch.
     *
     * @return void
     */
    public function testSuccessfulResponse()
    {
        $response = $this->get('/api/lunch');

        $response->assertStatus(200);
    }

    public function testResponseObjectWhenRecipesHaveReturned()
    {
        $response = $this->get('/api/lunch');
        $response->assertJsonStructure([
            [
                'title',
                'ingredients' => [
                    [
                        'title',
                        'best-before',
                        'use-by'
                    ]
                ]
            ]
        ]);
    }

    public function testEmptyResponseObjectWhenAllIngredientsArePastTheirUseByDate()
    {
        putenv("DATA_FOLDER=testing/dataset1");
        $response = $this->get('/api/lunch');

        $response->assertJsonStructure([
            []
        ]);

        putenv("DATA_FOLDER=testing");

    }
}
