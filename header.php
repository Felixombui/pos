<?php
session_start();
if(empty($_SESSION['username'])){
    header('location:login.php');
}
include 'config.php';
$cartqry=mysqli_query($config,"SELECT * FROM cart");
$cart=mysqli_num_rows($cartqry);
?>
<title>Macra POS</title>
<div class="header">
    <img src="images/POS_Logo.png" width="100" height="100">
    
</div>
<div class="subheader">
    <div style="width: 40%;float:left;margin-top:-10px;"><img src="images/profile.png" width="23" height="23" align="left"><?php echo $_SESSION['fullnames'] ?></div>
    <div style="width: 10%;float:right;margin-top:-10px;"><a href="cart.php" style="color: white;font-weight:bold;"><img src="images/emptycart.png" width="25" height="25" align="left"><?php echo $cart ?> | <a href="logout.php" style="color:white;"><b>Logout</b></a></a></div>
</div>