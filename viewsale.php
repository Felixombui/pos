<?php
include 'header.php';
$id=$_GET['id'];
$salesqry=mysqli_query($config,"SELECT * FROM sales WHERE salesid='$id'");
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

    <div style="width: 100%;" class="searchbar">
        
    </div>
    <div style="margin-top: 10px;">
        <table style="width: 80%;border-collapse:collapse;border:1px solid pink;" align="center">
            <th>#</th><th>Sales ID</th><th>Item</th><th>Unit Cost</th><th>Quantity</th><th>Total</th>
            <?php
                while($salesrow=mysqli_fetch_assoc($salesqry)){
                    $sid=$salesrow['id'];
                    $salesid=$salesrow['salesid'];
                    $item=$salesrow['itemname'];
                    $unitcost=$salesrow['unitcost'];
                    $quantity=$salesrow['quantity'];
                    $total=$salesrow['totalcost'];
                    echo '<tr><td>'.$sid.'</td><td>'.$salesid.'</td><td>'.$item.'</td><td>'.$unitcost.'</td><td>'.$quantity.'</td><td>'.$total.'</td></tr>';
                }
                //search payments
                $pmtqry=mysqli_query($config,"SELECT * FROM payments WHERE salesid='$salesid'");
                $pmtrow=mysqli_fetch_assoc($pmtqry);
                $payable=$pmtrow['amountpayable'];
                $paid=$pmtrow['amountpaid'];
                $balance=$pmtrow['balance'];
            ?>
            <tr style="font-weight: bold;"><td></td><td></td><td></td><td></td><td>Total Payable</td><td><?php echo $payable ?></td></tr>
            <tr style="font-weight: bold;"><td></td><td></td><td></td><td></td><td>Total Paid</td><td><?php echo $paid ?></td></tr>
            <tr style="font-weight: bold;"><td></td><td></td><td></td><td></td><td> Balance</td><td><?php echo $balance ?></td></tr>
        </table>
        <?php
        if($balance>0){
            $pay='<a href="pay.php?id='.$id.'">Pay Balance</a> | ';
        }
        ?>
        <div style="width: 90%;text-align:right;" align="center"><?php echo $pay ?> <a href="<?php echo 'receiptpdf.php?id='.$id ?>">Print Receipt</a></div>
    </div>
    <?php
   
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>