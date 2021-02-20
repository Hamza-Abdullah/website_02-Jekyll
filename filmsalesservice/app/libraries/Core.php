<?php
    /*
     * Application core class
     * Creates url and loads core controller
     * URL format: /controller/method/paramaters
     */
    
    class Core {
        protected $currentController = "Pages";
        protected $currentMethod = "index";
        protected $params = [];

        public function __construct() {
            // print_r($this->getUrl());

            $url = $this->getUrl();

            // Look in controllers for the first index
            if(file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
                // If this controller exists, set it as the controller.
                $this->currentController = ucwords($url[0]);
                // Unset zero index
                unset($url[0]);
            }

            // Require controller
            require_once("../app/controllers/" . $this->currentController . ".php");
            // Instantiate controller
            $this->currentController = new $this->currentController;

            // Check for second part of URL
            if(isset($url[1])) {
                // Check if method exists in controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset 1 index
                    unset($url[1]);
                }
            }

            // Get parameters
            $this->params = $url ? array_values($url) : [];

            // Call callback with array of parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            if (isset($_GET["url"])) {
                $url = rtrim($_GET["url"], "/");
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode("/", $url);
                return $url;
            } else {
                $url = [""];
                return $url;
            }
        }
    }
?>