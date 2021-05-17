<?php
class User{

    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    public $id;
    public $login;
    public $password;
    public $phone;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function isAlreadyExist(){
        $query = "SELECT * FROM $this->table_name WHERE login='$this->login'";

        $stmt = $this->conn->query($query);

        if($stmt->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
    function signup(){

        if($this->isAlreadyExist()){

            return false;
        }

       //query to insert record
        $query = "INSERT INTO users (idUser,Login,Password,Phone) VALUES(?,?,?,?)";

        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bind_param('isss',$id,$login,$password,$phone);
        $id = $this->conn->insert_id;
        $login = strip_tags($this->login) ;
        $password = strip_tags($this->password);
        $phone = strip_tags($this->phone);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    // login user
    function login(){
        // select all query
        $query = "SELECT idUser, login, password,idRole FROM $this->table_name WHERE login='$this->login'
        AND password='$this->password'";
        // prepare query statement
        $stmt = $this->conn->query($query);

        // execute query
        return $stmt;
    }

}
