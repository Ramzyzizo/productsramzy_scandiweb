<?php require_once('models.php');
require_once('db.php');
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Boootstap -->
    <!-- <link rel="stylesheet" href="C:\xampp\htdocs\test\style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Add Product</title>

    <script type="text/javascript"> 
    
    function show_option() {
    const sku_value = document.getElementById('sku').value;
    const name_value = document.getElementById('name').value;
    const price_value = document.getElementById('price').value;
    const type_value = document.getElementById('productType').value;

    document.cookie = "show="+type_value;
    document.cookie = "sku_value="+sku_value;
    document.cookie = "name_value="+name_value;
    document.cookie = "price_value="+price_value;
    var url ="http://localhost:8080/test/add_product.php";
    window.location.href=url; 
}
</script>
</head>
<style>.label, label.inline {
        display: inline-block;
        width: 100px;
    }</style>


<body>
   
<form id="product_form" method="post">
<div class="mb-3 row">
    <h1 class="col-sm-2 " style="margin-left:5%">Product Add</h1>

    <div class=" flow-right w-25 ">
        <button type="submit" name="add" id="save" class="btn btn-primary mt-4  " style="position: absolute; right: 20rem;width: 10rem;" href="#" role="button">Save</button>
        <a class="btn btn-primary mt-4  " style="position: absolute; right: 8rem;width: 10rem;" href="index.php" role="button">Cancel</a>
    </div>
    <div class="divider py-1 bg-dark mt-3" style="width: 90% "></div>
</div>

    <div>
        <div style="margin-left: 5rem" class="mt-5">
            <label class="label" >SKU</label>
            <input type="text" id="sku" name="sku" value="<?php 
            if(isset($_COOKIE['sku_value']))    { echo $_COOKIE['sku_value'];} ?>"   class="input-medium " >
        </div>
        <div style="margin-left: 5rem" class="mt-1">
            <label class="label">Name</label>
            <input type="text" id="name" name="name" value="<?php 
            if(isset($_COOKIE['name_value']))    { echo $_COOKIE['name_value'];} ?>" class="input-medium"  >
        </div>
        <div style="margin-left: 5rem" class="mt-1">
            <label class="label" for="price">Price ($)</label>
            <input type="number" id="price" name="price" value="<?php 
            if(isset($_COOKIE['price_value']))    { echo $_COOKIE['price_value'];} ?>" class="input-medium" >
        </div>
        <div style="margin-left: 5rem" class="mt-1">
            <label class="label" for="productType">Type Switcher</label>
            <select id="productType" name="productType"
                    aria-label="Default select example"  onchange="show_option()"   >
                <option selected disabled hidden value="<?php  if(isset($_COOKIE['show']))    { echo $_COOKIE['show'];} ?>"><?php  if(isset($_COOKIE['show']))    { echo $_COOKIE['show'];} ?></option>
                <option value="DVD">DVD</option>
                <option value="Furniture">Furniture</option>
                <option value="Book">Book</option>
            </select>

        </div>
        <?php
        if (isset($_COOKIE['show'])){
            $div_option = new $_COOKIE['show'];
            $div_option->show();
        };
        ?>
    </div>
</form>
<?php
if (isset($_POST['add'])) {
    if (isset($_COOKIE['show'])) {
        $div_option->post(); 
    }
    else
    {?>
        <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center">Please, submit required data</h3>
            </div>
    <?php 
    }
}?>
</body>

</html>

