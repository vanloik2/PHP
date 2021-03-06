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
    <h1>Sửa Quiz</h1>
<form action="<?= BASE_URL . 'admin/quiz/luu-cap-nhat/' . $id . '/' . $sub_id ?>" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" value="<?= $quizEdit->name ?>" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  </div>
  <div class="mb-3">
    <input type="hidden" class="form-control" id="exampleInputPassword1" value="{{ $sub_id }}" name="subject_id">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">duration_minutes</label>
    <input type="number" class="form-control" value="<?= $quizEdit->duration_minutes ?>" id="exampleInputPassword1" name="duration_minutes">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Start_time</label>
    <input type="datetime-local" class="form-control" value="<?= date('Y-m-d\TH:i:s', strtotime($quizEdit->start_time)) ?>" id="exampleInputPassword1" name="start_time">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">End_time</label>
    <input type="datetime-local" class="form-control" value="<?= date('Y-m-d\TH:i:s', strtotime($quizEdit->end_time)) ?>" id="exampleInputPassword1" name="end_time">
  </div>
  <div class="form-check">
  <input class="form-check-input" value="1" type="radio" name="status" id="flexRadioDefault1" checked>
  <label class="form-check-label" for="flexRadioDefault1">
    Hiện
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
    Ẩn
  </label>
</div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<p class="report" style="color:red" >
  <?php
  if(isset($_SESSION['error'])){
    echo $_SESSION['error'];
    unset($_SESSION['error']);
  }
  ?>
</p>
</body>
</html>