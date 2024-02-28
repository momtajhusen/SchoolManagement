<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountLogin;


class AccountLoginData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Account Login 
        $admin = new AccountLogin;
        $admin->super_admin_username  =  "superadmin@gmail.com";
        $admin->super_admin_password  =   "superadmin";
        $admin->save();
    }
}
