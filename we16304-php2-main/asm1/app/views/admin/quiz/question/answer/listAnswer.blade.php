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
                        <a class="nav-link"
                            href="<?= BASE_URL . 'admin/question/list/' . $quiz_id . '/' . $sub_id ?>">Ds Question</a>
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
                    <th scope="col">Content</th>
                    <th scope="col">Is_correct</th>
                    <th><a href="<?= BASE_URL . 'admin/answer/add/' . $id . '/' . $quiz_id . '/' . $sub_id ?>">Tạo
                            mới</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listAnswerQuestion as $key => $value)

                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value->content ?></td>
                        <?php if($value->is_correct == 0){ ?>
                        <td>Đúng</td>
                        <?php }else{?>
                        <td>Sai</td>
                        <?php }?>
                        <td><a
                                href="<?= BASE_URL . 'admin/answer/edit/' . $value->id . '/' . $id . '/' . $quiz_id . '/' . $sub_id ?>">Sửa</a>
                        </td>
                        <td><a
                                href="<?= BASE_URL . 'admin/answer/remove/' . $value->id . '/' . $id . '/' . $quiz_id . '/' . $sub_id ?>">Xóa</a>
                        </td>
                    </tr>
                                        
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
