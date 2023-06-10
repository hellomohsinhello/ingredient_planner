<?php

namespace App\Http\Controllers;

use App\Data\RecipeData;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class RecipeController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        $per_page = request('per_page', 10);

        $recipes =  Recipe::with('ingredients')->paginate($per_page);

        return RecipeResource::collection($recipes);
    }

    /**
     * @param RecipeData $data
     * @return RecipeResource
     */
    public function store(RecipeData $data) : RecipeResource
    {
        $recipe = Recipe::create($data->all());

        $ingredientData = collect($data->ingredients)->mapWithKeys(function ($ingredient) {
            return [$ingredient['id'] => ['amount' => $ingredient['amount']]];
        });

        $recipe->ingredients()->attach($ingredientData);

        $recipe->load('ingredients');

        return new RecipeResource($recipe);
    }
}
