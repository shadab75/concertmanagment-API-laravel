<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::query()->insert([
            /**
             * category permission
             */
            [
                'title'=>'create-categories'
            ],
            [
                'title'=>'read-categories'
            ],
            [
                'title'=>'update-categories'
            ],
            [
                'title'=>'delete-categories'
            ],
            /**
             * artist permission
             */
            [
                'title'=>'create-artists'
            ],
            [
                'title'=>'read-artists'
            ],
            [
                'title'=>'update-artists'
            ],
            [
                'title'=>'delete-artists'
            ],
            /**
             * users permission
             */

            [
                'title'=>'read-users'
            ],
            [
                'title'=>'update-users'
            ],
            [
                'title'=>'delete-users'
            ],
            /**
             * role permissions
             */

            [
                'title'=>'create-roles'
            ],
            [
                'title'=>'read-roles'
            ],
            [
                'title'=>'update-roles'
            ],
            [
                'title'=>'delete-roles'
            ],

        ]);
    }
}
