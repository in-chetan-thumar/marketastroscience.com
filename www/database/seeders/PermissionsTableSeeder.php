<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(
            array(
                0 =>
                    array(
                        'id' => 1,
                        'title' => 'Dashboard',
                        'name' => 'home',
                        'permission_label' => 'Dashboard',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'Y',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2023-06-12 11:58:16',
                    ),
                1 =>
                    array(
                        'id' => 2,
                        'title' => 'Settings',
                        'name' => 'setting.index',
                        'permission_label' => 'Site configuration show',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'Y',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                2 =>
                    array(
                        'id' => 3,
                        'title' => 'Settings',
                        'name' => 'emailtemplate.index',
                        'permission_label' => 'Email template show',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'Y',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                3 =>
                    array(
                        'id' => 4,
                        'title' => 'Settings',
                        'name' => 'emailtemplates.create',
                        'permission_label' => 'Email edit',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                4 =>
                    array(
                        'id' => 5,
                        'title' => 'User and role management',
                        'name' => 'usermanagements.index',
                        'permission_label' => 'User show',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'Y',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                5 =>
                    array(
                        'id' => 6,
                        'title' => 'User and role management',
                        'name' => 'usermanagements.create',
                        'permission_label' => 'User create',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                6 =>
                    array(
                        'id' => 7,
                        'title' => 'User and role management',
                        'name' => 'usermanagements.edit',
                        'permission_label' => 'User edit',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                7 =>
                    array(
                        'id' => 8,
                        'title' => 'User and role management',
                        'name' => 'usermanagements.destroy',
                        'permission_label' => 'User delete',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                8 =>
                    array(
                        'id' => 9,
                        'title' => 'User and role management',
                        'name' => 'roles.index',
                        'permission_label' => 'Role show',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'Y',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                9 =>
                    array(
                        'id' => 10,
                        'title' => 'User and role management',
                        'name' => 'roles.create',
                        'permission_label' => 'Role create',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                10 =>
                    array(
                        'id' => 11,
                        'title' => 'User and role management',
                        'name' => 'roles.edit',
                        'permission_label' => 'Role edit',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
                11 =>
                    array(
                        'id' => 12,
                        'title' => 'User and role management',
                        'name' => 'roles.destroy',
                        'permission_label' => 'Role delete',
                        'guard_name' => 'web',
                        'is_active' => 'Y',
                        'is_redirectable' => 'N',
                        'created_at' => '2021-09-30 06:06:57',
                        'updated_at' => '2021-09-30 06:06:57',
                    ),
            )
        );


    }
}