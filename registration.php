<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>تسجيل</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/login.css"/>
      
</head>
<body>
<?php
    require('_con.php');
  
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
 
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        
        $query="SELECT `email` FROM `users` WHERE  `email` ='$email'";
    $result   = mysqli_query($con, $query);
        if (mysqli_num_rows($result) >0) {    
        "<div class='alert alert-danger' style='width:100%;height:100% ;text-align:center;'>
                  هذه البريد مستخدم من قبل
                  <p class='link'>اضغط هنا <a href='registration.php'>ادخل الان</a> لا التسجل</p>
                  </div>";
}else {


        $query = "INSERT INTO `users`( username, password, email, creat_datetime)
                   VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result =mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form alert alert-info'>
                  <h3 class='text-cnter'>تم التسجيل بنجاح</h3><br/>
                  <p class='link text-cnter'>اضغط هنا <a href='login.php'>ادخل الان</a></p>
                  </div>
                                <script>
                    setTimeout(function(){window.location.href='login.php';},4000)     
                               </script>
                    ";
        } else {
            echo "<div class='form alert alert-info'>
                  <h3> Required fields are missing.</h3><br/>
                  <p class='link'>اضغط هنا <a href='registration.php'>سجل</a> اعد التسجيل</p>
                  </div>";
        }
   }} else {
?>
   <main class="form-signin">
    <form class="form" method="post" name="login">
    <img class="mb-4" src="0.jpg" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">login</h1>
    
        <div class="form-floating">
        <input type="text"  autofocus="autofocus" class="form-control" name="username" placeholder="الاسم" >
        <label>enter a name</label>
    </div>
    <div class="form-floating">
    <input type="email" class="form-control" name="email" id="floatingPassword" placeholder="ادجل ايميل" >
        <label for="floatingPassword" required>Password</label>
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
