<?php
include 'header.php';
if(isset($_POST['submit'])){
    $fullnames=addslashes($_POST['fullnames']);
    $phonenumber=addslashes($_POST['phonenumber']);
    $username=addslashes(($_POST['username']));
    $password=addslashes($_POST['password']);
    $rpassword=addslashes($_POST['rpassword']);
    if($password==$rpassword){
        $encpass=md5($password);
        //check if user exists
        $usrqry=mysqli_query($config,"SELECT * FROM users WHERE username='$username'");
        if(mysqli_num_rows($usrqry)>0){
            $result='<img src="images/error.png" width="23" height="23" align="left">The username you entered already exists!';
        }else{
            //add user to table
            if(mysqli_query($config,"INSERT INTO users(fullnames,phonenumber,username,`password`) VALUES('$fullnames','$phonenumber','$username','$encpass')")){
                $result='<img src="images/success.png" width="23" height="23" align="left"> Account has been created successfully.';
            }
        }
    }else{
        $result='<img src="images/error.png" width="23" height="23" align="left">Error$ Passwords do not match!';
    }
}

?>
<div class="leftmenu">
    <table width="100%">
        <tr><td><a href="index.php"><img src="images/store.png" width="23" height="23" align="left"> Home</a></td></tr>
        <tr><td><a href="categories.php"><img src="images/products.png" width="23" height="23" align="left"> Categories</a></td></tr>
        <tr><td><a href="items.php"><img src="images/AddDb.png" width="28" height="28" align="left"> Items</a></td></tr>
        <tr><td><a href="stocks.php"><img src="images/db.png" width="23" height="23" align="left"> Stocks</a></td></tr>
        <tr><td><a href="cart.php"><img src="images/emptycart.png" width="23" height="23" align="left"> Cart (<b style="color: white;"><?php echo $cart ?></b>)</a></td></tr>
        <tr><td><a href="Sales.php"><img src="images/edit.png" width="23" height="23" align="left"> Sales</a></td></tr>
        <tr><td><a href="users.php"><img src="images/user.png" width="23" height="23" align="left"> Users</a></td></tr>
    </table>
</div>
<div class="right">
    <div class="rightheader">
        <div style="float: left;">New Users</div>
    </div>

    <div style="width: 100%;" class="searchbar">
       
    </div>
    <div style="margin-top: 10px;margin-left:10px;">
        <div class="dataform">
            <form method="post">
                <input type="text" name="fullnames" placeholder="Enter Full Names..." required="required">
                <input type="text" name="phonenumber" placeholder="Enter user phone number..." required="required">
                <input type="text" name="username" placeholder="Enter username..." required="required">
                <input type="password" name="password" placeholder="Create a password..." required="required">
                <input type="password" name="rpassword" placeholder="Confirm password..." required="required">
                <input type="submit" name="submit" value="Add User">
            </form>
            <?php echo $result ?>
        </div>
    </div>
    <?php
   
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>