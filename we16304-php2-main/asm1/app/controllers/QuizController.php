<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ScoreQuiz;

session_start();
class QuizController
{

    public function index($id)
    {
        $quizs = Quiz::where('subject_id', $id)->where('status', '1')->get();

        if (!$quizs) {
            header('Location:' . BASE_URL . 'admin/quiz/tao-moi?id=' . $id);
            die;
        } else {
            return view('admin.quiz.list-quizs', ['quizs' => $quizs, 'sub_id' => $id]);
        }
    }

    public function takeQuiz($id, $sub_id, $index = null)
    {
        $quiz = Quiz::where('id', $id)->first();

        $today = date('Y-m-d' . ' ' . 'h:i:s');

        if ($today <= $quiz->start_time || $today >= $quiz->end_time) {
            $_SESSION['end-time'] = 'abc';
            header('Location:' . BASE_URL . 'quiz?id=' . $sub_id);
            die;
        }

        $time = $quiz->duration_minutes;

        if ($index = null) {
            $index = '1';
        } else {
            $index = $index + 1;
        }

        $countList = Question::where('quiz_id', $id)->orderBy('id', 'DESC')->first();
        $questionQuiz = Question::where('quiz_id', $id)->where('id', $index)->first();

        $answerQuiz = Answer::where('question_id', $index)->get();

        if (isset($_POST['question_id'])) {
            $model = new ScoreQuiz();
            $scoreQuizDb = ScoreQuiz::where('quiz_id', $id)->where('question_id', $_POST['question_id'])->where('user_id',  $_SESSION['user_id'])->where('sub_id', $sub_id)->first();

            if (isset($_POST['question'])) {
                $question = $_POST['question'];
            } else {
                $question = 0;
            }

            if (isset($scoreQuizDb)) {
                // $dataUd = [
                //     'score_quiz' => $question,
                // ];
                $scoreQuizDb->score_quiz = $question;
                $scoreQuizDb->save();
            } else {
                // $data = [
                //     'quiz_id' =>$id,
                //     'question_id' => $_POST['question_id'],
                //     'score_quiz' => $question,
                //     'user_id' => $_SESSION['user_id'],
                //     'sub_id' => $sub_id,
                // ];
                $model->quiz_id = $id;
                $model->question_id = $_POST['question_id'];
                $model->score_quiz = $question;
                $model->user_id = $_SESSION['user_id'];
                $model->sub_id = $sub_id;

                $model->save();
            }
        }

        if ($index - 1 == $countList->id || isset($_GET['endGame'])) {
            $_SESSION['end_quiz'] = 'abc';
            header('location:' . BASE_URL . 'mon-hoc');
            die;
        }

        if (!$questionQuiz) {
            header('location:' . BASE_URL . 'quiz/lam-bai?id=' . $id . '&index=' . $index . '&sub_id=' . $sub_id);
            die;
        }
        return view('quiz.quiz', [
            'questionQuiz' => $questionQuiz,
            'answerQuiz' => $answerQuiz, 'time' => $time,
            'countList' => $countList, 'index' => $index,
            'idQuiz' => $id, 'sub_id' => $sub_id
        ]);
    }

    public function updateTakeQuiz($id, $sub_id, $index)
    {

        $quiz = Quiz::where('id', $id)->first();

        $today = date('Y-m-d' . ' ' . 'h:i:s');

        if ($today <= $quiz->start_time || $today >= $quiz->end_time) {
            $_SESSION['end-time'] = 'abc';
            header('Location:' . BASE_URL . 'quiz?id=' . $sub_id);
            die;
        }

        $time = $quiz->duration_minutes;

        if ($index == null) {
            $index = '1';
        } else {
            $index = $index + 1;
        }

        $countList = Question::where('quiz_id', $id)->orderBy('id', 'DESC')->first();
        $questionQuiz = Question::where('quiz_id', $id)->where('id', $index)->first();

        $answerQuiz = Answer::where('question_id', $index)->get();

        if (isset($_POST['question_id'])) {
            $model = new ScoreQuiz();
            $scoreQuizDb = ScoreQuiz::where('quiz_id', $id)->where('question_id', $_POST['question_id'])->where('user_id',  $_SESSION['user_id'])->where('sub_id', $sub_id)->first();

            if (isset($_POST['question'])) {
                $question = $_POST['question'];
            } else {
                $question = 0;
            }

            if (isset($scoreQuizDb)) {
                // $dataUd = [
                //     'score_quiz' => $question,
                // ];
                $scoreQuizDb->score_quiz = $question;
                $scoreQuizDb->save();
            } else {
                // $data = [
                //     'quiz_id' =>$id,
                //     'question_id' => $_POST['question_id'],
                //     'score_quiz' => $question,
                //     'user_id' => $_SESSION['user_id'],
                //     'sub_id' => $sub_id,
                // ];
                $model->quiz_id = $id;
                $model->question_id = $_POST['question_id'];
                $model->score_quiz = $question;
                $model->user_id = $_SESSION['user_id'];
                $model->sub_id = $sub_id;

                $model->save();
            }
        }

        if ($index - 1 == $countList->id || isset($_GET['endGame'])) {
            $_SESSION['end_quiz'] = 'abc';
            header('location:' . BASE_URL . 'mon-hoc');
            die;
        }

        if (!$questionQuiz) {
            header('location:' . BASE_URL . 'quiz/lam-bai?id=' . $id . '&index=' . $index . '&sub_id=' . $sub_id);
            die;
        }
        return view('quiz.quiz', [
            'questionQuiz' => $questionQuiz,
            'answerQuiz' => $answerQuiz, 'time' => $time,
            'countList' => $countList, 'index' => $index,
            'idQuiz' => $id, 'sub_id' => $sub_id
        ]);
    }

