<?php

session_start();

include '../config/database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek pw
        $item = mysqli_fetch_assoc($result);
        if ($item["password"] == $password) {
            if ($item["role"] == "admin") {
                $_SESSION["nama"] = $item['nama'];
                $_SESSION["role"] = $item['role'];
                $_SESSION["title"] = $item['role'];
                header("Location: ../src/admin/index.php");
            } elseif ($item["role"] == "manager") {
                $_SESSION["nama"] = $item['nama'];
                $_SESSION["role"] = $item['role'];
                $_SESSION["title"] = $item['role'];
                header("Location: ../src/manager/index.php");
            } elseif ($item["role"] == "kasir") {
                $_SESSION["nama"] = $item['nama'];
                $_SESSION["role"] = $item['role'];
                $_SESSION["title"] = $item['role'];
                header("Location: ../src/kasir/index.php");
            }
        }
    }

    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- theme color in mobile responsive -->
    <meta name="theme-color" content="cyan">
    <!-- end of color in mobile responsive -->

    <!-- favicon -->
    <link rel="icon" href="../public/img/logo.png">
    <!-- endfavicon -->

    <!-- cdn bootstrap 5 link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- end cdn bootstrap 5 link -->

    <!-- link login css -->
    <link rel="stylesheet" href="../public/css/login.css">
    <!-- end of link login css -->

    <!-- link splash css -->
    <link rel="stylesheet" href="../public/css/splash.css">
    <!-- end of link splash css -->

    <!-- AOS link -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- end of AOS link -->

    <!-- title of cafe shop app -->
    <title>Login | CSO</title>
    <!-- end of title -->
</head>
<!-- end of head -->

<body oncontextmenu="return false;">

    <!-- splash screen -->
    <div class="splash" style="background-color: #fff;">
        <img src="../public/img/logo.png" class="fade-in">
    </div>
    <!-- end splash screen -->

    <div class="banner d-flex" style="width: 100%; height: 100vh;">
        <div class="col-8 box-img bg-primary">
            <img src="../public/img/login.jpg" alt="login.bg" class="bg">
        </div>
        <div class="col-4 forum d-flex flex-column align-items-center">
            <img src="../public/img/logo.png" alt="" class="bg_forum">
            <h3 class="mt-4 mb-0 text-center">Cafe Shop Online</h3>
            <p class="text-secondary text-center">- Login Page -</p>

            <?php if (isset($error)) : ?>
                <span class="text-danger alert alert-danger mb-0">username atau password salah</span>
            <?php endif; ?>

            <form action="" method="POST" style="width: 100%;" class="mx-2 mt-5">

                <span>Username <span class="text-danger">*</span></span>
                <input type="text" class="form-control mb-4" autofocus required placeholder="Masukan username kamu" name="username">

                <span>Password <span class="text-danger">*</span></span>
                <input type="password" class="form-control" required placeholder="Masukan password kamu" name="password">

                <button class="btn btn-primary mt-4" style="width: 100%;" name="login">Masuk</button>
            </form>
        </div>
    </div>

    <!-- script cdn bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- end of script cdn bootstrap 5 -->

    <!-- script AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- end of script AOS -->

    <!-- function script AOS -->
    <script>
        AOS.init();
    </script>
    <!-- end of function script AOS -->

    <!-- script splash screen -->
    <script src="../public/js/splash.js"></script>
    <!-- end script splash screen -->
</body>

</html>