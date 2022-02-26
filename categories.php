<?php
include 'header.php';
$catqry=mysqli_query($config,"SELECT * FROM categories");
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
        <div style="float: left;">Categories</div>
        <div style="float: right; width:15%;"><a href="addcategory.php"><img src="images/products.png" width="30" height="30" align="left">Add Category</a></div>
    </div>
    <div style="width:20%;float:right; margin-top:10px;margin-bottom:10px;"><form method="post"><input type="text" name="searchtext" placeholder="Search..."><input type="submit" name="search" value="Search"></form></div>
    <?php
    while($catrow=mysqli_fetch_assoc($catqry)){
        $img=$catrow['image'];
        $categoryname=$catrow['category'];
        echo '<a href="items.php?category='.$categoryname.'"><div class="summary" style="margin-top:30px;"><img src='.$img.' width="100%" height="80%"><br>'.$categoryname.'</div></a>';
    }
    
    ?>
</div>


<?php
include 'styles.php'
?>