<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mail_templates')->delete();
        
        \DB::table('mail_templates')->insert(array (
            0 => 
            array (
                'id' => 19,
                'template_code' => 'create_user_notification',
                'template_name' => 'Create user notification',
                'mailable' => 'App\\Mail\\UserCreateNotification',
                'subject' => 'User Create Notification',
                'html_template' => '<p>Hello {{NAME}}</p>

<p>We have created your account in {{PRACTICE_NAME}} backen and below is the login details.</p>

<p>Username: {{USER}}</p>

<p>Password: {{PASSWORD}}</p>

<p>{{LOGIN}}</p>

<p>Regards,<br />
{{PRACTICE_NAME}}</p>

<p><span style="color:#e74c3c"><strong>DO NOT REPLY TO THIS E-MAIL</strong></span><br />
This is an automated e-mail message sent from our support system.<br />
Do not reply to this e-mail as we will not receive your reply!</p>',
            'text_template' => 'Hello \\n \\n I am inviting you to a video consultation session. Please click below to join the consultation (no account needed) \\n \\nVideo consultation time: {time} \\n \\nVideo consultation link: {URL} \\n \\nBest Regards,\\n{PRACTICE_NAME}',
                'template_type' => 'EMAIL',
                'created_at' => NULL,
                'created_by' => NULL,
                'updated_at' => '2021-09-30 07:52:54',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            1 => 
            array (
                'id' => 21,
                'template_code' => 'reset_password_notification',
                'template_name' => 'Reset Password Notification',
                'mailable' => 'App\\Mail\\ResetPasswordMail',
                'subject' => 'Reset Password Notification',
                'html_template' => '<p>You are receiving this email because we received a password reset request for your account.</p>

<p>{{RESET}}</p>

<p>This password reset link will expire in 60 minutes.</p>

<p>If you did not request a password reset, no further action is required.</p>

<p>Regards,<br />
{{PRACTICE_NAME}}</p>

<p><span style="color:#e74c3c"><strong>DO NOT REPLY TO THIS E-MAIL</strong></span><br />
This is an automated e-mail message sent from our support system.<br />
Do not reply to this e-mail as we will not receive your reply!</p>',
            'text_template' => 'Hello \\n \\n I am inviting you to a video consultation session. Please click below to join the consultation (no account needed) \\n \\nVideo consultation time: {time} \\n \\nVideo consultation link: {URL} \\n \\nBest Regards,\\n{PRACTICE_NAME}',
                'template_type' => 'EMAIL',
                'created_at' => NULL,
                'created_by' => NULL,
                'updated_at' => '2022-01-27 07:31:15',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
            2 => 
            array (
                'id' => 40,
                'template_code' => 'templete_create_notification',
                'template_name' => 'Templete Create Notification',
                'mailable' => 'App\\Mail\\TempleteCreateNotification',
                'subject' => 'Templete Create Notification',
                'html_template' => '<p>Templete Create Notification</p>',
                'text_template' => NULL,
                'template_type' => 'EMAIL',
                'created_at' => NULL,
                'created_by' => NULL,
                'updated_at' => '2023-06-13 05:11:46',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
            ),
        ));
        
        
    }
}