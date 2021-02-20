<?php
    /*
     * PDO DATABASE CLASS
     * Connect to database
     * Create prepared statements
     * Bind values
     * Return results
     */
    
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASS;
        private $dbname = DB_NAME;
        
        private $dbh;
        private $statement;
        private $error;

        public function __construct() {
            // Set DSN
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create instance of PDO
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare statement with query
        public function query($sql) {
            $this->statement = $this->dbh->prepare($sql);
        }

        // Bind values
        public function bind($parameter, $value, $type = null) {
            if (is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->statement->bindValue($parameter, $value, $type);
        }

        // Execute prepared statement
        public function execute() {
            return $this->statement->execute();
        }

        // Return result set as array of objects
        public function resultSet() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        // Return single result object
        public function resultSingle() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount() {
            return $this->statement->rowCount();
        }
    }
?>