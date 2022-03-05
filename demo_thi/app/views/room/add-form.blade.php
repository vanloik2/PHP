<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="{{ BASE_URL . 'rooms/save-add' }}" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Room number</label>
            <input type="text" name="room_number" placeholder="">
        </div>
        <div>
            <label for="">Building</label>
            <select name="building_id" id="">
                @foreach ($building as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">floor</label>
            <input type="text" name="floor" placeholder="">
        </div>

        <div>
            <label for="">Image</label>
            <input type="file" name="image" placeholder="">
        </div>
        <div>
            <label for="">Status</label>
            <input type="text" name="status" placeholder="">
        </div>
        <button>Save</button>
        </form>
    </div>
</body>
</html>