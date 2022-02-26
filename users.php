<?php
include 'header.php';
$userqry=mysqli_query($config,"SELECT * FROM users");

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
        <div style="float: left;">Users</div>
        <div style="float: right; width:15%;"><a href="newuser.php"><img src="images/products.png" width="30" height="30" align="left">Add User</a></div>
    </div>

    <div style="width: 100%;" class="searchbar">
       
    </div>
    <div style="margin-top: 10px;margin-left:10px;">
        <?php
        while($userrow=mysqli_fetch_assoc($userqry)){
            $names=$userrow['fullnames'];
            $username=$userrow['username'];
            echo $names.' <a href=""><img src="images/edit.png" width="20" height="20"></a><br>';
        }
        ?>
    </div>
    <?php
    echo $result;
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>