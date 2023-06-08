<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::where('email', 'dipta995@gmail.com')->first();
        if (is_null($user)) {

            $user = new Admin();
            $user->name = "Dipta Dey";
            $user->username = "dipta995";
            $user->email = "dipta995@gmail.com";
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
