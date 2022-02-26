<?php
include 'header.php';
$catqry=mysqli_query($config,"SELECT * FROM categories");
$categories=mysqli_num_rows($catqry);
$itmsqry=mysqli_query($config,"SELECT * FROM items");
$items=mysqli_num_rows($itmsqry);
$countitms=0;
while($itmrow=mysqli_fetch_assoc($itmsqry)){
    $itemname=$itmrow['itemname'];
    $stkqry=mysqli_query($config,"SELECT * FROM items WHERE itemname='$itemname' ORDER BY id DESC LIMIT 1");
    $stkrow=mysqli_fetch_assoc($stkqry);
    if($stkrow['stockbalance']>0){
        $countitms=$countitms+1;
    }
    
}
$userqry=mysqli_query($config,"SELECT * FROM users");
$users=mysqli_num_rows($userqry);
$slsqry=mysqli_query($config,"SELECT * FROM salesid");
$sales=mysqli_num_rows($slsqry);
$invqry=mysqli_query($config,"SELECT * FROM payments WHERE balance>0");
$invoices=mysqli_num_rows($invqry);
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
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/products.png" width="50%" height="50%"><br>Categories<br><?php echo $categories ?>
    </div>
</div>
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/db.png" width="50%" height="50%"><br>Items<br><?php echo $items ?>
    </div>
</div>
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/emptycart.png" width="50%" height="50%"><br>Ready for Sale<br><?php echo $countitms ?>
    </div>
</div>
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/user.png" width="50%" height="50%"><br>Users<br><?php echo $users ?>
    </div>
</div>
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/orders.png" width="50%" height="50%"><br>Sales Made<br><?php echo $sales ?>
    </div>
</div>
<div class="summary">
    <div style="margin-top: 5px;">
    <img src="images/invoice.png" width="50%" height="50%"><br>Invoices<br><?php echo $invoices ?>
    </div>
</div>

</div>


<?php
include 'styles.php'
?>