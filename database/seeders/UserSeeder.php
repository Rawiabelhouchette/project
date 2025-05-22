<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'bill',
            'prenom' => 'bill',
            'username' => 'bill',
            'email' => 'bill@bill.com',
            'telephone' => '90 90 90 90',
            'password' => 'ZtfqnuX1LZ14Ba3',
        ])->assignRole('Administrateur');

        User::create([
            'nom' => 'martin',
            'prenom' => 'martin',
            'username' => 'martin',
            'email' => 'martin@vamiyi.com',
            'telephone' => '90 90 90 87',
            'password' => 'l3jfbY4YR1EEDFk',
        ])->assignRole('Administrateur');
    }
}
