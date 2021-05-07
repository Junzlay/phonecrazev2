<?php


class Store{
   
    private $server = "mysql:host=remotemysql.com:3306;dbname=QS0Kc3Ap8c";
    private $user = "QS0Kc3Ap8c";
    private $pass = "tveZrwznrq";
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    protected $connection;

    public function openConnection()
    {

        try {

            $this->connection = new PDO(
                $this->server,
                $this->user,
                $this->pass,
                $this->options

            );
            return $this->connection;
        } catch (PDOException $error) {

            echo "Error connection: " . $error->getMessage();
        } //end trycatch
    } //end function openConnection
    

    function getAllProducts() {
       
        $connection = $this->openConnection();
        $statement = $connection->prepare("SELECT * FROM product"); //prepare the query
        $statement->execute(); //built in function to execute
        $product = $statement->fetchAll();
        $productCount = $statement->rowCount();

        if ($productCount > 0) {
            return $product;
        } else {
            return 0;
        } //end if-else
    }//end getAllProducts()


}
$store=new Store();
