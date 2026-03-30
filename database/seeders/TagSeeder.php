<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tags = ['Quick', 'Healthy', 'Vegetarian', 'Easy'];

        foreach ($Tags as $t) {
            Tag::create(['name' => $t]);
        }
    }
}
