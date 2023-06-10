<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class IngredientData extends Data
{
    #[Required, StringType, Max(150), Unique('ingredients', 'name')]
    public string $name;
    #[Required, StringType, In(['kg', 'g', 'l', 'ml', 'unit'])]
    public string $measure;
    #[Required, IntegerType, Exists('suppliers', 'id')]
    public int $supplier_id;
}
