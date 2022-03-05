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
    <h1>Thêm Quiz</h1>
<form action="<?= BASE_URL . 'admin/quiz/luu-tao-moi/' . $sub_id ?>" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  </div>
  <div class="mb-3">
    <input type="hidden" class="form-control" id="exampleInputPassword1" value="{{ $sub_id }}" name="subject_id">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">duration_minutes</label>
    <input type="number" class="form-control" id="exampleInputPassword1" name="duration_minutes">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Start_time</label>
    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="start_time">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">End_time</label>
    <input type="datetime-local" class="form-control" id="exampleInputPassword1" name="end_time">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn btn-light"><a class="nav-link" href="{{BASE_URL . 'admin/quiz/' . $id . '/' . $sub_id}}">Ds Quiz</a></button>

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