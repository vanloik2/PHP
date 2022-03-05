<?php
namespace App\Controllers;
use App\Models\Subject;
class SubjectController{
    public function index(){
        // lấy ra tất cả các bản ghi của bảng subjects
        $subjects = Subject::all(); // Tên class::all() => 1 mảng gồm các phần tử là các dòng trong table subjects
        // hàm view có 2 tham số:
        // tham số 1: đường dẫn đến file view
        // tham số 2 là dữ liệu sẽ được sử dụng ở file view
        return view('mon-hoc.index', [
            'monhoc' => $subjects // biến được sử dụng ở ngoài file view tên là $monhoc
        ]);
    }

    public function xoa($id){
        // ::destroy xóa bản ghi dựa vào id
        Subject::destroy($id);
        header('location: ' . BASE_URL . 'mon-hoc');
    }

    public function addNew(){
        return view('mon-hoc.add-new');
    }
    public function saveAdd(){
        Subject::create($_POST);
        header('location: ' . BASE_URL . 'mon-hoc');
    }
    public function editForm($id){
        $model = Subject::find($id);
        return view('mon-hoc.edit-form', ['model'=>$model]);
    }
    public function saveEdit($id){
        $model = Subject::find($id);
        $model->fill($_POST);
        $model->save();
        header('location: ' . BASE_URL . 'mon-hoc');
    }
}
?>