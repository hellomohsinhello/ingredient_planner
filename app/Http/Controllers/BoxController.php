<?php

namespace App\Http\Controllers;

use App\Data\BoxData;
use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * @param BoxData $data
     * @return BoxResource
     */
    public function store(BoxData $data) : BoxResource
    {
        $box = Box::create($data->all());

        foreach ($data->recipes as $recipe) {
            $box->recipes()->attach($recipe['id']);
        }

        $box->load('recipes');

        return new BoxResource($box);
    }
}
