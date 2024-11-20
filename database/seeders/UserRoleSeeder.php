<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run()
    {

        User::where('id', 2)->update(['role' => 1]);

        User::where('id', '!=', 2)->update(['role' => 0]);
    }
}

