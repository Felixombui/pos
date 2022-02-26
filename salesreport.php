<?php
include 'header.php';
if(empty($sdate)){
    $date=date('Y-m-d');
    $sdate=$date;
    $edate=$date;
    $selectedend=explode('-',$edate);
    $end=$selectedend[2]+1;
    $enddate=$selectedend[0].'-'.$selectedend[1].'-'.$end;
}
$salesqry=mysqli_query($config,"SELECT * FROM salesid WHERE salesdate LIKE '%$date%'");
if(isset($_POST['sort'])){
    $sdate=addslashes($_POST['sdate']);
    $edate=addslashes($_POST['edate']);
    $selectedend=explode('-',$edate);
    $end=$selectedend[2]+1;
    $enddate=$selectedend[0].'-'.$selectedend[1].'-'.$end;
    $salesqry=mysqli_query($config,"SELECT * FROM salesid WHERE salesdate>='$sdate' AND salesdate<'$enddate'");
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

    <div style="width: 100%;" class="searchbar">
        <form method="post">
            Sort by Date: From: <input type="date" name="sdate"> To: <input type="date" name="edate"><input type="submit" name="sort" value="Sort" style="padding: 7px; margin-left:5px;">
        </form>
        <div style="width: 20%;float:right;text-align:right;">
            <a href="<?php echo 'salesrptpdf.php?sdate='.$sdate.'&edate='.$enddate ?>">Print Report</a>
        </div>
    </div>
    <div style="margin-top: 10px;">
        <table width="100%">
            <th>#</th><th>Customer</th><th>Payable</th><th>Paid</th><th>Balance</th><th>Date</th><th width="16%">View Full Sale</th>
            <?php
            $totalpayable=0;
            $totalpaid=0;
            $totalbalance=0;
                while($salesrow=mysqli_fetch_assoc($salesqry)){
                    //check payments
                    $salesid=$salesrow['id'];
                    $customer=$salesrow['customer'];
                    $payable=$salesrow['salesamount'];
                    $salesdate=explode(' ',$salesrow['salesdate']);
                    $date=$salesdate[0];
                    $pmtqry=mysqli_query($config,"SELECT * FROM payments WHERE salesid='$salesid'");
                    $pmtrow=mysqli_fetch_assoc($pmtqry);
                    $paid=$pmtrow['amountpaid'];
                    $balance=$pmtrow['balance'];
                    echo '<tr><td>'.$salesid.'</td><td>'.$customer.'</td><td>'.$payable.'</td><td>'.$paid.'</td><td>'.$balance.'</td><td>'.$date.'</td><td><a href="viewsale.php?id='.$salesid.'"><img src="images/view.png" width="23" height="23"></a></td></tr>';
                    $totalpayable=$totalpayable+$payable;
                    $totalpaid=$totalpaid+$paid;
                    $totalbalance=$totalbalance+$balance;
                }
            ?>
            <tr style="background-color: grey;font-weight:bold;color:white;"><td></td><td>Totals</td><td><?php echo $totalpayable ?></td><td><?php echo $totalpaid ?></td><td><?php echo $totalbalance ?></td><td></td><td></td></tr>
        </table>
    </div>
    <?php
    echo $result;
    
    ?>
</div>

<form action=""></form>
<?php
include 'styles.php'
?>