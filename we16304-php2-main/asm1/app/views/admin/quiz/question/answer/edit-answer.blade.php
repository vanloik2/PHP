<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>Sửa Answer</h1>
    <form action="<?= BASE_URL . 'admin/answer/save-edit/' . $answerEdit->id . '/' . $ques_id . '/' . $quiz_id . '/' . $sub_id ?>" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Content</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="content" value="<?= $answerEdit->content ?>">
        </div>
        <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="question_id" value="<?= $ques_id ?>">
        <div class="form-check">
            <input class="form-check-input" value="0" type="radio" name="correct" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Đáp án đúng
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" value="1" type="radio" name="correct" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Đáp án sai
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p class="report" style="color:red">
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
    </p>
</body>

</html>