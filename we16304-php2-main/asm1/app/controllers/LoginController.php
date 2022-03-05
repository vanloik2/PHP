<?php

namespace App\Controllers;

use App\Models\User;

session_start();

class LoginController
{
    public function Login()
    {
        return view('login.login');
    }

    public function checkLogin()
    {
        if (strlen(trim($_POST['email'])) == 0 || strlen(trim($_POST['passwd'])) == 0) {
            $_SESSION['error'] = "Thông tin trống !";
            header('Location:' . BASE_URL);
            die;
        } else {
            $email = $_POST['email'];
            $password = $_POST['passwd'];

            $pass = password_hash($password, PASSWORD_DEFAULT);

            $user = User::where('email', $email)->first();

            if (!$user || password_verify($password, $user->password) == false) {
                $_SESSION['error'] = "Thông tin không hợp lệ !";
                header('Location:' . BASE_URL);
                die;
            } else {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                if ($user->role_id == 2) {
                    header('Location:' . BASE_URL . 'user/subject');
                    die;
                } else {
                    $_SESSION['user_role_id'] = $user->role_id;
                    header('Location:' . BASE_URL . 'admin/mon-hoc');
                    die;
                }
            }
        }
    }

    public function signOut()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role_id']);
        header('Location:' . BASE_URL);
        die;
    }

    public function register()
    {
        return view('login.register');
    }

    public function handleRegister()
    {

        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['passwd'])) {
            $_SESSION['error'] = "Dữ liệu trống !";
            header('location:' . BASE_URL . 'register');
            die;
        }

        if (!$_FILES['avatar']) {
            $_SESSION['error'] = "Dữ liệu trống !";
            header('location:' . BASE_URL . 'register');
            die;
        }
        $file = $_FILES['avatar']['tmp_name'];
        $path =   './public/uploads/' . $_FILES['avatar']['name'];
        move_uploaded_file($file, $path);


        $model = new User();

        $model->name = $_POST['name'];
        $model->email = $_POST['email'];
        $model->password = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
        $model->role_id = $_POST['role'];
        $model->avatar = $_FILES['avatar']['name'];

        $model->save();
        $_SESSION['Dk_tc'] = 'abc';
        header('location:' . BASE_URL);
    }
}
