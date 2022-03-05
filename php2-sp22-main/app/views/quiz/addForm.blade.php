<form action="" method="POST">
    <div>
        <label for="">Tên Quiz</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="">Môn học</label>
        <select name="subject_id">
            @foreach ($subjects as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="">Thời gian bắt đầu</label>
        <input type="datetime-local" name="start_time" id="">
    </div>
    <div>
        <label for="">Thời gian kết thúc</label>
        <input type="datetime-local" name="end_time" id="">
    </div>
    <div>
        <label for="">Thời gian làm bài</label>
        <input type="number" name="duration_minutes" id="">
    </div>
    <div>
        <input type="checkbox" name="active" value="1" id=""> Active
        <input type="checkbox" name="status" value="1" id=""> Active
    </div>
    <div>
        <input type="checkbox" name="is_shuffle" value="1" id=""> Đảo câu
    </div>
    <div>
        <button type="submit">Lưu</button>
    </div>
</form>