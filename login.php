<?php
  session_start();
?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>تسجل دخول</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/login.css"/>
      
</head>
<body>
<?php
    require('_con.php');
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
    
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
        
            header("Location: upload.php");
        } else {
            echo "<div class='form alert-info'>
                  <h3>اسم المستخدم اوكلمة المرور غير صحيحة</h3><br/>
                  <p class='link'>اضغط هنا <a href='login.php'>تسجيل</a> مره اخرى</p>
                  </div>";
        }
    } else {
?>

<main class="form-signin">
    <form class="form" method="post" name="login">
    <img class="mb-4" src="0.jpg" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">login</h1>
    
        <div class="form-floating">
        <input type="text" class="form-control" name="username" placeholder="الاسم" >
        <label for="floatingInput" required>enter a name</label>
    </div>
    <div class="form-floating">
    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="باسورد" >
        <label for="floatingPassword" required>Password</label>
    </div>
        <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">login</button>
        <p class="link">لايوجد لديك حساب <a href="registration.php">عضو جديد</a></p>
        <p class="mt-5 mb-3 text-muted">&copy; 2022.2023</p>
  </form>
    </main>
<?php
    }
?>
</body>
</html>
