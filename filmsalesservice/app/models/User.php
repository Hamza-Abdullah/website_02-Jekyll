<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Register function
        public function register($data) {
            // Insert into fss_Person table
            $this->db->query("INSERT INTO fss_Person (personname, personphone, personemail) 
            VALUES (:name, :phone, :email); 
            ");
            // Bind values
            $this->db->bind(":name", $data["name"]);
            $this->db->bind(":phone", $data["phone"]);
            $this->db->bind(":email", $data["email"]);
            // Execute insert
            if ($this->db->execute()) {
                // Get ID of newly inserted record
                $secondStatement = new Database;
                $secondStatement->query("SELECT * FROM fss_Person WHERE personemail = :email");
                $secondStatement->bind(":email", $data["email"]);
                $row = $secondStatement->resultSingle();
                $id = $row->personid;

                // Insert into fss_Customer table
                $thirdStatement = new Database;
                $thirdStatement->query("INSERT INTO fss_Customer (custid, custregdate, custendreg, custpassword) 
                VALUES (:id, :regdate, :endreg, :password); 
                ");
                // Bind values
                $thirdStatement->bind(":id", $id);
                $thirdStatement->bind(":regdate", date("Y-m-d"));
                $thirdStatement->bind(":endreg", date("Y-m-d", strtotime("+10 years")));
                $thirdStatement->bind(":password", $data["password"]);
                // Execute third statement
                if ($thirdStatement->execute()) {
                    return true;
                }

                return false;
            } else {
                return false;
            }
        }

        // Update details function
        public function updateDetails($data) {
            // Insert into fss_Person table
            $this->db->query(
                "UPDATE fss_Person 
                SET personname = :name, 
                personphone = :phone, 
                personemail = :email 
                WHERE personid = :id"
            );
            // Bind values
            $this->db->bind(":name", $data["name"]);
            $this->db->bind(":phone", $data["phone"]);
            $this->db->bind(":email", $data["email"]);
            $this->db->bind(":id", $_SESSION["user_id"]);
            // Execute insert
            if ($this->db->execute()) {
                // Update password
                $secondStatement = new Database;
                $secondStatement->query(
                    "UPDATE fss_Customer 
                    SET custpassword = :password 
                    WHERE custid = :id"
                );
                $secondStatement->bind(":password", $data["password"]);
                $secondStatement->bind(":id", $_SESSION["user_id"]);
                if ($secondStatement->execute()) {
                    // Update customeraddress table
                    $thirdStatement = new Database;
                    $thirdStatement->query(
                        "UPDATE fss_CustomerAddress 
                        SET addid = :addressid 
                        WHERE custid = :id"
                    );
                    $thirdStatement->bind(":addressid", $data["addressid"]);
                    $thirdStatement->bind(":id", $_SESSION["user_id"]);
                    if ($thirdStatement->execute()) {
                        return true;
                    }
                return false;
                }
            } else {
                return false;
            }            
        }

        // New address
        public function newAddress($id, $street, $city, $postcode) {
            $this->db->query("INSERT INTO fss_Address (addstreet, addcity, addpostcode) 
            VALUES (:street, :city, :postcode); 
            ");
            // Bind values
            $this->db->bind(":street", $street);
            $this->db->bind(":city", $city);
            $this->db->bind(":postcode", $postcode);

            // Execute insert
            if ($this->db->execute()) {
                // Get ID of newly inserted record
                $secondStatement = new Database;
                $secondStatement->query(
                    "SELECT * FROM fss_Address 
                    WHERE addstreet = :street 
                    AND addcity = :city 
                    AND addpostcode = :postcode"
                );
                $secondStatement->bind(":street", $street);
                $secondStatement->bind(":city", $city);
                $secondStatement->bind(":postcode", $postcode);
                $row = $secondStatement->resultSingle();
                $addressid = $row->addid;

                // Insert into fss_CustomerAddress table
                $thirdStatement = new Database;
                $thirdStatement->query("INSERT INTO fss_CustomerAddress (custid, addid) 
                VALUES (:id, :addressid); 
                ");
                // Bind values
                $thirdStatement->bind(":id", $id);
                $thirdStatement->bind(":addressid", $addressid);
                // Execute third statement
                if ($thirdStatement->execute()) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }

        // Login user
        public function login($email, $password) {
            // Get user ID
            $this->db->query("SELECT * FROM fss_Person WHERE personemail = :email");
            $this->db->bind(":email", $email);
            $personRow = $this->db->resultSingle();
            $id = $personRow->personid;

            // Get password for corresponding ID
            $secondStatement = new Database;
            $secondStatement->query("SELECT * FROM fss_Customer WHERE custid = :id");
            $secondStatement->bind(":id", $id);
            $customerRow = $secondStatement->resultSingle();
            $db_password = $customerRow->custpassword;

            // Evaulate password
            if ($password == $db_password) {
                return $personRow;
            } else {
                return false;
            }
        }

        // Find user by email address
        public function findUserByEmail($email) {
            $this->db->query("SELECT * FROM fss_Person WHERE personemail = :email");
            $this->db->bind(":email", $email);
            $row = $this->db->resultSingle();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Get user by id
        public function getUser($id) {
            $this->db->query("SELECT * FROM fss_Person WHERE personid = :id");
            $this->db->bind(":id", $id);
            $row = $this->db->resultSingle();
            return $row;
        }

        // Find address
        public function findAddress($street, $city, $postcode) {
            $this->db->query(
                "SELECT * FROM fss_Address 
                WHERE addstreet = :street 
                AND addcity = :city 
                AND addpostcode = :postcode"
            );
            $this->db->bind(":street", $street);
            $this->db->bind(":city", $city);
            $this->db->bind(":postcode", $postcode);
            $row = $this->db->resultSingle();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getAddressID($street, $city, $postcode) {
            $this->db->query(
                "SELECT * FROM fss_Address 
                WHERE addstreet = :street 
                AND addcity = :city 
                AND addpostcode = :postcode"
            );
            $this->db->bind(":street", $street);
            $this->db->bind(":city", $city);
            $this->db->bind(":postcode", $postcode);
            $row = $this->db->resultSingle();

            return $row;
        }

        // Get address by user id
        public function getAddress($id) {
            $this->db->query(
                "SELECT fss_Address.addid, addstreet, addcity, addpostcode 
                FROM `fss_Address`, fss_CustomerAddress 
                WHERE fss_CustomerAddress.addid = fss_Address.addid 
                AND fss_CustomerAddress.custid = :id"
            );
            $this->db->bind(":id", $id);
            $row = $this->db->resultSingle();

            // Check row
            if (!($this->db->rowCount() > 0)) {
                $row = new stdClass();
                $row->success = false;
            } else {
                $row->success = true;
            }

            return $row;
        }

        // Find user by phone
        public function findUserByPhone($phone) {
            $this->db->query("SELECT * FROM fss_Person WHERE personphone = :phone");
            $this->db->bind(":phone", $phone);
            $row = $this->db->resultSingle();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>