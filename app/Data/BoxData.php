<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BoxData extends Data
{
    public string $delivery_date;
    public array $recipes;

    public static function rules(): array
    {
        return [
            'delivery_date' => [
                'required',
                'date',
                'after:'.date('Y-m-d', strtotime('+4 days'))
            ],
            'recipes' => ['required', 'array', 'min:1', 'max:4'],
            'recipes.*.id' => ['required', 'exists:recipes,id', 'distinct'],
        ];
    }
}
