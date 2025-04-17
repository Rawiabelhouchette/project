<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Annonce;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(ReferenceValeurSeeder::class);

        $this->call(OffreAbonnementSeeder::class);

        $this->call(EntrepriseSeeder::class);
    }
}
