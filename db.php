<?php  // connection with Database 

final class handle_db
{   protected $conn ;
    protected $server = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "products";
    public $exist_flag;
    public $back_data;

    // public $conn     = mysqli_connect($server, $username, $password, $dbname);
    public function __construct(){
        $this->conn     = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
    }
    public function db_insert($table, $values)
    {   
        $sql = "INSERT INTO `$table` VALUES ($values)";
        mysqli_query($this->conn, $sql);
    }
    function check_exist($value)
    {
        $sql = "SELECT 'sku' FROM `basic_features` where sku='$value' ";
        $this->back_data = mysqli_query($this->conn, $sql);
        if ($this->back_data->num_rows==0) {
            $this->exist_flag = 0;
        } else {
            $this->exist_flag = 1;
        };
    }
    protected function getRows($table)
    {
            $sql    = "SELECT * from $table  ORDER BY sku ";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                $rows = [];
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rows[] = $row;
                    }
                }
            }
            return $rows;

        }
    #public function -----> get data
    public function get_rows_public($table){
        return $this->getRows($table);
    }
    #return type of row as name of table
    public function getRow_condition($table,$sku_value)
        {
            $sql    = "SELECT * from `$table` WHERE `sku`='$sku_value'";
            $result = mysqli_query($this->conn, $sql);
            if ($result && mysqli_num_rows($result) > 0 ) {
                $rows = [];
                $rows[] = mysqli_fetch_assoc($result);
                return $rows[0];
                } else 
                {
                    return false;
                }
        }
    protected function delete($table,$sku){
        $sql = "DELETE FROM `basic_features` WHERE `sku`='$sku'";
        mysqli_query($this->conn, $sql);
        $sql = "DELETE FROM `$table` WHERE `sku`='$sku'";
        mysqli_query($this->conn, $sql);
    }

    #public function -----> delete
    public function del_public($sku){
        $table=$this->getRow_condition("basic_features", $sku);
        $this->delete($table['type'], $sku);
    }
}

if ((isset($_POST['delete']))&&(isset($_POST['num']))) {
    $box= $_POST['num'];
    foreach($box as $val){
        $row =new handle_db();
        $row->del_public($val);
    }?>
    <script type="text/javascript">
        window.location.href=window.location.href;
    </script>
<?php } ?>