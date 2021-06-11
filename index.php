<?php
session_start();
require_once("vendor/autoload.php");

$app = new \Slim\Slim();
$app->config('debug', true);
$app->get('/', function() {
	// $sql = new \Dsprog\DB\Sql();
    // $rows = $sql->select("SELECT * FROM tb_users");
    // (new \Dsprog\Tools())->convertArraytoJson($rows);

    $page = new \Dsprog\Page();
    $page->setView('index');
});
$app->get('/admin', function() {

    \Dsprog\Models\User::verifyLogin();

    $admin = new \Dsprog\PageAdmin();
    $admin->setView('index');
});

$app->get('/admin/login', function() {
    $admin = new \Dsprog\PageAdmin(['header'=>false, 'footer'=>false]);
    $admin->setView('login');
});

$app->post('/admin/login', function() {
    \Dsprog\Models\User::login($_POST['login'], $_POST['password']);
    
    header('location: /admin');
    exit;
});

$app->get('/admin/logout', function() {
    \Dsprog\Models\User::logout();    
    header('location: /admin/login');
    exit;
});

$app->run();