<?php
    class Films extends Controller {
        public function __construct() {
            if (!isLoggedIn()) {
                redirect("users/login");
            }

            $this->filmModel = $this->model("Film");
        }

        public function index() {
            // Get films
            $films = $this->filmModel->getFilms();

            $data = [
                "Heading" => "Browse",
                "Subheading" => count($_SESSION["basket"]) . " films in basket.",
                "films" => $films
            ];

            $this->view("films/index", $data);
        }

        public function add($film = "") {
            // Add film to basket
            if ($film != "") {
                $_SESSION["basket"][] = $film;
            }
            
            redirect("films/index");
        }

        public function remove($index) {
            // Remove film from basket
            // unset($_SESSION["basket"][$index]);
            // array_values($_SESSION["basket"]);
            array_splice($_SESSION["basket"], $index, 1);
            redirect("films/purchase");
        }

        public function clear() {
            unset($_SESSION["basket"]);
            redirect("films/index");
        }

        public function purchase() {
            $basket = [];

            foreach($_SESSION["basket"] as $item) {
                // Get film
                $film = $this->filmModel->getFilm($item);
                $basket[] = [
                    "filmid" => $film->filmid,
                    "filmtitle" => $film->filmtitle,
                    "price" => 6.99,
                    "stocklevel" => $film->stocklevel
                ];
            }


            $data = [
                "Heading" => "Purchase",
                "Subheading" => count($_SESSION["basket"]) . " films in basket.",
                "basket" => $basket
            ];

            $this->view("films/purchase", $data);
        }

        public function confirm() {
            $custid = $_SESSION["user_id"];
            $amount = $_SESSION["amount"];
            $basket = $_SESSION["basket"];
            $date = date("Y-m-d");
            $addressid = $this->filmModel->getAddress($custid)->addid;
            
            // Create payment
            if($this->filmModel->createPayment($custid, $amount, $date, $basket, $addressid)) {
                $data = ["Heading" => "Successfully Purchased"];
                unset($_SESSION["basket"]);
                $this->view("films/confirm", $data);
            } else {
                $data = ["Heading" => "Purchase Unsuccessful"];

                $this->view("films/confirm", $data);
            }
        }

        public function history() {
            $custid = $_SESSION["user_id"];
            $payments = $this->filmModel->getPayments($custid);
            $data = [
                "Heading" => "Purchase History",
                "Subheading" => "",
                "payments" => $payments
            ];

            $this->view("films/history", $data);
        }
    }
?>