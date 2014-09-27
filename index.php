<?php
require 'Slim/Slim.php';
function is_pjax(){
    return array_key_exists('HTTP_X_PJAX', $_SERVER) 
            && $_SERVER['HTTP_X_PJAX'] === 'true';
}

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// GET route
$app->get(
    '/',
    function () {
        echo file_get_contents('pjax.html');
    }
);
$app->get(
    '/test1',
    function() use($app) {
        if (is_pjax()) {
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] :1;
            echo "<div class='imgwrap'>
            <img src='./{$id}.jpg' />
            </div>
        <span><a href='num=1' class='previous'>&lt;&lt;上一张</a>
        <a href='num=3' class='next'>下一张&gt;&gt;</a></span>";    
        }else{
            $app->redirect('/');
        }
        
    }
);
$app->get('/page/:id',function ($id)
{
    var_dump($_GET);
    echo "<h1>hello</h1>";
});
// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

$app->run();
