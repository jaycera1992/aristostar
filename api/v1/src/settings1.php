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
            'host' => '192.168.1.65', // To change port, just add it afterwards like localhost:8889
            'dbname' => 'p2zconnected', // DB name or SQLite path
            'username' => 'jams',
            'password' => '1111',
            'port' => '3306'
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
            'url' => 'https://p3.jobsglobal.com/',
            'shorten' => 'https://p3.jobsglobal.com/shorten/u.php?u=',
        ],

        'cvsoap' => [
            'link_url' => 'http://cvlizer.joinvision.com/cvlizer/exservicesoap?wsdl'
        ],

        'elasticsearch' => [
            'endpoint' => 'http://jobsglobal.com/datatools/8881/',
            'jobendpoint' => 'http://jobsglobal.com/datatools/8081/',
            'host' => [
              '192.168.1.174:9200'
            ]
        ],

        'redismaster' => [
            'scheme' => 'tcp',
            'host' => '192.168.1.173',
            'port' => '56969',
            'password' => 'jgr@2017'
        ],

        'redisslave' => [
            'scheme' => 'tcp',
            'host' => '192.168.1.174',
            'port' => '56868',
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
            'client_id' => 'AekZLRIiL_yh3TkgKJvqNLvapGtJ0KjmWIJRlLF1fwZl3molnjzesx2T8v_JP23pBfRhlvX5QMAAqfh4',
            'secret'    => 'EN2BgcoMJlvN2baob6lVC8fppjYU9GhE0zIo20Ms4YyJpL6Om5Tiq2v7KLh1ksNqflO47WNaElU-qf2c',
            'config'    => [
                'mode' => 'sandbox',
                'http.ConnectionTimeout' => 30,
                'log.LogEnabled' => false,
                'log.FileName' => '',
                'log.LogLevel' => 'FINE',
                'validation.level' => 'log'
            ]
        ]

    ],
];
