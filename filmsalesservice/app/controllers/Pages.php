<?php
    class Pages extends Controller {
        public function __construct() {
            
        }

        public function index() {
            $data = [
                "Heading" => "Explore the world of film",
                "Subheading" => "Sign in to a whole new world."
            ];
            $this->view("pages/index", $data);
        }
    }
?>