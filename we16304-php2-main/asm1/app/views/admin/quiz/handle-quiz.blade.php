@extends('layout.main')
@section('content')

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
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

                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Quiz</th>
                    <th scope="col">Duration_minutes</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allQuiz as $key => $value)
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $value->name ?></td>
                    <td><?= $value->duration_minutes ?></td>
                    <td><?= $value->start_time ?></td>
                    <td><?= $value->end_time ?></td>
                    <td><a href="<?= BASE_URL . 'admin/quiz/cap-nhat/' . $value->id . '/' . $sub_id ?>">Sửa</a></td>
                    <td><a href="<?= BASE_URL . 'admin/quiz/remove/' . $value->id . '/' . $sub_id ?>">Xóa</a></td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </body>
@endsection
