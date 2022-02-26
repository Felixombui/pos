<?php
include 'config.php';
if(isset($_POST['login'])){
    $username=addslashes($_POST['username']);
    $pass=addslashes($_POST['password']);
    $encpass=md5($pass);
    $loginqry=mysqli_query($config,"SELECT * FROM users WHERE username='$username' AND password='$encpass'");
    if(mysqli_num_rows($loginqry)>0){
        //login successful
        $loginrow=mysqli_fetch_assoc($loginqry);
        session_start();
        $_SESSION['fullnames']=$loginrow['fullnames'];
        $_SESSION['username']=$loginrow['username'];
        $_SESSION['phonenumber']=$loginrow['phonenumber'];
        header('location:index.php');
    }else{
        $result='<div style="color:red;text-align:left;"><img src="images/error.png" width="23" height="23" align="left"> Login failed! Try again.</div>';
    }
}
?>
<form action="" method="post">
    <div class="loginform">
        <img src="images/POS_Logo.png" width="100" height="100">
        <input type="text" name="username" placeholder="Type your username..." required="required">
        <input type="password" name="password" placeholder="Type your password..." required="required">
        <input type="submit" name="login" value="Login">
        <div style="text-align: left;"><a href="recover.php">Forgot your password?</a></div>
        <?php echo $result ?>
    </div>
</form>
<?php
include 'styles.php';
?>