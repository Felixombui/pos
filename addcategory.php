<?php
include 'header.php';
if(isset($_POST['submit'])){
    $category=addslashes($_POST['category']);
    $filename=$_FILES['image']['name'];
    $filetemp=$_FILES['image']['tmp_name'];
    $destination='categories/'.$filename;
    if(empty($filename)){
        if(mysqli_query($config,"INSERT INTO categories(category,`image`) VALUES('$category','$destination')")){
            $result='<img src="images/success.png" width="23" height="23" align="left"> Category added successfully.';
        }else{
            $result='<img src="images/error.png" width="23" height="23" align="left"> Operation Failed! No data was added.';
        }
    }else{
        if(move_uploaded_file($filetemp,$destination)){
            if(mysqli_query($config,"INSERT INTO categories(category,`image`) VALUES('$category','$destination')")){
                $result='<img src="images/success.png" width="23" height="23" align="left"> Category added successfully.';
            }else{
                $result='<img src="images/error.png" width="23" height="23" align="left"> Operation Failed! No data was added.';
            }
        }else{
            $result='<img src="images/error.png" width="23" height="23" align="left"> Operation Failed! Icon '.$filename.' was not uploaded.';
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
        <div style="float: left;">New Category</div>
        
    </div>
    <form method="post" enctype="multipart/form-data">
    <div class="dataform">
        <input type="text" name="category" placeholder="Type the category name..." required="required">
        <label>Select icon: </label><input type="file" name="image">
        <input type="submit" name="submit" value="Save Category">
        <?php echo $result ?>
    </div>
    </form>
    
</div>


<?php
include 'styles.php'
?>