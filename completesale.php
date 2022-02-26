<?php
include 'header.php';
$t=$_GET['t'];
$customername=addslashes($_POST['customername']);
$amountpaid=addslashes($_POST['paid']);
//create salesid
$salesdate=date('Y-m-d h:i:s');
$datearray=explode(' ',$salesdate);
$timearray=explode(':',$datearray[1]);
$hour=$timearray[0]+3;
$newsalesdate=$datearray[0].' '.$hour.':'.$timearray[1].':'.$timearray[2];
if(mysqli_query($config,"INSERT INTO salesid(customer,salesamount,salesdate) VALUES('$customername','$t','$newsalesdate')")){
    $idqry=mysqli_query($config,"SELECT * FROM salesid ORDER BY id DESC LIMIT 1");
    $idrow=mysqli_fetch_assoc($idqry);
    $salesid=$idrow['id'];
    $cartqry=mysqli_query($config,"SELECT * FROM cart");
    while($cartrow=mysqli_fetch_assoc($cartqry)){
        $cartid=$cartrow['id'];
        $itemname=$cartrow['item'];
        $unitcost=$cartrow['unitcost'];
        $quantity=$cartrow['quantity'];
        $totalcost=$cartrow['totalcost'];
        if(mysqli_query($config,"INSERT INTO sales(salesid,itemname,unitcost,quantity,totalcost) VALUES('$salesid','$itemname','$unitcost','$quantity','$totalcost')")){
            $stkqry=mysqli_query($config,"SELECT * FROM stocks WHERE itemname='$itemname' ORDER BY id DESC LIMIT 1");
            $stkrow=mysqli_fetch_assoc($stkqry);
            $prev=$stkrow['stockbalance'];
            $newstock='-'.$quantity;
            $newbal=$prev-$quantity;
            if(mysqli_query($config,"INSERT INTO stocks(itemname,previousstock,newstock,stockbalance,date_time) VALUES('$itemname','$prev','$newstock','$newbal','$newsalesdate')")){
                //add payments
                $balance=$t-$amountpaid;
                if(mysqli_query($config,"INSERT INTO payments(salesid,customer,amountpayable,amountpaid,balance,date_time) VALUES('$salesid','$customername','$t','$amountpaid','$balance','$newsalesdate')")){
                    //delete from cart
                mysqli_query($config,"DELETE FROM cart WHERE id='$cartid'");
                }
                
            }
        }
    }
    
    $result='<div style="margin-top:100px;margin-left:30%;"><img src="images/success.png" width="23" height="23" align="left"> Transaction was successful. <a href="receiptpdf.php?id='.$salesid.'">Print Receipt</a></div>';
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
        <div style="float: left;">Cart Items</div>
        
    </div>
    <div class="cart">
        <?php echo $result ?>
    </div>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>