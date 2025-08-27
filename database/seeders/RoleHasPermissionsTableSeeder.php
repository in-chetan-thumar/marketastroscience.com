<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 6,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 8,
            ),
            4 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 2,
                'role_id' => 6,
            ),
            7 => 
            array (
                'permission_id' => 2,
                'role_id' => 8,
            ),
            8 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            9 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            10 => 
            array (
                'permission_id' => 3,
                'role_id' => 6,
            ),
            11 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            12 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 4,
                'role_id' => 6,
            ),
            14 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            15 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 5,
                'role_id' => 6,
            ),
            17 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            18 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            19 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            20 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 7,
                'role_id' => 6,
            ),
            22 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            23 => 
            array (
                'permission_id' => 8,
                'role_id' => 6,
            ),
            24 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            25 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 9,
                'role_id' => 6,
            ),
            27 => 
            array (
                'permission_id' => 9,
                'role_id' => 8,
            ),
            28 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            29 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            30 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            31 => 
            array (
                'permission_id' => 11,
                'role_id' => 2,
            ),
            32 => 
            array (
                'permission_id' => 11,
                'role_id' => 6,
            ),
            33 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            34 => 
            array (
                'permission_id' => 12,
                'role_id' => 6,
            ),
        ));
        
        
    }
}