    public function addQuiz($id)
    {
        return view('admin.quiz.add-quiz', ['sub_id' => $id]);
    }

    public function saveAddQuiz($id)
    {
        if (!empty($_POST['name']) && !empty($_POST['duration_minutes']) && !empty($_POST['start_time']) && !empty($_POST['end_time'])) {
            $model = new Quiz();
            $model->name = $_POST['name'];
            $model->subject_id = $_POST['subject_id'];
            $model->duration_minutes = $_POST['duration_minutes'];
            $model->start_time = $_POST['start_time'];
            $model->end_time = $_POST['end_time'];

            $model->save();
            header('location:' . BASE_URL . 'admin/quiz/' . $id);
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/quiz/tao-moi/' . $id);
            die;
        }
    }

    public function handleQuiz($id)
    {

        $allQuiz = Quiz::where('subject_id', $id)->orderBy('name', 'ASC')->get();
        return view('admin.quiz.handle-quiz', ['allQuiz' => $allQuiz, 'sub_id' => $id]);
    }

    public function editQuiz($id, $sub_id)
    {
        $quizEdit = Quiz::where('id', $id)->first();
        return view('admin.quiz.edit-quiz', ['quizEdit' => $quizEdit, 'sub_id' => $sub_id, 'id' => $id]);
    }

    public function saveEditQuiz($id, $sub_id)
    {
        if (!empty($_POST['name']) && !empty($_POST['duration_minutes']) && !empty($_POST['start_time']) && !empty($_POST['end_time'])) {
            $quizEdit = Quiz::where('id', $id)->first();

            $quizEdit->name = $_POST['name'];
            $quizEdit->subject_id = $_POST['subject_id'];
            $quizEdit->duration_minutes = $_POST['duration_minutes'];
            $quizEdit->start_time = $_POST['start_time'];
            $quizEdit->end_time = $_POST['end_time'];
            $quizEdit->status = $_POST['status'];

            $quizEdit->save();
            header('location:' . BASE_URL . 'admin/quiz/' . $sub_id);
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/quiz/cap-nhat/' . $id . '/' . $sub_id);
            die;
        }
    }

    public function removeQuiz($id , $sub_id)
    {
        $listQuestion = Question::where('quiz_id', '=', $id)->get();
        foreach ($listQuestion as $key => $value) {
            $listAns = Answer::where('question_id', $value->id)->get();
            foreach ($listAns as $key => $value1) {
                Answer::destroy($value1->id);
            }
            Question::destroy($value->id);
        }
        Quiz::destroy($id);
        header('location:' . BASE_URL . 'admin/quiz/' . $sub_id);
        die;
    }

    public function addQuestion($id, $sub_id,)
    {
        return view('admin.quiz.question.new-question', ['id' => $id, 'sub_id' => $sub_id]);
    }
    public function editQuestion($id, $quiz_id, $sub_id)
    {
        $questionEdit = Question::where('id', $id)->first();
        return view(
            'admin.quiz.question.edit-question',
            ['quiz_id' => $quiz_id, 'sub_id' => $sub_id, 'ques_id' => $id, 'questionEdit' => $questionEdit]
        );
    }

    //
    public function saveAddQuestion($id, $sub_id)
    {
        if (!empty($_POST['name']) && !empty($_POST['quiz_id'])) {
            $model = new Question();
            $model->name = $_POST['name'];
            $model->quiz_id = $_POST['quiz_id'];
            $model->save();
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/question/add/' . $id . '/' . $sub_id );
            die;
        }
        header('location:' . BASE_URL . 'admin/question/list/' . $id . '/' . $sub_id);
        die;
    }

