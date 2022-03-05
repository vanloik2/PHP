<table>
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>sl Quiz</th>
        <th>
            <a href="{{BASE_URL . 'mon-hoc/add-new'}}">Tạo mới</a>
        </th>
        <tbody>
            @foreach($monhoc as $mh)
            <tr>
                <td>{{$mh->id}}</td>
                <td>{{$mh->name}}</td>
                <td>{{count($mh->quizs)}}</td>
                <td>
                    <a href="{{BASE_URL . 'mon-hoc/edit/' . $mh->id}}">Sửa</a>
                    <a href="{{BASE_URL . 'mon-hoc/xoa/' . $mh->id}}">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </thead>
</table>