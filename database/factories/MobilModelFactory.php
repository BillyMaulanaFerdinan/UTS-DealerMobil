<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MobilModel>
 */
class MobilModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = \App\Models\MobilModel::class;

    public function definition(): array
    {
        return [
            'merek' => $this->faker->randomElement(['Nissan', 'Toyota', 'Daihatsu', 'Subaru', 'Suzuki']),
            'nama' => $this->faker->word() . ' ' . $this->faker->numerify('A##'), //menggunakan library faker
            'kode_mesin' => $this->faker->unique()->numerify('###############'), // 15 digit
            'warna' => $this->faker->randomElement(['Hitam', 'Putih', 'Merah', 'Biru', 'Silver']),
            'harga' => $this->faker->numberBetween(100000000, 500000000), // harga dalam IDR
            'kondisi' => $this->faker->randomElement(['Baru', 'Bekas']), // kondisi mobil
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
