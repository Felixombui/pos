<?php
include 'header.php';
$id=$_GET['id'];
if(empty($id)){
    //do nothing
    $btnval='Save Item';
}else{
    $itmqry=mysqli_query($config,"SELECT * FROM items WHERE id='$id'");
    $itmrow=mysqli_fetch_assoc($itmqry);
    $btnval='Update Item';
}
if(isset($_POST['submit'])){
    $itemname=addslashes($_POST['item']);
    $unitofmeasure=addslashes($_POST['unit']);
    $unitamount=addslashes($_POST['quantity']);
    $buyingprice=addslashes($_POST['buyingprice']);
    $sellingprice=addslashes($_POST['sellingprice']);
    $category=addslashes($_POST['category']);
       if($category=='--Select Category--'){
        $result='<img src="images/error.png" width="23" height="23" align="left"> You must select a category.';
       } else{
            if(empty($id)){
                if(mysqli_query($config,"INSERT INTO items(itemname,unitofmeasure,unitamount,buyingprice,sellingprice,category) VALUES('$itemname','$unitofmeasure','$unitamount','$buyingprice','$sellingprice','$category')")){
                $result='<img src="images/success.png" width="23" height="23" align="left"> Item has been added successfully. <div style="float:right;font-weight:bold;"><a href="additem.php">X</a></div>';
                }else{
                $result='<img src="images/error.png" width="23" height="23" align="left"> Operation failed! Contact system admin.';
            }
        }else{
            if(mysqli_query($config,"UPDATE items SET itemname='$itemname',unitofmeasure='$unitofmeasure',unitamount='$unitamount',buyingprice='$buyingprice',sellingprice='$sellingprice',category='$category' WHERE id='$id'")){
                $result='<img src="images/success.png" width="23" height="23" align="left"> Item has been updated successfully. <div style="float:right;font-weight:bold;"><a href="additem.php">X</a></div>';
            }else{
                $result='<img src="images/error.png" width="23" height="23" align="left"> Update of item information failed! Please contact administrator.';
            }
        }
       
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
        <div style="float: left;">Items</div>
        
    </div>
    <div class="dataform">
        <form action="" method="post">
        <input type="text" name="item" placeholder="Enter item name..." required="required" value="<?php echo $itmrow['itemname'] ?>">
        <input type="text" name="unit" placeholder="Enter unit..." required="required" value="<?php echo $itmrow['unitofmeasure'] ?>">
        <input type="text" name="quantity" placeholder="Enter quantity..." required="required" value="<?php echo $itmrow['unitamount'] ?>">
        <input type="text" name="buyingprice" placeholder="Enter buying price..." required="required" value="<?php echo $itmrow['buyingprice'] ?>">
        <input type="text" name="sellingprice" placeholder="Enter selling price..." required="required" value="<?php echo $itmrow['sellingprice'] ?>">
        <select name="category">
            <option>--Select Category--</option>
            <?php
                $catqry=mysqli_query($config,"SELECT * FROM categories");
                while($catrow=mysqli_fetch_assoc($catqry)){
                    echo '<option>'.$catrow['category'].'</option>';
                }
            ?>
        </select>
        <input type="submit" name="submit" value="<?php echo $btnval ?>">
        </form>
        <div style="margin-top: 5px;"><?php echo $result ?></div>
    </div>
    
</div>


<?php
include 'styles.php'
?>