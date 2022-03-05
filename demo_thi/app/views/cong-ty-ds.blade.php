<table>
    <thead>
        <th>ID</th>
        <th>Tên công ty</th>
        <th>Địa chỉ</th>
        <th>Logo</th>
    </thead>
    <tbody>
        @foreach ($congty as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->logo}}</td>
            </tr>
        @endforeach
    </tbody>
</table>