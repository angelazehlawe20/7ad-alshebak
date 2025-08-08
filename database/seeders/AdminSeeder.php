<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Salem',
            'email' => 'owner@hadalshebak.com',
            'password' => Hash::make('hadalshebak12345'),
            'is_owner' => true,
        ]);
    }
}
