<?php

use App\Controllers\LoginController;
use App\Controllers\SubjectController;
use App\Controllers\QuizController;
use App\Controllers\UserController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url)
{


    $router = new RouteCollector();

    $router->get('header', function () {
        return view('display.dsheader');
    });
    $router->get('test-layout', function () {
        return view('layout.main');
    });


    // filter check login
    $router->filter('auth', function () {
        if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
            header('location: ' . BASE_URL . 'login');
            die;
        }
    });
    // Login
    $router->get('/', [LoginController::class, 'login']);
    $router->post('check-login', [LoginController::class, 'checkLogin']);
    $router->get('sign-out', [LoginController::class, 'signOut']);
    $router->get('register', [LoginController::class, 'register']);
    $router->post('handleRegister', [LoginController::class, 'handleRegister']);


    // Subjects
    $router->group(['prefix' => 'admin'], function ($router) {

        $router->group(['prefix' => 'mon-hoc'], function ($router) {

            $router->get('/', [SubjectController::class, 'index']);
            $router->get('tao-moi', [SubjectController::class, 'addForm']);
            $router->post('luu-tao-moi', [SubjectController::class, 'saveAdd']);
            $router->get('cap-nhat/{id}', [SubjectController::class, 'editForm']);
            $router->post('luu-cap-nhat/{id}?', [SubjectController::class, 'saveEdit']);
            $router->get('xoa/{id}', [SubjectController::class, 'remove']);
        });

        //quiz
        $router->get('quiz/tao-moi/{id}', [QuizController::class, 'addQuiz']);
        $router->post('quiz/luu-tao-moi/{id}', [QuizController::class, 'saveAddQuiz']);
        $router->get('quiz/handle-quiz/{id}', [QuizController::class, 'handleQuiz']);
        $router->get('quiz/cap-nhat/{id}/{sub_id}', [QuizController::class, 'editQuiz']);
        $router->post('quiz/luu-cap-nhat/{id}/{sub_id}', [QuizController::class, 'saveEditQuiz']);
        $router->get('quiz/remove/{id}/{sub_id}', [QuizController::class, 'removeQuiz']);

        $router->group(['prefix' => 'quiz'], function ($router) {
            $router->get('/{id}?', [QuizController::class, 'index']);
        });

        //question
        $router->group(['prefix' => 'question'], function ($router) {
            $router->get('list/{id}/{sub_id}', [QuizController::class, 'indexQues']);
            $router->get('add/{id}/{sub_id}', [QuizController::class, 'addQuestion']);
            $router->post('save-add/{id}/{sub_id}', [QuizController::class, 'saveAddQuestion']);
            $router->get('edit/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'editQuestion']);
            $router->post('save-edit-question/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'saveEditQuestion']);
            $router->get('remove/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'deleteQuestion']);
        });
        //answer question

        $router->group(['prefix' => 'answer'], function ($router) {
            $router->get('list/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'indexAns']);
            $router->get('add/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'addNewAnswer']);
            $router->post('save-add/{id}/{quiz_id}/{sub_id}', [QuizController::class, 'saveAddAnswer']);
            $router->get('edit/{id}/{ques_id}/{quiz_id}/{sub_id}', [QuizController::class, 'editAnswer']);
            $router->post('save-edit/{id}/{ques_id}/{quiz_id}/{sub_id}', [QuizController::class, 'saveEditAnswer']);
            $router->get('remove/{id}/{ques_id}/{quiz_id}/{sub_id}', [QuizController::class, 'deleteAnswer']);
        });
    });
    //user

    $router->group(['prefix' => 'user'], function ($router) {
        $router->get('subject/', [UserController::class, 'indexSub']);
        $router->get('quiz/{id}?', [UserController::class, 'indexQuiz']);
        $router->get('take-quiz/{id}/{sub_id}/{index}?', [UserController::class, 'takeQuiz']);
        $router->post('save-score-quiz/{id}/{sub_id}/{index}?', [UserController::class, 'saveScoreQuiz']);
        $router->get('quiz/score/{id}', [UserController::class, 'getScore']);
    });

    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    echo $response;
}
