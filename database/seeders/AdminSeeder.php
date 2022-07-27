<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRule = Role::query()->where('title','=','admin')->first();
        $adminUser =User::query()->create([
        'role_id'=>$adminRule->id,
         'name'=>'Hossein',
         'email'=>'shadabfar75@mail.com',
         'password'=>bcrypt(12345)
        ]);
    }
}
