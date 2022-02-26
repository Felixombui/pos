<?php
include 'header.php';
$item=$_GET['item'];
$quantity=addslashes($_POST['amount']);
$unitcost=$_GET['c'];
$category=$_GET['cat'];
$user=$_SESSION['username'];
$totalcost=$quantity*$unitcost;
if($category=='Movies'){
    if(mysqli_query($config,"INSERT INTO cart(user,item,unitcost,quantity,totalcost) VALUES('$user','$item','$unitcost','$quantity','$totalcost')")){
        header('location:sales.php');
    }else{
        $result='<div style="margin-top:10px;margin-left:10px;"><img src="images/error.png" width="23" height="23" align="left"> Item could not be added to cart! Please contact admin.';
    }
}elseif($category=='Services'){
    if(mysqli_query($config,"INSERT INTO cart(user,item,unitcost,quantity,totalcost) VALUES('$user','$item','$unitcost','$quantity','$totalcost')")){
        header('location:sales.php');
    }else{
        $result='<div style="margin-top:10px;margin-left:10px;"><img src="images/error.png" width="23" height="23" align="left"> Item could not be added to cart! Please contact admin.';
    }
}else{
    $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$item' ORDER BY id DESC LIMIT 1");
    if(mysqli_num_rows($stkqry)>0){
        $stkrow=mysqli_fetch_assoc($stkqry);
        $totalstock=$stkrow['stockbalance'];
        if($quantity>$totalstock){
            $result='<div style="margin-top:10px;margin-left:10px;"><img src="images/error.png" width="23" height="23" align="left"> There is not enough stock of <b>'.$item.'</b> to add to cart! Available stock is '.$totalstock.'.';
        }else{
            //add to cart
            
            if(mysqli_query($config,"INSERT INTO cart(user,item,unitcost,quantity,totalcost) VALUES('$user','$item','$unitcost','$quantity','$totalcost')")){
                header('location:sales.php');
            }else{
                $result='<div style="margin-top:10px;margin-left:10px;"><img src="images/error.png" width="23" height="23" align="left"> Item could not be added to cart! Please contact admin.';
            }
        }
        
    
    }else{
        $result='<div style="margin-top:10px;margin-left:10px;"><img src="images/error.png" width="23" height="23" align="left"> There is not enough stock of <b>'.$item.'</b> to add to cart! Available stock is 0.';
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
        <div style="float: left;">Sales</div>
        <div style="float: right; width:15%;"><a href="addcategory.php"><img src="images/view.png" width="30" height="30" align="left">View Sales Report</a></div>
    </div>
    
    <?php
    echo $result;
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>