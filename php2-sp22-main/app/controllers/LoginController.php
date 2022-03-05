<?php

namespace App\Controllers;
class LoginController{

    public function logout(){
        // xóa session auth đi
        // unset là hàm xóa 1 phần tử khỏi mảng
        unset($_SESSION['auth']);
        // hàm header là hàm điều hướng trình duyệt sang 1 url mới
        header('location: ' . BASE_URL . 'login');
    }
}
?>