<?php

return [

    /* Make this variable "true" for upload document in cloud, default value is "false" */
    'using_cloud_storage' => env('USING_CLOUD_STORAGE',true),

    /* Cloud filesystem driver */
    'filesystem_driver' => 's3',

    /* Cloud environment folder development,staging,production */

    /* Document upload limit at a time */
    'upload_doc_limit' => env('UPLOAD_DOC_LIMIT',100),

    /* Unlock document document upload scheduler table entry days */
    'upload_doc_unlock_hours' => env('UPLOAD_DOC_UNLOCK_HOURS',24),

    /* Upload error mail count */
    'upload_error_mail_count' => env('UPLOAD_ERROR_MAIL_COUNT',5),

    /* Local document clear days */
    'local_doc_clear_days' => env('LOCAL_DOC_CLEAR_DAYS', 0),

    /*List of Directories that used by cloud storage*/
    'list_of_directories_in_use' => [
        'public/audit_detail/'
    ],

    /* Laravel default supported storage driver */
    'laravel_supported_drivers' => ['s3','rackspace','ftp','sftp'],

    /* Email address that get cloud storage error mail */
    'error_to_mail' => env('ERROR_TO_EMAIL','chetan.thumar@tiez.nl'),
    /* Optimize image constants */
    'OP_OPTIMIZE_ENABLED' => true,
    'OP_WEBP_ENABLED' => true,
    'OP_FONT_PATH' => 'assets/fonts/Multicolore/Multicolore-Regular.ttf',
    'OP_FONT_COLOR' => '#4d4d4d',
    'OP_WATERMARK_ENABLED' => true,
    'OP_RESIZE_ENABLED' => true,
    'OP_REDUCE_QUALITY_ENABLED' => true,
    'OP_WATERMARK_TEXT' => 'Mahindra LMM',
    'OP_WATERMARK_ALIGN' => 'center',
    'OP_WATERMARK_VALIGN' => 'center',
    'OP_IMAGES_EXTENSIONS'=>["jpg","JPG","jpeg","JPEG","png","PNG"]
];
