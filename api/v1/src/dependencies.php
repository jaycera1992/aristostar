<?php

use Elasticsearch\ClientBuilder;

$container = $app->getContainer();

date_default_timezone_set("Asia/Dubai");

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger   = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['jwt'] = function ($container) {
    return new stdClass();
};

$container['phpmailer'] = function ($c) {
    $settings = $c->get('settings')['phpmailer'];

    $phpmailer = new PHPMailer;

    $phpmailer->SMTPDebug = $settings['smtp_debug'];
    $phpmailer->isSMTP();
    $phpmailer->Host       = $settings['host'];
    $phpmailer->SMTPAuth   = $settings['smtp_auth'];
    $phpmailer->Username   = $settings['username'];
    $phpmailer->Password   = $settings['password'];
    $phpmailer->SMTPSecure = $settings['smtp_secure'];
    $phpmailer->Port       = $settings['port'];

    $phpmailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true,
        ),
    );

    $phpmailer->setFrom($settings['sender_email'], $settings['sender_name']);

    return $phpmailer;
};

// -----------------------------------------------------------------------------
// Database connection
// -----------------------------------------------------------------------------

$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo      = new PDO("mysql:host=" . $settings['host'] . ";port=" . $settings['port'] . ";dbname=" . $settings['dbname'],
        $settings['username'], $settings['password']);

    //$pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
    return $pdo;
};

// -----------------------------------------------------------------------------
// Controllers
// -----------------------------------------------------------------------------

$container['AuthController'] = function($c) {
    return new \App\Controllers\AuthController($c->get('User'), $c->get('CommonFunction'), $c->get('PasswordHash'));
};

$container['UserController'] = function($c) {
    return new \App\Controllers\UserController($c->get('User'), $c->get('CommonFunction'), $c->get('PasswordHash'));
};

$container['BookingController'] = function($c) {
    return new \App\Controllers\BookingController($c->get('Booking'), $c->get('CommonFunction'), $c->get('PasswordHash'));
};

$container['CompanyController'] = function($c) {
    return new \App\Controllers\CompanyController($c->get('Company'), $c->get('CommonFunction'), $c->get('PasswordHash'));
};


// -----------------------------------------------------------------------------
// Model factories
// -----------------------------------------------------------------------------

$container['User'] = function ($container) {
    return new App\Models\User($container->get('db'));
};

$container['Booking'] = function ($container) {
    return new App\Models\Booking($container->get('db'));
};

$container['Company'] = function ($container) {
    return new App\Models\Company($container->get('db'));
};

// -----------------------------------------------------------------------------
// Helpers
// -----------------------------------------------------------------------------

$container['PasswordHash'] = function ($container) {
    return new App\Helpers\PasswordHash();
};

$container['CommonFunction'] = function ($container) {
    return new App\Helpers\CommonFunction($container->get('db'));
};


