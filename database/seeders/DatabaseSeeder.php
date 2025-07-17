<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::updateOrCreate([
            'email' => 'iqbal@gmail.com',
        ], [
            'name' => 'Iqbal',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        // \App\Models\User::updateOrCreate([
        //     'email' => 'siswa@smk.test',
        // ], [
        //     'name' => 'Siswa Dummy',
        //     'password' => bcrypt('12345678'),
        //     'role' => 'siswa',
        // ]);

        // \App\Models\User::updateOrCreate([
        //     'email' => 'admin@smk.test',
        // ], [
        //     'name' => 'Admin',
        //     'password' => bcrypt('admin123'),
        //     'role' => 'admin',
        // ]);

        // \App\Models\Setting::updateOrCreate([
        //     'key' => 'school_lat',
        // ], [
        //     'value' => '-6.200000',
        // ]);
        // \App\Models\Setting::updateOrCreate([
        //     'key' => 'school_long',
        // ], [
        //     'value' => '106.816666',
        // ]);
        // \App\Models\Setting::updateOrCreate([
        //     'key' => 'school_radius',
        // ], [
        //     'value' => '100',
        // ]);
    }
}
