<?php

namespace App\Transformers;

class RecipesTransformer {

    public function transform($recipes){
        $items = array();
        foreach ($recipes as $recipe) {
            $items[] = array('title' => $recipe->getTitle() , 'ingredients' => $recipe->getIngredients());
        }
        return $items;
    }
}
