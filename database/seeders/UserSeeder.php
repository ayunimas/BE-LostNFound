<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSatpam = Role::create([
            "nm_role" => "satpam",
            "desc_role" => "Satpam",
        ]);

        $roleCivitas = Role::create([
            "nm_role" => "civitas",
            "desc_role" => "Civitas",
        ]);

        User::create([
            "name" => "John Doe",
            "contact" => "081234123",
            "email" => "john@example.com",
            "password" => Hash::make("password"),
            "id_role" => $roleSatpam->id,
        ]);
        User::create([
            "name" => "John Doe",
            "contact" => "081234123",
            "email" => "john@example.com",
            "password" => Hash::make("password"),
            "id_role" => $roleCivitas->id,
        ]);
    }
}
