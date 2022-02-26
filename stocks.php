<?php
include 'header.php';
 $itmqry=mysqli_query($config,"SELECT * FROM items");
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
        <div style="float: left;">Stock</div>
        <div style="float: right; width:15%;"><a href="addstock.php"><img src="images/products.png" width="30" height="30" align="left">Add Stock</a></div>
    </div>
    <div style="width:20%;float:right; margin-top:10px;margin-bottom:10px;"><form method="post"><input type="text" name="searchtext" placeholder="Search..."><input type="submit" name="search" value="Search"></form></div>
    <table width="100%"><th>Item Name</th><th>Prev Stock</th><th>New Stock</th><th>Stock Balance</th><th>Date</th><th></th>
    <?php
        while($itmrow=mysqli_fetch_assoc($itmqry)){
            $itemname=$itmrow['itemname'];
            $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$itemname' ORDER BY id DESC LIMIT 1");
            if(mysqli_num_rows($stkqry)>0){
                $stkrow=mysqli_fetch_assoc($stkqry);
                $prev=$stkrow['previousstock'];
                $new=$stkrow['newstock'];
                $bal=$stkrow['stockbalance'];
                $date=$stkrow['date_time'];
            }else{
                $prev=0;
                $new=0;
                $bal=0;
            }
            echo '<tr><td>'.$itemname.'</td><td>'.$prev.'</td><td>'.$new.'</td><td>'.$bal.'</td><td>'.$date.'</td><td><a href="addstock.php?item='.urlencode($itemname).'"><img src="images/products.png" width="25" height="25"></td></tr>';
        }
    
    ?>
    </table>
</div>


<?php
include 'styles.php'
?>