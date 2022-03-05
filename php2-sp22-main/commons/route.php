<?php

use App\Controllers\LoginController;
use App\Controllers\QuizController;
use App\Controllers\SubjectController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url){
    $router = new RouteCollector();

    // đăng nhập 
    // đăng xuất => LoginController và hàm logout
    $router->any('logout', [LoginController::class, 'logout']);
    // danh sách môn học - mon-hoc
    // SubjectController => index
    $router->get('mon-hoc', [SubjectController::class, 'index']);
    $router->get('mon-hoc/add-new', [SubjectController::class, 'addNew']);
    $router->post('mon-hoc/add-new', [SubjectController::class, 'saveAdd']);
    $router->get('mon-hoc/edit/{id}?', [SubjectController::class, 'editForm']);
    $router->post('mon-hoc/edit/{id}?', [SubjectController::class, 'saveEdit']);
    // {id} vị trí tham số đường dẫn
    $router->get('mon-hoc/xoa/{id}', [SubjectController::class, 'xoa']);

    // các bài quiz của môn học
    $router->get('bai-quiz', [QuizController::class, 'index']);
    $router->get('bai-quiz/tao-moi', [QuizController::class, 'addForm']);
    $router->post('bai-quiz/tao-moi', [QuizController::class, 'saveAdd']);
    $router->get('bai-quiz/cap-nhat/{id}?', [QuizController::class, 'editForm']);
    $router->post('bai-quiz/cap-nhat/{id}?', [QuizController::class, 'saveEdit']);
    $router->get('bai-quiz/xoa/{id}?', [QuizController::class, 'remove']);
    // các câu hỏi của 1 bài quiz
    // $router->get('cau-hoi', [QuestionController::class, 'index']);



    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    echo $response;
}


?>