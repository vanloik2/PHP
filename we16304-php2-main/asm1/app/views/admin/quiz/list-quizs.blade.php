@extends('layout.main')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= BASE_URL . 'admin/mon-hoc' ?>">Môn học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . 'admin/quiz/handle-quiz/' . $sub_id ?>">Xử lí Quiz</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
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
                    <th scope="col">Tên Quiz</th>
                    <th><a href="<?= BASE_URL . 'admin/quiz/tao-moi/' . $sub_id ?>">Tạo mới</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizs as $key => $value)
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><a
                                href="<?= BASE_URL . 'admin/question/list/' . $value->id . '/' . $sub_id ?>"><?= $value->name ?></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
@endsection
