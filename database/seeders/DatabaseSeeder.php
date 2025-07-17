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

        // \App\Models\User::updateOrCreate([
        //     'email' => 'iqbal@gmail.com',
        // ], [
        //     'name' => 'Iqbal',
        //     'password' => bcrypt('password'),
        //     'role' => 'siswa',
        // ]);

        \App\Models\User::updateOrCreate([
            'email' => 'iqbal@gmail.com',
        ], [
            'name' => 'Iqbal',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'nisn' => '1234567890',
            'kelas' => 'XII RPL 1',
        ]);

        \App\Models\User::updateOrCreate([
            'email' => 'siswa1@smk.test',
        ], [
            'name' => 'Siswa Satu',
            'password' => bcrypt('12345678'),
            'role' => 'siswa',
            'nisn' => '1234567891',
            'kelas' => 'XII RPL 2',
        ]);

        \App\Models\User::updateOrCreate([
            'email' => 'siswa2@smk.test',
        ], [
            'name' => 'Siswa Dua',
            'password' => bcrypt('12345678'),
            'role' => 'siswa',
            'nisn' => '1234567892',
            'kelas' => 'XI TKJ 1',
        ]);

        \App\Models\User::updateOrCreate([
            'email' => 'admin@smk.test',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'nisn' => '0000000000',
            'kelas' => '-',
        ]);

        \App\Models\Setting::updateOrCreate([
            'key' => 'school_lat',
        ], [
            'value' => '-6.200000',
        ]);
        \App\Models\Setting::updateOrCreate([
            'key' => 'school_long',
        ], [
            'value' => '106.816666',
        ]);
        \App\Models\Setting::updateOrCreate([
            'key' => 'school_radius',
        ], [
            'value' => '100',
        ]);
    }
}
