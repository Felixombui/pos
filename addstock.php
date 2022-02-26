<?php
include 'header.php';
$item=$_GET['item'];
if(empty($item)){
    //do nothing
}else{
    $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$item' ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($stkqry)>0){
        $stkrow=mysqli_fetch_assoc($stkqry);
        $prevstock=$stkrow['stockbalance'];
    }else{
        $prevstock=0;
    }
}
if(isset($_POST['check'])){
    $item=$_POST['itemname'];
    $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$item' ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($stkqry)>0){
        $stkrow=mysqli_fetch_assoc($stkqry);
        $prevstock=$stkrow['stockbalance'];
    }else{
        $prevstock=0;
    }
    header('location:addstock.php?item='.$item);
}
if(isset($_POST['submit'])){
    $itemname=$_POST['itemname'];
    if(empty($_POST['prev'])){
        $item=$_POST['itemname'];
        $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$item' ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($stkqry)>0){
            $stkrow=mysqli_fetch_assoc($stkqry);
            $prevstock=$stkrow['stockbalance'];
        }else{
            $prevstock=0;
        }
    }else{
        $prevstock=$_POST['prev'];
    }
    $newstock=addslashes($_POST['newstock']);
    $totalstock=$prevstock+$newstock;
    $date=date('d-m-Y h:i:s');
    if(mysqli_query($config,"INSERT INTO stocks(itemname,previousstock,newstock,stockbalance,date_time) VALUES('$itemname','$prevstock','$newstock','$totalstock','$date')")){
        $result='<img src="images/success.png" width="23" height="23" align="left"> Stock added successfully.';
    }else{
        $result='<img src="images/error.png" width="23" height="23" align="left"> Operation failed. Contact system admin.';
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
        <div style="float: left;">New Stock</div>
        
    </div>
    <div class="dataform">
        <form action="" method="post">
        <select name="itemname" style="width:80%;">
            <option selected><?php echo $item ?></option>
            <?php
            $itmsqry=mysqli_query($config,"SELECT * FROM items");
            while($itmsrow=mysqli_fetch_assoc($itmsqry)){
                echo '<option>'.$itmsrow['itemname'].'</option>';
            }
            ?>
        </select>
        <input type="submit" name="check" value="Check" style="width:17%;background-color:green;color:white;border-radius:5px;">
        <input type="text" name="prev" value="<?php echo $prevstock ?>" readonly>
        <input type="text" name="newstock" placeholder="Enter New Stock Amount">
        <input type="submit" name="submit" value="Add Stock">
        </form>
        <div style="margin-top: 5px;"><?php echo $result ?></div>
    </div>
    
</div>


<?php
include 'styles.php'
?>