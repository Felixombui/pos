<?php
include 'header.php';
$cartqry=mysqli_query($config,"SELECT * FROM cart");
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
        <div style="float: left;">Cart Items</div>
        
    </div>
    <div class="cart">
    <table width="60%" align="center" style="margin-top: 10px;border-collapse:collapse;border:1px solid pink;">
        <tr><th>Item Name</th><th>Unit Cost</th><th>Quantity</th><th>Total Cost</th><th></th></tr>
        <?php
        $total=0;
        while($cartrow=mysqli_fetch_assoc($cartqry)){
            $id=$cartrow['id'];
            echo '<tr><td>'.$cartrow['item'].'</td><td>'.$cartrow['unitcost'].'</td><td>'.$cartrow['quantity'].'</td><td>'.$cartrow['totalcost'].'</td><td><a href="removecart.php?id='.$id.'"><img src="images/delete.png" width="23" height="23"></a>';
            $total=$total+$cartrow['totalcost'];
        }
            
        ?>
        <tr style="background-color:grey;color:white;"><td></td><td></td><td><b>Cart Total</b></td><td><b><?php echo $total ?></b></td><td></td></tr>
    </table>
    </div>
    <div style="width: 100%;" class="complete">
    <table width="60%" align="center" class="complete" style="margin-top:30px;">
        <tr style="text-align: right;"><td><form method="post" action="<?php echo 'completesale.php?t='.$total ?>"><input type="text" name="customername" placeholder="Enter customer name"><br><input type="text" name="paid" placeholder="Enter Amount Paid..." style="margin-top: 6px;margin-bottom:6px;"><br><input type="submit" name="complete" value="Complete Sale"></form></td></tr>
    </table>
    </div>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>
