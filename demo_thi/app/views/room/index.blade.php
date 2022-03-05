<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Stt</th>
                <th>room_number</th>
                <th>building</th>
                <th>floor</th>
                <th>image</th>
                <th>status</th>
                <th>
                    <a href="{{ BASE_URL . 'rooms/add-form' }}" >Add New</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->room_number }}</td>
                    <td>
                        @php
                            $parentBuilding = $item->building;
                        @endphp
                        {{ $parentBuilding->name }}
                    </td>
                    <td>{{ $item->floor }}</td>
                    <td>
                        <img style="width: 60px" src="{{ PUBLIC_URL . 'images/' . $item->image }}" alt="">
                    </td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{BASE_URL . 'rooms/update-form/' . $item->id}} ">Sửa</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{BASE_URL . 'rooms/xoa/' . $item->id}} ">Xóa</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