    public function saveEditQuestion($id, $quiz_id, $sub_id)
    {
        if (!empty($_POST['name']) && !empty($_POST['quiz_id'])) {
            $questionEdit = Question::where('id',  $id)->first();
            $questionEdit->name = $_POST['name'];
            $questionEdit->quiz_id = $_POST['quiz_id'];
            $questionEdit->save();
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/question/edit/' . $id . '/' . $quiz_id . '/' . $sub_id);
            die;
        }
        header('location:' . BASE_URL . 'admin/question/list/' . $quiz_id . '/' . $sub_id);
        die;
    }

    public function deleteQuestion($id, $quiz_id, $sub_id)
    {
        Answer::destroy('question_id',  $id);
        Question::destroy($id);
        header('location:' . BASE_URL . 'admin/question/list/' . $quiz_id . '/' . $sub_id);
        die;
    }

    public function indexQues($id, $sub_id)
    {

        $listQuestionQuiz = Question::where('quiz_id', $id)->get();

        if (!$listQuestionQuiz) {
            if (isset($_SESSION['user_role_id'])) {
                header('Location:' . BASE_URL . 'admin/question/add/' . $id . '&sub_id=' . $sub_id);
                die;
            }
            header('location:' . BASE_URL . 'admin/quiz/list' . $sub_id);
            die;
        }

        return view('admin.quiz.question.listQuestion', [
            'listQuestionQuiz' => $listQuestionQuiz,
            'quiz_id' => $id, 'sub_id' => $sub_id
        ]);
    }

    public function indexAns($id, $quiz_id, $sub_id)
    {
        $listAnswerQuestion = Answer::where('question_id',  $id)->get();

        if (!$listAnswerQuestion) {
            if (isset($_SESSION['user_role_id'])) {
                header('Location:' . BASE_URL . 'admin/answer/add/' . $id . '/' . $quiz_id . '/' . $sub_id);
                die;
            }
            header('location:' . BASE_URL . 'admin/question/list/' . $id . '/' . $quiz_id . '/' . $sub_id);
            die;
        }
        return view(
            'admin.quiz.question.answer.listAnswer',
            [
                'listAnswerQuestion' => $listAnswerQuestion, 'quiz_id' => $quiz_id, 'sub_id' => $sub_id,
                'id' => $id
            ]
        );
    }

    public function addNewAnswer($id, $quiz_id, $sub_id)
    {
        return view(
            'admin.quiz.question.answer.new-answer',
            ['quiz_id' => $quiz_id, 'sub_id' => $sub_id, 'id' => $id]
        );
    }

    //
    public function saveAddAnswer($id, $quiz_id, $sub_id)
    {
        if (!empty($_POST['content']) && !empty($_POST['question_id'])) {
            $model = new Answer();
            $model->content = $_POST['content'];
            $model->question_id = $_POST['question_id'];
            $model->is_correct = $_POST['correct'];

            $model->save();
            header('location:' . BASE_URL . 'admin/answer/list/' . $id . '/' . $quiz_id . '/' . $sub_id );
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/answer/add/' . $id . '/' . $quiz_id . '/' . $sub_id );
            die;
        }
    }

    public function editAnswer($id, $ques_id, $quiz_id, $sub_id)
    {
        $answerEdit = Answer::where('id',  $id)->first();
        return view(
            'admin.quiz.question.answer.edit-answer',
            [
                'quiz_id' => $quiz_id, 'ques_id' => $ques_id, 'sub_id' => $sub_id,
                'id' => $id, 'answerEdit' => $answerEdit
            ]
        );
    }

    public function saveEditAnswer($id, $ques_id, $quiz_id, $sub_id)
    {
        if (!empty($_POST['content']) && !empty($_POST['question_id'])) {
            $answerEdit = Answer::where('id', $id)->first();
            $answerEdit->content = $_POST['content'];
            $answerEdit->question_id = $_POST['question_id'];
            $answerEdit->is_correct = $_POST['correct'];
            $answerEdit->save();
            header('location:' . BASE_URL . 'admin/answer/list/' . $ques_id . '/' . $quiz_id . '/' . $sub_id);
        } else {
            $_SESSION['error'] = 'Thông tin trống !';
            header('location:' . BASE_URL . 'admin/answer/edit/' . $id . '/' . $ques_id . '/' . $quiz_id . '/' . $sub_id);
            die;
        }
    }

    public function deleteAnswer($id, $ques_id, $quiz_id, $sub_id)
    {
        Answer::destroy($id);
        header('location:' . BASE_URL . 'admin/answer/list/' . $ques_id . '/' . $quiz_id . '/' . $sub_id);
        die;
    }
}
