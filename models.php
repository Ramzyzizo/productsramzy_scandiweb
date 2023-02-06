<?php 
abstract class form_control{
    private $sku;       
    private $name; 
    private $price;
    private $size=0;   
    private $height=0;
    private $width=0;
    private $length=0;
    private $weight=0;
    private $size_value;
    
    protected abstract function show();
    protected abstract function show_card($values);
    public function set($prop,$val){
        $this->$prop = $val;
    }
    public function get($prop){
        return $this->$prop;
    }
    public function post_basic(){
        $this->set('sku', $_POST['sku']);
        $this->set('name', $_POST['name']);
        $this->set('price', $_POST['price']);
        // $this->sku       = htmlspecialchars( $_POST['sku']);
        // $this->name       = htmlspecialchars( $_POST['name']);
        // $this->price       =  $_POST['price'];
    }
};
class DVD extends form_control{
    // public $size_value;
    public function show(){
        ?>
        <div style="margin-left: 5rem; display =none" id="size_div" class="mt-3" >
            <label class="label" for="size">Size ($)</label>
            <input type="text" id="size" name="size" class="input-medium"  >
            <p style="font-size: smaller; font-style: oblique"class="float-right" >Please, provide Size</p>
        </div>
    <?php }
    public function show_card($values){
        ?>
        <div class="d-flex justify-content-evenly">
        <span style="font-size: larger"><?php echo 'Size: '.$values['size'].' MB'?> </span>
        </div>
    <?php }
    public function post(){
        $this->post_basic();
        $this->set('size',$_POST['size']);
        $validation_op = new validation;
        $validation_op->is_empty($this->get('sku'));
        $validation_op->is_empty($this->get('name'));
        $validation_op->is_empty($this->get('price'));
        $validation_op->is_empty($this->get('size'));
        $validation_op->is_number($this->get('price'));
        $validation_op->is_number($this->get('size'));

        if (!empty($validation_op->errors_empty)){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_empty)?></h3>
            </div>
        <?php
    }
        if (!empty($validation_op->errors_number)){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_number)?></h3>
            </div>
        <?php
        }
        if (empty($validation_op->errors_number) && empty($validation_op->errors_empty)) {
            $x_sku          = $this->get("sku");
            $x_name           = $this->get("name");
            $x_price          = $this->get("price");
            $x_size          = $this->get("size");
            $base_values = "'$x_sku','$x_name','$x_price','DVD'";
            $values      = "'$x_sku','$x_size '";
            $query       = new handle_db();
            $query->check_exist($x_sku);
            if ($query->exist_flag == 1) { ?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php echo $x_sku . " is already exist." ?></h3>
            </div>
        <?php } else {
                $query->db_insert("basic_features", $base_values);
                $query->db_insert("DVD", $values);
                if (empty($validation_op->errors_empty) && empty($validation_op->errors_number)) {
                    $validation_op->clear_cookies();
                    $validation_op->home();
                }
            }
        }
    }

};
class Furniture extends form_control{
    

