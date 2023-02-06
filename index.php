<?php require_once('models.php');
require_once('db.php');
$clear_co = new validation;
$clear_co->clear_cookies();
?>
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
    <title>Product list</title>
</head>
<body>
    <form action="" name="cards" method="post">
    <section class="justify-content-center justify-content-lg-between p-5 ">
    <!-- <div class="mb-3 row"> -->
    <div >
        <h1 class="col-sm-2  " style="margin-left:5%;margin-top:1rem; ">Product List</h1>
        <a class="btn btn-primary flow-right  mt-2  " style=" right: 20rem;width: 10rem;position: absolute; top: 10%;" href="add_product.php" role="button">ADD</a>
        <input name="delete" type="submit" id="delete-product-btn" class="btn btn-primary mt-2 " style="right: 8rem;width: 10rem;position: absolute;top: 10%;" value="MASS DELETE" >
    </div>

    <div class="divider py-1 bg-dark mt-3" style="position: relative; "></div>
</section>
    <section >
        <div class="container py-2">
            <div class="row">
            <?php $data = new handle_db();
                foreach ($data->get_rows_public('basic_features') as $row) {
            ?>
                <div class="col-md-3 mb-5 col-xl-3">
                    <div class="card border-dark text-black" style="width: 15rem;">
                        <br>
                        <div class="card-body">
                                <div class="d-flex justify-content-evenly">
                                    <input name="num[]" type="checkbox" style="margin-right: auto;width: 1rem;height: 1rem" value="<?php echo $row['sku'] ?>" class="delete-checkbox">
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <span style="font-size: larger"><?php echo $row['sku'] ?></span>
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <span style="font-size: larger"><?php echo $row['name'] ?></span>
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <span style="font-size: larger"><?php echo $row['price']." $" ?> </span>
                                </div>
                                <?php
                                $values=$data->getRow_condition($row['type'],$row['sku']);
                                $show_div = new $row['type'];
                                $show_div->show_card($values);?>
                                        
                        </div>
                        <br>
                    </div>
                
                </div>
                <?php };?>
            </div>
            
        </div>

    </section>
</form>
  <section class=" justify-content-center justify-content-lg-between p-5 " style="position:relative ;top: 15%;">
    <div class="divider py-1 bg-dark mt-3" style="position: relative;"></div>
    <h3 class="d-flex justify-content-center mt-3">Scandiweb Test assignment</h3>
  </section>
</body>
</html>