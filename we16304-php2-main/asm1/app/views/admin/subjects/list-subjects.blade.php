
  @extends('layout.main')
  @section('content')
  
  <table class="table table-hover table-striped " style="text-transform: capitalize ">
    <thead>
      <tr>
        <th scope="col">Mã Môn</th>
        <th scope="col">Tên Môn</th>
        <th scope="col">Image</th>
        <?php if(!empty($_SESSION['user_role_id'])){ ?>
          <th scope="col"><a href="<?= BASE_URL . 'admin/mon-hoc/tao-moi' ?>">Tạo Mới</a></th>
        <?php } ?> 
      </tr>
    </thead>
    <tbody>
      @foreach ($subjects as $key => $value)
        
      <tr>
        <td><?= $key+1?></td>
        <td><a href="<?= BASE_URL . 'admin/quiz/' . $value->id ?>"><?= $value->name ?></a></td>
        <td><img style="width: 60px" src="{{ PUBLIC_URL . 'uploads/' . $value->img }}" alt=""></td>
            <td><a href="<?= BASE_URL . 'admin/mon-hoc/cap-nhat/' . $value->id ?>">Sửa</a></td>
            <td><a href="<?= BASE_URL . 'admin/mon-hoc/xoa/' . $value->id ?>">Xóa</a></td>
      </tr>
                 
      @endforeach 
    </tbody>
    
  </table>

  @endsection

