<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ PUBLIC_URL }}css/style.css">
</head>

<body>

    <div class="main" style="padding: 0px">

        <!-- Sign up form -->


        <!-- Sing in  Form -->
        <section class="sign-in" style="margin-bottom: 0px">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ PUBLIC_URL . 'uploads/' }}signin-image.jpg" alt="sing up image"></figure>
                        <a href="{{ BASE_URL . 'register' }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <?php
                        if (isset($_SESSION['Dk_tc'])) {
                            echo '<script>';
                            echo 'alert("Đăng ký thành công !")';
                            echo '</script>';
                            unset($_SESSION['Dk_tc']);
                        }
                        ?>
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" action="{{ BASE_URL . 'check-login' }}" class="register-form"
                            id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Email..." />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="passwd" id="your_pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="remember-me" style="color:red" class="label-agree-term">
                                        <?php
                                            if (!empty($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            }
                                        ?>
                                </label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
