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
        <form action="{{ BASE_URL . 'buildings/save-update/' . $model->id }}" method="post" enctype="multipart/form-data">
            <div>
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $model->name }}" placeholder="">
            </div>
            <div>
                <label for="">Image</label>
                <input type="file" name="image" placeholder="">
                <input type="hidden" value="{{ $model->image }}" name="logo_db">
            </div>
            <div>
                <label for="">Address</label>
                <input type="text" name="address" value="{{ $model->address }}" placeholder="">
            </div>
            <button>Save</button>
            </form>
    </div>
</body>
</html>