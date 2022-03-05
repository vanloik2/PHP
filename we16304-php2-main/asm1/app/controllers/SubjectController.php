<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ScoreQuiz;
use App\Models\Subject;

session_start();

class SubjectController
{
    public function index()
    {

        $subjects = Subject::all();
        return view('admin.subjects.list-subjects', ['subjects' => $subjects]);
    }

    public function addForm()
    {
        return view('admin.subjects.add-form');
    }

    public function saveAdd()
    {
        $file = $_FILES['img']['tmp_name'];
        $path = "./public/uploads/".$_FILES['img']['name'];
        move_uploaded_file($file, $path);

        $model = new Subject();
        $model->name = $_POST['name'];
        $model->img = $_FILES['img']['name'];
        $model->save();
        header('location: ' . BASE_URL . 'admin/mon-hoc');
        die;
    }

    public function editForm($id)
    {
        $model = Subject::where('id', '=', $id)->first();
        if (!$model) {
            header('Location:' . BASE_URL . 'admin/mon-hoc');
            die;
        }
        return view('admin.subjects.edit-form', ['model' => $model, 'id' => $id]);
    }

    public function saveEdit($id)
    {
        $image = $_FILES['img']['name'];
        
        $file = $_FILES['img']['tmp_name'];
        $path = "./public/uploads/".$_FILES['img']['name'];
        move_uploaded_file($file, $path);

        if(!$image){
            $image == $_POST['image'];
        }
        $model = Subject::where('id', $id)->first();
        if (!$model) {
            header('Location:' . BASE_URL . 'admin/mon-hoc');
            die;
        }
        $model->name = $_POST['name'];
        $model->img = $image;
        $model->save();
        header('location: ' . BASE_URL . 'admin/mon-hoc');
        die;
    }



    public function remove($id)
    {
        $listQuiz = Quiz::where('subject_id', $id)->get();
        foreach ($listQuiz as $key => $value) {
            $listQuestion = Question::where('quiz_id', $value->id)->get();
            foreach ($listQuestion as $key => $value1) {
                $listAns = Answer::where('question_id', $value1->id)->get();
                foreach ($listAns as $key => $value2) {
                    Answer::destroy($value2->id);
                }
                Question::destroy($value1->id);
            }
            Quiz::destroy($value->id);
        }
        Subject::destroy($id);
        header('location: ' . BASE_URL . 'admin/mon-hoc');
        die;
    }
}
