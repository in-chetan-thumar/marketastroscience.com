<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(
            array(
                0 =>
                    array(
                        'id' => 1,
                        'name' => 'Super Admin',
                        'guard_name' => 'web',
                        'show_while_creating_user' => 'YES',
                        'redirect_to' => 'usermanagements.index',
                        'created_at' => '2021-09-30 06:02:37',
                        'created_by' => NULL,
                        'updated_at' => '2021-09-30 06:02:37',
                        'updated_by' => NULL,
                        'deleted_at' => NULL,
                        'deleted_by' => NULL,
                    ),
                1 =>
                    array(
                        'id' => 2,
                        'name' => 'Admin',
                        'guard_name' => 'web',
                        'show_while_creating_user' => 'YES',
                        'redirect_to' => 'usermanagements.index',
                        'created_at' => '2021-09-30 06:02:38',
                        'created_by' => NULL,
                        'updated_at' => '2021-09-30 06:02:38',
                        'updated_by' => NULL,
                        'deleted_at' => NULL,
                        'deleted_by' => NULL,
                    ),
                2 =>
                    array(
                        'id' => 6,
                        'name' => 'Demo 1',
                        'guard_name' => 'web',
                        'show_while_creating_user' => 'YES',
                        'redirect_to' => 'root',
                        'created_at' => '2022-01-27 07:16:05',
                        'created_by' => NULL,
                        'updated_at' => '2023-06-12 11:57:20',
                        'updated_by' => 1,
                        'deleted_at' => NULL,
                        'deleted_by' => NULL,
                    ),
                3 =>
                    array(
                        'id' => 8,
                        'name' => 'demo 1 role create',
                        'guard_name' => 'web',
                        'show_while_creating_user' => 'YES',
                        'redirect_to' => 'root',
                        'created_at' => '2023-06-12 11:49:14',
                        'created_by' => 1,
                        'updated_at' => '2023-06-12 11:50:01',
                        'updated_by' => NULL,
                        'deleted_at' => '2023-06-12 11:50:01',
                        'deleted_by' => NULL,
                    ),
            )
        );


    }
}