    public function show(){?>
        <div class="furniture" id="furniture_div">
            <div style="margin-left: 5rem" class="mt-3">
                <label class="label" for="height">Height (CM)</label>
                <input type="text" id="height" name="height" class="input-medium"  >
                <p style="font-size: smaller; font-style: oblique"class="float-right" >Please, provide Height</p>
            </div>
            <div style="margin-left: 5rem" class="mt-3">
                <label class="label" for="width">Width (CM)</label>
                <input type="text" id="width" name="width" class="input-medium" >
                <p style="font-size: smaller; font-style: oblique"class="float-right" >Please, provide Width</p>
            </div>
            <div style="margin-left: 5rem" class="mt-3">
                <label class="label" for="length">Length (CM)</label>
                <input type="text" id="length" name="length" class="input-medium"  >
                <p style="font-size: smaller; font-style: oblique"class="float-right" >Please, provide Length</p>
            </div>
        </div>
        
    <?php }
    public function show_card($values){
        ?>
        <div class="d-flex justify-content-evenly">
        <span style="font-size: larger"><?php echo 'Dimension: '.$values['height'].'x'.$values['width'].'x'.$values['length']?> </span>
        </div>
    <?php }
    public function post(){
        $this->post_basic();
        $this->set('height',$_POST['height']);
        $this->set('width',$_POST['width']);
        $this->set('length',$_POST['length']);
        $validation_op = new validation;
        $validation_op->is_empty($this->get('sku'));
        $validation_op->is_empty($this->get('name'));
        $validation_op->is_empty($this->get('price'));
        $validation_op->is_number($this->get('price'));

        $validation_op->is_empty($this->get('height'));
        $validation_op->is_empty($this->get('width'));
        $validation_op->is_empty($this->get('length'));

        $validation_op->is_number($this->get('height'));
        $validation_op->is_number($this->get('width'));
        $validation_op->is_number($this->get('length'));;
        if (!empty($validation_op->errors_empty)){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_empty)?></h3>
            </div>
        <?php 
    }
        if (!empty($validation_op->errors_number)){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_number)?></h3>
            </div>
        <?php 
    }if (empty($validation_op->errors_number)&&empty($validation_op->errors_empty)){
        $x_sku          = $this->get("sku");
        $x_name           = $this->get("name");
        $x_price          = $this->get("price");
        $x_height         = $this->get("height");
        $x_width          = $this->get("width");
        $x_length         = $this->get("length");
        $base_values = "'$x_sku ','$x_name','$x_price','Furniture'";
        $values = "'$x_sku','$x_height','$x_width','$x_length'";
        $query = new handle_db();
        $query->check_exist($x_sku);
        if ($query->exist_flag==1){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php echo $x_sku." is already exist."?></h3>
            </div>
        <?php }else{
            $query->db_insert("basic_features",$base_values);
            $query->db_insert("Furniture",$values);
            if (empty($validation_op->errors_empty) && empty($validation_op->errors_number)) {
                $validation_op->clear_cookies();
                $validation_op->home();
            }
        }
    }
    }
};
class Book extends form_control{

    public function show(){?>
        <div style="margin-left: 5rem" id="weight_div" class="mt-3" >
            <label class="label" for="weight">Weight (KG)</label>
            <input type="text" id="weight" name="weight" class="input-medium" >
            <p style="font-size: smaller; font-style: oblique"class="float-right" >Please, provide weight</p>
        </div>
   <?php }
   public function show_card($values){
    ?>
    <div class="d-flex justify-content-evenly">
    <span style="font-size: larger"><?php echo 'Weight: '.$values['weigth'].' KG' ?> </span>
    </div>
<?php }
    public function post(){
        $this->post_basic();
        $this->set('weight',$_POST['weight']);
        $validation_op = new validation;
        $validation_op->is_empty($this->get('sku'));
        $validation_op->is_empty($this->get('name'));
        $validation_op->is_empty($this->get('price'));
        $validation_op->is_empty($this->get('weight'));
        $validation_op->is_number($this->get('weight'));
        $validation_op->is_number($this->get('price'));
        if (!empty($validation_op->errors_empty)){;?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_empty)?></h3>
            </div>
        <?php 
    }
        if (!empty($validation_op->errors_number)){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php print_r($validation_op->errors_number)?></h3>
            </div>
        <?php 
    }if (empty($validation_op->errors_number)&&empty($validation_op->errors_empty)){
        $x_sku          = $this->get("sku");
        $x_name           = $this->get("name");
        $x_price          = $this->get("price");
        $x_weight          = $this->get("weight");
        $base_values = "'$x_sku ','$x_name','$x_price','Book'";
        $values = "'$x_sku','$x_weight'";
        $query = new handle_db();
        $query->check_exist($x_sku  );
        if ($query->exist_flag==1){?>
            <div class="col-sm-6 offset-sm-3 border p-3">
            <h3 class="alert alert-danger text-center"><?php echo $x_sku." is already exist."?></h3>
            </div>
        <?php } else {
                $query->db_insert("basic_features", $base_values);
                $query->db_insert("Book", $values);
                if (empty($validation_op->errors_empty) && empty($validation_op->errors_number)) {
                    $validation_op->clear_cookies();
                    $validation_op->home();
                }
            }
    }
    }

 } ;

class validation 
{
    public function get($prop){
        return $this->$prop;
    }
    public $errors_empty;
    public $errors_number;

    public function is_empty($int_value){
        echo $int_value;
        if(empty($int_value)){ 
        $this->errors_empty="Please, submit required data";
        }
    }
    public function is_number($int_value){
        if(((!is_numeric($int_value))|| ($int_value<0))&& ($int_value !=null)){
        $this->errors_number=" Please, provide the data of indicated type";
        }
    }
    public function clear_cookies(){
            setcookie("sku_value", "", time());
            setcookie("show", "", time());
            setcookie("name_value", "", time());
            setcookie("price_value", "", time());
            
    }
    public function home(){
        header('location:index.php');
    }
};

?>