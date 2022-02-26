<?php
include 'header.php';
$category=$_GET['category'];
if(empty($category)){
    $itmsqry=mysqli_query($config,"SELECT * FROM items");
}else{
    $itmsqry=mysqli_query($config,"SELECT * FROM items WHERE category='$category'");
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
        <div style="float: left;">Items</div>
        <div style="float: right; width:15%;"><a href="additem.php"><img src="images/products.png" width="30" height="30" align="left">Add Item</a></div>
    </div>
    <div style="width:20%;float:right; margin-top:10px;margin-bottom:10px;"><form method="post"><input type="text" name="searchtext" placeholder="Search..."><input type="submit" name="search" value="Search"></form></div>
    <table width="100%"><th>Item Name</th><th>Unit</th><th>Qty@unit</th><th>Buying Price</th><th>Selling Price</th><th>Margin</th><th></th>
    <?php
   while($itmsrow=mysqli_fetch_assoc($itmsqry)){
        $margin=$itmsrow['sellingprice']-$itmsrow['buyingprice'];
        $id=$itmsrow['id'];
        echo '<tr><td>'.$itmsrow['itemname'].'</td><td>'.$itmsrow['unitofmeasure'].'</td><td>'.$itmsrow['unitamount'].'</td><td>'.number_format($itmsrow['buyingprice'],2).'</td><td>'.number_format($itmsrow['sellingprice'],2).'</td><td>'.number_format($margin,2).'</td><td><a href="additem.php?id='.$id.'"><img src="images/edit.png" width="23" height="23" align="left"></a> </td></tr>';
   }
    
    ?>
    </table>
</div>


<?php
include 'styles.php'
?>