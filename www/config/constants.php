<?php
return [
    'EMAIL_OTP_LOGIN' => true,
    'MOBILE_OTP_LOGIN' => false,
    'USER_PASSWORD_LOGIN' => true,
    'APP_NAME' => env('APP_NAME', ''),
    //Message templates
    'EMAIL_TEMPLATE' => true,
    'SMS_TEMPLATE' => false,
    'WHATS_APP_TEMPLATE' => false,

    //Emails
    'EMAIL' => [
        'STAGING' => ['TO' => ['rabi.mohanty@quantuminfoway.com'], 'CC' => []],
        'LOCAL' => ['TO' => ['rabi.mohanty@quantuminfoway.com'], 'CC' => []],
    ],
    'PER_PAGE' => 10,
    'SUPER_ADMIN' => 'Super Admin',
    // FILE UPLOAD PATH
    'USER_DOC_PATH' => 'public' . DIRECTORY_SEPARATOR . "profile" . DIRECTORY_SEPARATOR,
    'USER_DOC_URL' => 'storage' . DIRECTORY_SEPARATOR . "profile" . DIRECTORY_SEPARATOR,

    // Blog upload path
    'BLOG_FILE_PATH' => 'public' . DIRECTORY_SEPARATOR . "blog" . DIRECTORY_SEPARATOR,
    'BLOG_FILE_URL' => 'storage' . DIRECTORY_SEPARATOR . "blog" . DIRECTORY_SEPARATOR,
    // APP VERSION
    'APP_VERSION' => env('APP_VERSION', '1.0'),
    'LOGO_FILE_NAME' => 'logo-dark.png',
    'DEVELOPED_BY' => '',
    'USER_LOCKED_MINUTES' => 2,
    'OPTION_LIST_TYPE' => ['STATUS' => 'Status'],
];
