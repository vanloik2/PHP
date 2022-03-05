<form action="<?= BASE_URL . 'admin/mon-hoc/luu-cap-nhat/'. $id?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="">Tên danh mục</label>
        <input type="text" name="name" value="<?= $model->name ?>"> <br>
        <input type="file" name="img" id="">
        <input type="hidden" value="<?= $model->img ?>" name="image" >
    </div>
    <div>
        <button type="submit">Lưu</button>
    </div>
</form>