<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class RecipeData extends Data
{
    public string $name;
    public string $description;
    public array $ingredients;

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150', 'unique:recipes,name'],
            'description' => ['required', 'string', 'max:300'],
            'ingredients' => ['required', 'array'],
            'ingredients.*.id' => ['required', 'exists:ingredients,id', 'distinct'],
            'ingredients.*.amount' => ['required', 'numeric', 'min:1'],
        ];
    }
}
