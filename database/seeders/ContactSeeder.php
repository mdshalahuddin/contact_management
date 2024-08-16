<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            Contact::create([
                'name' => fake()->name('mixed'), 'email' => fake()->email(), 'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ]);
        }

    }
}
