<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ScoreQuiz;
use App\Models\Subject;

session_start();
class UserController
{

    function indexSub()
    {
        $model = Subject::all();
        return view('user.subject.index', ['model' => $model]);
    }

    function indexQuiz($id)
    {
        $today = date('Y-m-d' . ' ' . 'h:i:s');

        $model = Quiz::where('subject_id', $id)->where('status', 1)->where('start_time', '<=', $today)->where('end_time', '>=', $today)->get();
        return view('user.quiz.index', ['model' => $model, 'sub_id' => $id]);
    }

    public function takeQuiz($id, $sub_id, $index = null)
    {
        $quiz = Quiz::where('id', $id)->first();

        $time = $quiz->duration_minutes;

        if ($index = null) {
            $index = '1';
        } else {
            $index = $index + 1;
        }
        $countList = Question::where('quiz_id', $id)->orderBy('id', 'DESC')->first();
        $questionQuiz = Question::where('quiz_id', $id)->where('id', $index)->first();
        $allQuestion = Question::where('quiz_id', $id)->get();
        if (empty($questionQuiz)) {
            foreach ($allQuestion as $key => $value) {
                $questionQuiz = Question::where('quiz_id', $id)->find($value->id);
                $index = $value->id;
                break;
            };
        };

        $answerQuiz = Answer::where('question_id', $index)->get();
        return view('user.quiz.take-quiz', [
            'questionQuiz' => $questionQuiz,
            'answerQuiz' => $answerQuiz, 'time' => $time,
            'countList' => $countList, 'index' => $index,
            'idQuiz' => $id, 'sub_id' => $sub_id
        ]);
    }

    public function saveScoreQuiz($id, $sub_id, $index)
    {

        $quiz = Quiz::where('id', $id)->first();

        $time = $quiz->duration_minutes;

        if ($index == null) {
            $index = '1';
        } else {
            $index = $index + 1;
        }

        $countList = Question::where('quiz_id', $id)->orderBy('id', 'DESC')->first();
        $questionQuiz = Question::where('quiz_id', $id)->where('id', $index)->first();

        

        if (!$questionQuiz) {
            while (true) {
                $index++;
                $questionQuiz = Question::where('quiz_id', $id)->where('id', $index)->first();
                if ($questionQuiz || $_POST['index'] == $countList->id) {
                    break;
                }
            }
        }

        $answerQuiz = Answer::where('question_id', $index)->get();
        if (isset($_POST['question_id'])) {
            $model = new ScoreQuiz();
            $scoreQuizDb = ScoreQuiz::where('quiz_id', $id)->where('question_id', $_POST['question_id'])->where('user_id',  $_SESSION['user_id'])->where('sub_id', $sub_id)->first();

            if (isset($_POST['question'])) {
                $question = $_POST['question'];
            } else {
                $question = 1;
            }

            if (isset($scoreQuizDb)) {
                // $dataUd = [
                //     'score_quiz' => $question,
                // ];
                $scoreQuizDb->score_quiz = $question;
                $scoreQuizDb->save();
            } else {

                $model->quiz_id = $id;
                $model->question_id = $_POST['question_id'];
                $model->score_quiz = $question;
                $model->user_id = $_SESSION['user_id'];
                $model->sub_id = $sub_id;

                $model->save();
            }
        }

        if ($_POST['index'] == $countList->id || isset($_GET['endGame'])) {
            $_SESSION['end_quiz'] = 'abc';
            header('location:' . BASE_URL . 'user/quiz/' . $sub_id);
            die;
        }


        return view('user.quiz.take-quiz', [
            'questionQuiz' => $questionQuiz,
            'answerQuiz' => $answerQuiz, 'time' => $time,
            'countList' => $countList, 'index' => $index,
            'idQuiz' => $id, 'sub_id' => $sub_id
        ]);
    }

    public function getScore($id)
    {
        $today = date('Y-m-d' . ' ' . 'h:i:s');

        $allQuiz = Quiz::where('subject_id', $id)->where('status', 1)->where('start_time', '<=', $today)->where('end_time', '>=', $today)->orderBy('name', 'ASC')->get();
        $result = [];

        foreach ($allQuiz as $key => $value) {
            $score = 0;
            $listScoreQuiz = ScoreQuiz::where('sub_id', $id)->where('quiz_id', $value->id)->where('user_id', $_SESSION['user_id'])->get();

            foreach ($listScoreQuiz as $key => $value) {
                $key++;
                if ($value->score_quiz == 0) {
                    $score++;
                }
            }
            $scoreQuiz = ($score * 10) / $key;
            array_push($result, $scoreQuiz);
        }
        return view('user.quiz.score-quiz', ['result' => $result, 'allQuiz' => $allQuiz, 'id' => $id]);
    }
}
