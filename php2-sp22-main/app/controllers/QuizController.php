<?php
namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Subject;

class QuizController{
    public function index(){
        $quizs = Quiz::all();

        return view('quiz.index', [
            'quizs' => $quizs
        ]);


    }

    public function addForm(){

        $subjects = Subject::all();

        return view('quiz.addForm', ['subjects' => $subjects]);
    }

    public function saveAdd(){
        Quiz::create($_POST);
        header('location: ' . BASE_URL . 'bai-quiz');
    }

    public function editForm($id = null){

        $model = Quiz::find($id);
        $subjects = Subject::all();

        return view('quiz.editForm', ['model' => $model, 'subjects' => $subjects]);
    }

    public function saveEdit($id= null){
        $model = Quiz::find($id);
        $model->fill($_POST);
        $model->status = isset($_POST['status']) ? 1 : 0;
        $model->is_shuffle = isset($_POST['is_shuffle']) ? 1 : 0;
        $model->save();
        header('Location:' . BASE_URL . 'bai-quiz');
    }

}
?>