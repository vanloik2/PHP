<table>
    <thead>
        <th>#</th>
        <th>Môn học</th>
        <th>Tên Quiz</th>
        <th>Thời gian</th>
        <th>Thời gian bắt đầu</th>
        <th>Thời gian kết thúc</th>
        <th>Trạng thái</th>
        <th>sb</th>
        <th>question</th>
        <th>Đảo câu</th>
        <th>
            <a href="{{ BASE_URL . 'bai-quiz/tao-moi'}}"></a>
        </th>
    </thead>
    <tbody>
        @foreach ($quizs as $q)
            <tr>
                <td>{{$loop->iteration + 1}}</td>
                <td>
                    @php
                        $parentSubject = $q->subject;
                    @endphp
                    @if ($parentSubject != null)
                        {{$parentSubject->name}}
                    @endif
                </td>
                <td>{{$q->name}}</td>
                <td>{{$q->duration_minutes}}</td>
                <td>{{$q->start_time}}</td>
                <td>{{$q->end_time}}</td>
                <td>{{$q->status == 1 ? "Active" : "Inactive"}}</td>
                <td>{{count($q->question)}}</td>
                <td>{{$q->question}}</td>
                <td>{{$q->is_shuffle == 1 ? "Có" : "Không"}}</td>
                <td>
                    <a href="{{BASE_URL . 'bai-quiz/cap-nhat/' . $q->id}}">Sua</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>