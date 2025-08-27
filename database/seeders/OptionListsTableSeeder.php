<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('option_lists')->delete();
        
        \DB::table('option_lists')->insert(array (
            0 => 
            array (
                'id' => 3,
                'list_type' => 'STATUS',
                'option_value' => 'Y',
                'option_title' => 'Active',
                'sort_id' => 1,
                'is_active' => 'Y',
                'created_at' => '2023-11-28 16:19:59',
                'created_by' => NULL,
                'updated_at' => '2023-11-28 16:20:17',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'list_type' => 'STATUS',
                'option_value' => 'N',
                'option_title' => 'Inactive',
                'sort_id' => 2,
                'is_active' => 'Y',
                'created_at' => '2023-11-28 16:20:10',
                'created_by' => NULL,
                'updated_at' => '2023-11-28 16:20:14',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}