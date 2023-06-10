<?php

namespace App\Http\Controllers;

use App\Data\IngredientData;
use App\Http\Requests\IngredientOrderRequest;
use App\Http\Requests\IngredientStoreRequest;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(IngredientOrderRequest $request) : AnonymousResourceCollection
    {
        $ingredients = Ingredient::query()
            ->when($request->has('supplier_id'), function ($query) use ($request) {
                $query->bySupplier( $request->get('supplier_id'));
            })
            ->with('supplier')
            ->paginate(
            request('per_page', 10)
        );

        return IngredientResource::collection($ingredients);
    }

    /**
     * @param IngredientData $data
     * @return IngredientResource
     */
    public function store(IngredientData $data) : IngredientResource
    {
        $ingredient = Ingredient::create($data->all());

        $ingredient->load('supplier');

        return new IngredientResource($ingredient);
    }


//    View the ingredients required to be ordered by the company

    public function order(IngredientOrderRequest $request) : JsonResponse
    {

        $order_date = Carbon::parse($request->get('order_date', now()));
        $seven_days_later = clone $order_date;
        $seven_days_later = $seven_days_later->addDays(7);

        $ingredients = DB::table('ingredients as i')
            ->select('i.id', 'i.name', 'i.measure', 's.name as supplier_name', DB::raw('SUM(ir.amount) as total_quantity'))
            ->join('ingredient_recipe as ir', 'i.id', '=', 'ir.ingredient_id')
            ->join('recipes as r', 'ir.recipe_id', '=', 'r.id')
            ->join('box_recipe as br', 'r.id', '=', 'br.recipe_id')
            ->join('boxes as b', 'br.box_id', '=', 'b.id')
            ->join('suppliers as s', 'i.supplier_id', '=', 's.id')
            ->whereBetween('b.delivery_date', [
                $order_date->toDateString(),
                $seven_days_later->toDateString()
            ])
            ->when($request->has('supplier_id'), function ($query) use ($request) {
                $query->where('i.supplier_id', $request->get('supplier_id'));
            })
            ->groupBy('i.id', 'i.name', 'i.measure', 's.name')
            ->get();

        return response()->json($ingredients, 200);
    }


}
