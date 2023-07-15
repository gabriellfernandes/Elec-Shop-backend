<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class AppliancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markings = ['electrolux', 'brastemp', 'fischer', 'samsung', 'lg'];
        $voltages = ['110', '127', '220'];
        $imageUrls = [
            'https://www.realce.ind.br/extranet/thumbnail/fill/520x410/gallery/1393.png/235,235,235',
            'https://www.realce.ind.br/extranet/thumbnail/fill/520x410/gallery/1405.png/235,235,235',
            'https://www.lg.com/br/eletrodomesticos/lg-studio/img/shop/hero-2.png',
        ];

        $faker = FakerFactory::create();

        for ($i = 0; $i < 50; $i++) {
            $name = $faker->unique()->word;
            $image = $faker->randomElement([$faker->randomElement($imageUrls), null]);
            $quantity = $faker->numberBetween(0, 20);
            $description = $faker->sentence;
            $marking = $faker->randomElement($markings);
            $voltage = $faker->randomElement($voltages);

            DB::table('appliances')->insert([
                'name' => $name,
                'image' => $image,
                'quantity' => $quantity,
                'description' => $description,
                'marking' => $marking,
                'voltage' => $voltage,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}