<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class AdminKursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create role "Admin Tempat Kursus"
        Role::create([
            'name' => 'Admin Tempat Kursus',
            'guard_name' => 'web',
        ]);
    }
}
