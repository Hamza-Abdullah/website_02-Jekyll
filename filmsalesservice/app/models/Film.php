<?php
    class Film {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getFilms() {
            $this->db->query(
                "SELECT fss_DVDStock.filmid AS filmid, filmtitle, filmdescription, filmrating, SUM(stocklevel) AS stocklevel 
                FROM `fss_DVDStock`, fss_Rating, fss_Film 
                WHERE fss_DVDStock.filmid = fss_Film.filmid 
                AND fss_Film.ratid = fss_Rating.ratid 
                GROUP BY filmid 
                ORDER BY filmid ASC"
            );

            $results = $this->db->resultSet();
            
            $secondStatement = new Database;
            $secondStatement->query(
                "SELECT filmid, GROUP_CONCAT(Genre SEPARATOR ', ') AS Genre 
                FROM fss_FilmGenre, fss_Genre 
                WHERE fss_FilmGenre.genid = fss_Genre.genid 
                GROUP BY filmid 
                ORDER BY filmid ASC"
            );
            $filmGenres = $secondStatement->resultSet();

            for ($i = 0; $i < count($results); $i++) {
                $results[$i]->Genre = $filmGenres[$i]->Genre;
            }

            return $results;
        }

        public function getFilm($id) {
            $this->db->query(
                "SELECT fss_DVDStock.filmid AS filmid, filmtitle, SUM(stocklevel) AS stocklevel 
                FROM `fss_DVDStock`, fss_Film 
                WHERE fss_DVDStock.filmid = fss_Film.filmid 
                AND fss_DVDStock.filmid = :id
                GROUP BY filmid 
                ORDER BY filmid ASC"
            );
            $this->db->bind(":id", $id);
            $results = $this->db->resultSingle();

            return $results;
        }

        public function getPayments($id) {
            $this->db->query(
                "SELECT amount, paydate, GROUP_CONCAT(filmtitle SEPARATOR ', ') AS films 
                FROM fss_Payment, fss_FilmPurchase, fss_OnlinePayment, fss_Film 
                WHERE fss_Payment.payid = fss_FilmPurchase.payid 
                AND fss_Payment.payid = fss_OnlinePayment.payid 
                AND fss_OnlinePayment.custid = :id 
                AND fss_FilmPurchase.filmid = fss_Film.filmid 
                GROUP BY fss_Payment.payid 
                ORDER BY paydate DESC"
            );
            $this->db->bind(":id", $id);
            $results = $this->db->resultSet();

            return $results;
        }

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

        public function createPayment($custid, $amount, $date, $basket, $addressid) {

            $shops = [];

            foreach ($basket as $item) {
                $this->db->query(
                    "SELECT * FROM fss_DVDStock 
                    WHERE filmid = :film 
                    ORDER BY stocklevel DESC 
                    LIMIT 1"
                );
                $this->db->bind(":film", $item);
                $shopid = $this->db->resultSingle()->shopid;
                $shops[] = $shopid;
                $stocklevel = $this->db->resultSingle()->stocklevel;
                $stocklevel -= 1;
                $secondStatement = new Database;
                $secondStatement->query(
                    "UPDATE fss_DVDStock 
                    SET stocklevel = :stock 
                    WHERE shopid = :shop 
                    AND filmid = :film"
                );
                $secondStatement->bind(":stock", $stocklevel);
                $secondStatement->bind(":shop", $shopid);
                $secondStatement->bind(":film", $item);
                $secondStatement->execute();
            }

            $thirdStatement = new Database;
            $thirdStatement->query(
                "INSERT INTO fss_Payment 
                (amount, paydate, ptid, shopid) 
                VALUES (:amount, :date, 2, :shop)"
            );
            $thirdStatement->bind(":amount", $amount);
            $thirdStatement->bind(":date", $date);
            $thirdStatement->bind(":shop", $shops[0]);

            if ($thirdStatement->execute()) {
                $iterimStatement = new Database;
                $iterimStatement->query(
                    "SELECT * FROM fss_Payment 
                    ORDER BY payid DESC 
                    LIMIT 1"
                );
                $payid = $iterimStatement->resultSingle()->payid;

                $interimStatement2 = new Database;
                $interimStatement2->query(
                    "INSERT INTO fss_OnlinePayment 
                    (payid, custid) 
                    VALUES (:pay, :id)"
                );
                $interimStatement2->bind(":pay", $payid);
                $interimStatement2->bind(":id", $custid);

                if ($interimStatement2->execute()) {
                    $count = 0;
                    foreach ($basket as $item) {
                        $fourthStatement = new Database;
                        $fourthStatement->query(
                            "INSERT INTO fss_FilmPurchase 
                            (price, filmid, shopid, payid) 
                            VALUES (6.99, :film, :shop, :pay)"
                        );
                        $fourthStatement->bind(":film", $item);
                        $fourthStatement->bind(":shop", $shops[$count]);
                        $fourthStatement->bind(":pay", $payid);
                        $fourthStatement->execute();
                    }
                    return true;
                }
                return false;
            }
            return false;
        }

    }
?>