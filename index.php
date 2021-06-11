<?php
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
    $admin = new \Dsprog\PageAdmin();
    $admin->setView('index');
});

$app->run();