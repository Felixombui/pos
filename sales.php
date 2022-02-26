<?php
include 'header.php';
$catqry=mysqli_query($config,"SELECT * FROM items ORDER BY itemname");
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
        <div style="float: left;">Sales</div>
        
        <div style="float: right; width:15%;"><a href="salesreport.php"><img src="images/view.png" width="30" height="30" align="left">View Sales Report</a></div>
    </div>
    
    <?php
    while($catrow=mysqli_fetch_assoc($catqry)){
        $itemname=$catrow['itemname'];
        $unitcost=$catrow['sellingprice'];
        $category=$catrow['category'];
        $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$itemname' ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($stkqry)>0){
            $stkrow=mysqli_fetch_assoc($stkqry);
            $stockbalance=$stkrow['stockbalance'];
        }else{
            $stockbalance=0;
        }
        echo '<div class="itemsmenu"><b>'.$itemname.'</b><br>Stock Bal: '.$stockbalance.'<br><form method="post" action="addtocart.php?item='.urlencode($itemname).'&c='.$unitcost.'&cat='.$category.'"><input type="number" name="amount" value="1" style="width:50%;padding:5px;margin-top:8px"><input type="submit" name="add" value="Add" style="width:48%;color:white;background-color:green;padding:5px;margin-top:8px;"></form></div>';
    }
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>