<form action="<?= BASE_URL . 'admin/mon-hoc/luu-tao-moi'?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="">Tên môn học</label>
        <input type="text" name="name"> <br>
        <input type="file" name="img" id="">

    </div>
    <div>
        <button type="submit">Lưu</button>
    </div>
</form>