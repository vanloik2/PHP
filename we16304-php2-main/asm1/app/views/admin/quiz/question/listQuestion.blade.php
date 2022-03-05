@extends('layout.main')
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= BASE_URL . 'admin/mon-hoc' ?>">Môn học</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . 'admin/quiz/' . $sub_id ?>">Ds Quiz</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
<div class="list-subjects">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Stt</th>
        <th scope="col">Tên Question</th>
          <th><a href="<?= BASE_URL . 'admin/question/add/' . $quiz_id . '/' . $sub_id ?>">Tạo mới</a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listQuestionQuiz as $key => $value) { ?>
        <tr>
          <td><?= $key + 1 ?></td>
          <td><a href="<?= BASE_URL . 'admin/answer/list/' . $value->id . '/' . $quiz_id . '/' . $sub_id  ?>"><?= $value->name  ?></a></td>
          <td><a href="<?= BASE_URL . 'admin/question/edit/' . $value->id . '/' . $quiz_id . '/' . $sub_id  ?>">Sửa</a></td>
          <td><a href="<?= BASE_URL . 'admin/question/remove/' . $value->id . '/' . $quiz_id . '/' . $sub_id  ?>">Xóa</a></td>
        </tr>
      <?php } ?>
    </tbody>

  </table>
</div>
@endsection