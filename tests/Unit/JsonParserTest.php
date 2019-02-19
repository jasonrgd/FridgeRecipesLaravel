<?php

namespace Tests\Unit;

use App\Library\Json\JsonFileParser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JsonParserTest extends TestCase
{
    /**
     * @return void
     */
    public function testExample()
    {
        $jsonParser = new JsonFileParser(base_path('storage/app/testing/recipes.json'));

        $this->assertIsArray($jsonParser->load());
        $this->assertArrayHasKey('recipes', $jsonParser->load());
    }

    /**
     * @return void
     */
    public function testFileNotFoundByParser()
    {
        $parser = new JsonFileParser(base_path('storage/app/testing/recipes1.json'));

        $this->expectException(\ErrorException::class);
        $parser->load();
    }
}
