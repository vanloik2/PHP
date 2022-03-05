<?php

use App\Controllers\BuildingController;
use App\Controllers\RoomController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url){
    $router = new RouteCollector();

    $router->get('buildings', [BuildingController::class, 'index']);
    $router->get('buildings/xoa/{id}', [BuildingController::class, 'xoa']);
    $router->get('buildings/add-form', [BuildingController::class, 'addNew']);
    $router->post('buildings/save-add', [BuildingController::class, 'saveAdd']);
    $router->get('buildings/update-form/{id}', [BuildingController::class, 'updateForm']);
    $router->post('buildings/save-update/{id}', [BuildingController::class, 'saveUpdate']);

    $router->get('rooms', [RoomController::class, 'index']);
    $router->get('rooms/xoa/{id}', [RoomController::class, 'xoa']);
    $router->get('rooms/add-form', [RoomController::class, 'addNew']);
    $router->post('rooms/save-add', [RoomController::class, 'saveAdd']);
    $router->get('rooms/update-form/{id}', [RoomController::class, 'updateForm']);
    $router->post('rooms/save-update/{id}', [RoomController::class, 'saveUpdate']);

    

    // // đăng nhập 
    // // đăng xuất => LoginController và hàm logout
    // $router->any('logout', [LoginController::class, 'logout']);
    // // danh sách môn học - mon-hoc
    // // SubjectController => index
    // $router->get('mon-hoc', [SubjectController::class, 'index']);
    // // {id} vị trí tham số đường dẫn
    // $router->get('mon-hoc/xoa/{id}', [SubjectController::class, 'xoa']);

    // // các bài quiz của môn học
    // $router->get('bai-quiz', [QuizController::class, 'index']);
    // $router->get('bai-quiz/tao-moi', [QuizController::class, 'addForm']);
    // $router->post('bai-quiz/tao-moi', [QuizController::class, 'saveAdd']);
    // $router->get('bai-quiz/cap-nhat/{id}', [QuizController::class, 'editForm']);
    // $router->post('bai-quiz/cap-nhat/{id}', [QuizController::class, 'saveEdit']);
    // $router->get('bai-quiz/xoa/{id}', [QuizController::class, 'remove']);
    // các câu hỏi của 1 bài quiz
    // $router->get('cau-hoi', [QuestionController::class, 'index']);



    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    echo $response;
}


?>