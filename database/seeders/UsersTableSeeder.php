<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'mobile' => '7777777777',
                'email' => 'admin@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$N7kd/MtjMQXxqPUHGpPKm.2rTMnKRke.gKXo05uOnFdxpKAORiAJS',
                'avatar' => 'avatar-1.jpg',
                'remember_token' => 'aorQKkZcXFE31aMZViox3rw3Ax94Q0fTS9oAW6cPQg5iln1qKooXE41vL2fR',
                'two_factor_code' => NULL,
                'two_factor_expires_at' => NULL,
                'is_account_locked' => 'N',
                'two_factor_code_resend_attempt' => '0',
                'logins' => 50,
                'last_login_ip' => '127.0.0.1',
                'last_login_at' => '2023-08-24 18:32:13',
                'account_locked_at' => NULL,
                'login_attempt' => 0,
                'created_at' => '2023-06-07 09:35:31',
                'created_by' => NULL,
                'updated_at' => '2023-08-24 18:32:13',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'Belle Vaughan',
                'mobile' => NULL,
                'email' => 'rycir@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$MAL0i/kM7T5JjcR23IHPbOkLPEu3RQI9NAuMIOFFg2o7cmsMH6t4y',
                'avatar' => NULL,
                'remember_token' => NULL,
                'two_factor_code' => NULL,
                'two_factor_expires_at' => NULL,
                'is_account_locked' => 'Y',
                'two_factor_code_resend_attempt' => NULL,
                'logins' => NULL,
                'last_login_ip' => NULL,
                'last_login_at' => NULL,
                'account_locked_at' => NULL,
                'login_attempt' => NULL,
                'created_at' => '2023-06-12 08:34:36',
                'created_by' => NULL,
                'updated_at' => '2023-06-12 08:34:36',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'Liberty Day',
                'mobile' => '9898989898',
                'email' => 'sete@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$N7kd/MtjMQXxqPUHGpPKm.2rTMnKRke.gKXo05uOnFdxpKAORiAJS',
                'avatar' => NULL,
                'remember_token' => NULL,
                'two_factor_code' => '152326',
                'two_factor_expires_at' => '2023-06-13 06:47:30',
                'is_account_locked' => 'N',
                'two_factor_code_resend_attempt' => NULL,
                'logins' => 1,
                'last_login_ip' => '127.0.0.1',
                'last_login_at' => '2023-06-13 06:37:30',
                'account_locked_at' => NULL,
                'login_attempt' => 0,
                'created_at' => '2023-06-12 09:01:04',
                'created_by' => NULL,
                'updated_at' => '2023-06-13 06:37:30',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'name' => 'Ocean Pate',
                'mobile' => NULL,
                'email' => 'xydy@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$v2MhofTIYMC1Ln0o/WLYDecEyFYRTBDD.QjJKLp0wRcL7jfFJfY2m',
                'avatar' => NULL,
                'remember_token' => NULL,
                'two_factor_code' => NULL,
                'two_factor_expires_at' => NULL,
                'is_account_locked' => 'Y',
                'two_factor_code_resend_attempt' => NULL,
                'logins' => NULL,
                'last_login_ip' => NULL,
                'last_login_at' => NULL,
                'account_locked_at' => NULL,
                'login_attempt' => NULL,
                'created_at' => '2023-06-12 09:02:30',
                'created_by' => NULL,
                'updated_at' => '2023-06-12 09:02:30',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'name' => 'Jade Curry',
                'mobile' => NULL,
                'email' => 'vycoril@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$.AkB7baKq.PAlZm9GLy.1uX2EMKIgdBAwd8ljLkQH4qMAHv1bC64a',
                'avatar' => NULL,
                'remember_token' => NULL,
                'two_factor_code' => NULL,
                'two_factor_expires_at' => NULL,
                'is_account_locked' => 'Y',
                'two_factor_code_resend_attempt' => NULL,
                'logins' => NULL,
                'last_login_ip' => NULL,
                'last_login_at' => NULL,
                'account_locked_at' => NULL,
                'login_attempt' => NULL,
                'created_at' => '2023-06-12 09:04:04',
                'created_by' => NULL,
                'updated_at' => '2023-06-12 09:04:04',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            5 => 
            array (
                'id' => 10,
                'name' => 'Xena Miles',
                'mobile' => NULL,
                'email' => 'cirexapoza@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$kwd0W1bBkuFI7KiUc2GVm.FknLh9EKp9oS.aesBbYTylGNhaXUAsG',
                'avatar' => NULL,
                'remember_token' => NULL,
                'two_factor_code' => NULL,
                'two_factor_expires_at' => NULL,
                'is_account_locked' => 'Y',
                'two_factor_code_resend_attempt' => NULL,
                'logins' => NULL,
                'last_login_ip' => NULL,
                'last_login_at' => NULL,
                'account_locked_at' => NULL,
                'login_attempt' => NULL,
                'created_at' => '2023-06-12 09:19:01',
                'created_by' => NULL,
                'updated_at' => '2023-06-12 09:19:01',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}