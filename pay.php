<?php
include 'header.php';
$id=$_GET['id'];
$sqry=mysqli_query($config,"SELECT * FROM salesid WHERE id='$id'");
$srow=mysqli_fetch_assoc($sqry);
$customer=$srow['customer'];
//check payments
$pyqry=mysqli_query($config,"SELECT * FROM payments WHERE salesid='$id'");
$pyrow=mysqli_fetch_assoc($pyqry);
$payable=$pyrow['amountpayable'];
$paid=$pyrow['amountpaid'];
$balance=$pyrow['balance'];

if(isset($_POST['pay'])){
    $newpay=addslashes($_POST['amount']);
    $newbalance=$balance-$newpay;
    $totpaid=$paid+$newpay;
    //update payments
    if(mysqli_query($config,"UPDATE payments SET amountpaid='$totpaid',balance='$newbalance' WHERE salesid='$id'")){
        $result='<img src="images/success.png" width="23" height="23" align="left"> Payment received successfully. <a href="receiptpdf.php?id='.$id.'"> Print Receipt</a>';
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
        <div style="float: left;">Sales Report</div>
        <div style="float: right; width:15%;"><a href="sales.php"><img src="images/view.png" width="30" height="30" align="left">Back to Sales</a></div>
    </div>

    <div class="dataform">
        <form method="post">
        <input type="text" name="customer" value="<?php echo $customer ?>" readonly>
        <input type="text" name="balance" value="<?php echo $balance ?>" readonly>
        <input type="text" name="amount" placeholder="Enter amount paid" required="required">
        <input type="submit" name="pay" value="Make Payment">
</form>
        <?php echo $result ?>
    </div>
    
</div>

<form action=""></form>
<?php
include 'styles.php'
?>