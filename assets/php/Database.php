<?php
    
    namespace Connection;
    
    class Database {

        private $dsn = "mysql:host=localhost;dbname=pantheon";
        private $user = "root";
        private $pass = "";

        public $conn;

        public function __construct()
        {
            try
            {
                $this->conn = new \PDO($this->dsn, $this->user, $this->pass);

                // echo 'Connected Successfully';
            }
            catch (\PDOException $e)
            {
                echo 'Error : '. $e -> getMessage();
            }

            return $this->conn;
        }

        // sanitize data input by user
        public  function test_input($data){
            $data = trim($data); // removes spaces
            $data = stripslashes($data); // removes slashes
            $data = htmlspecialchars($data); //removes special characters like % < >

            return $data;
        }

        // Error Message Alert
        public function showMessage($type, $message){
            return 
            '<div class="alert alert-'. $type .' alert-dismissible">
                <a type="button" class="close" data-dismiss="alert"></a>
                    <strong class="text-center">'. $message .'</strong>
                    <button type="button" class="btn-close" aria-label="Close"></button>
            </div>';
        }

    }

  

?>