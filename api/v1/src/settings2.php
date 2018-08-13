<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database
        'db' => [
            'host' => 'localhost', // To change port, just add it afterwards like localhost:8889
            'dbname' => 'jobsglobal', // DB name or SQLite path
            'username' => 'jay',
            'password' => '1111',
            'port' => '53306'
        ],

        'amq' => [
            'host' => '104.167.8.65',
            'port' => '5672',
            'username' => 'mailman',
            'password' => '111111'
        ],

        'file' => [
            'fs_url' => 'http://jobsglobal.com/app02/fs1/',
            'fs_get_url' => 'http://fs1.jobsglobal.com/e/act/get/name/',
            'parser' => 'http://jobsglobal.com/app04/parserc/'
        ],

        'domain' => [
            'url' => 'http://localhost:4200/',
            'shorten' => 'http://localhost:4200/shorten/u.php?u=',
        ],

        'cvsoap' => [
            'link_url' => 'http://cvlizer.joinvision.com/cvlizer/exservicesoap?wsdl'
        ],

        'elasticsearch' => [
            'endpoint' => 'http://jobsglobal.com/datatools/8881/',
            'jobendpoint' => 'http://jobsglobal.com/datatools/8081/',
            'host' => [
              'localhost:8888'
            ]
        ],

        'redismaster' => [
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => '6969',
            'password' => 'jgr@2017'
        ],

        'redisslave' => [
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => '6969',
            'password' => 'jgr@2017'
        ],

        'phpmailer' => [
            'smtp_debug' => false,
            'host'  => 'pro.turbo-smtp.com',
            'smtp_auth'  => true,
            'username' => 'smtp@jobsglobal.com',
            'password' => 'C9PbZSI234',
            'smtp_secure' => '',
            'port' => 587,
            'sender_email' => 'no-reply@jobsglobal.com',
            'sender_name' => 'JobsGlobal.com'
        ],

        'paypal' => [
            'client_id' => 'Aadn_YLtbgW2U-YT9dFnSV_n1HKOldb-aTjPm-rN1zqhOhqF6L7_y-h8CKCW29HDjRLDlLgNMbbQqkpp',
            'secret'    => 'EHFVcjasPbj3r4zr0UNAaa5pRq6osZWx8G3vuo3OKyTd8iufnoOCbt_QYSOpcTsgVgXcMCQpteIdpEy0',
            'config'    => [
                'mode' => 'live',
                'http.ConnectionTimeout' => 30,
                'log.LogEnabled' => false,
                'log.FileName' => '',
                'log.LogLevel' => 'FINE',
                'validation.level' => 'log'
            ]
        ]

    ],
];
