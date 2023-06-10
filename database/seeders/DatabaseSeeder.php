<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Box;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);

//        truncate tables
        Schema::disableForeignKeyConstraints();

        DB::table('box_recipe')->truncate();
        DB::table('ingredient_recipe')->truncate();

        Supplier::truncate();
        Ingredient::truncate();
        Recipe::truncate();
        Box::truncate();

        Schema::enableForeignKeyConstraints();

//        create 10 suppliers
        $suppliers = Supplier::factory(10)->create();

//        create 10 ingredients
        $ingredients = Ingredient::factory(10)
            ->create()
            ->each(function ($ingredient) use ($suppliers) {
                $ingredient->supplier_id = $suppliers->random()->id;
                $ingredient->save();
            });

//        create 10 recipes and attach up to 5 ingredients to each
        $recipes = Recipe::factory(10)
            ->create()
            ->each(function ($recipe) use ($ingredients) {
                $ingredients->random(rand(1, 4))->pluck('id')->each(function ($ingredient_id) use ($recipe) {
                    $recipe->ingredients()->attach($ingredient_id, ['amount' => rand(1, 4)]);
                });
            });

//        create 10 boxes and attach up to 4 recipes to each
        $boxes = Box::factory(10)
            ->create()
            ->each(function ($box) use ($recipes) {
                $recipes = $recipes->random(rand(1, 4))->pluck('id');
                $box->recipes()->attach($recipes);
            });

    }
}
