<?php
    class Users extends Controller {
        public function __construct() {
            $this->userModel = $this->model("User");
        }

        public function register() {
            if (isLoggedIn()) {
                redirect("films/index");
            }

            // Check for POST request
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process form
                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Get POST DATA
                $data = [
                    "Heading" => "Register Now",
                    "name" => trim($_POST["name"]),
                    "phone" => trim($_POST["phone"]),
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                    "confirm_password" => trim($_POST["confirmPassword"]),
                    "name_error" => "",
                    "phone_error" => "",
                    "email_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => ""
                ];

                // Validate name
                if (empty($data["name"])) {
                    $data["name_error"] = "Please enter your name.";
                }

                // Validate phone
                if (empty($data["phone"])) {
                    $data["phone_error"] = "Please enter your phone number.";
                } else {
                    // Check if phone number already exists
                    if ($this->userModel->findUserByPhone($data["phone"])) {
                        $data["phone_error"] = "That number is already registered.";
                    }
                }

                // Validate email
                if (empty($data["email"])) {
                    $data["email_error"] = "Please enter your email.";
                } else {
                    // Check if email already exists
                    if ($this->userModel->findUserByEmail($data["email"])) {
                        $data["email_error"] = "That email is already registered.";
                    }
                }

                // Validate password
                if (empty($data["password"])) {
                    $data["password_error"] = "Please enter a password.";
                } elseif (strlen($data["password"]) < 6) {
                    $data["password_error"] = "Password must be at least 6 characters.";
                }

                // Validate password confirmation
                if (empty($data["confirm_password"])) {
                    $data["confirm_password_error"] = "Please confirm your password.";
                } else {
                    if ($data["password"] != $data["confirm_password"]) {
                        $data["confirm_password_error"] = "Passwords not matching.";
                    }
                }

                // Make errors empty
                if (empty($data["name_error"]) && empty($data["phone_error"]) && 
                empty($data["email_error"]) && empty($data["password_error"]) && 
                empty($data["confirm_password_error"])) {
                    // Validated
                    
                    // Register user
                    if ($this->userModel->register($data)) {
                        alertMessage("register_success", "You have successfully registered.");
                        redirect("users/login");
                    } else {
                        die("Something went wrong.");
                    }
                } else {
                    // Load errors in view
                    $this->view("users/register", $data);
                }
            } else {
                // Initialise data
                $data = [
                    "Heading" => "Register Now",
                    "name" => "",
                    "phone" => "",
                    "email" => "",
                    "password" => "",
                    "confirm_password" => "",
                    "name_error" => "",
                    "phone_error" => "",
                    "email_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => ""
                ];

                // Load view
                $this->view("users/register", $data);
            }
        }

        public function login() {
            if (isLoggedIn()) {
                redirect("users/details");
            }
            
            // Check for POST request
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process form
                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Get POST DATA
                $data = [
                    "Heading" => "Sign In",
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                    "email_error" => "",
                    "password_error" => ""
                ];

                // Validate email
                if (empty($data["email"])) {
                    $data["email_error"] = "Please enter your email.";
                }

                // Validate password
                if (empty($data["password"])) {
                    $data["password_error"] = "Please enter your password.";
                }

                // Check user email
                if ($this->userModel->findUserByEmail($data["email"])) {
                    // User found
                } else {
                    // Not found
                    $data["email_error"] = "No user found with that email.";
                }

                // Make errors empty
                if (empty($data["email_error"]) && empty($data["password_error"])) {
                    // Validated
                    // Check and set user that has logged in
                    $loggedInUser = $this->userModel->login($data["email"], $data["password"]);

                    if ($loggedInUser) {
                        // Create session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data["password_error"] = "Password incorrect.";
                        $this->view("users/login", $data);
                    }
                } else {
                    // Load errors in view
                    $this->view("users/login", $data);
                }
            } else {
                // Initialise data
                $data = [
                    "Heading" => "Sign In",
                    "email" => "",
                    "password" => "",
                    "email_error" => "",
                    "password_error" => ""
                ];

                // Load view
                $this->view("users/login", $data);
            }
        }

        public function createUserSession($user) {
            $_SESSION["user_id"] = $user->personid;
            $_SESSION["user_email"] = $user->personemail;
            $_SESSION["user_name"] = $user->personname;
            redirect("users/details");
        }

        public function logout() {
            unset($_SESSION["user_id"]);
            unset($_SESSION["user_email"]);
            unset($_SESSION["user_name"]);
            unset($_SESSION["basket"]);
            session_destroy();
            redirect("users/login");
        }

        public function index() {
            redirect("users/login");
        }

        public function details() {
            // Check for POST request
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process form
                // Sanitise POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Get POST DATA
                $data = [
                    "Heading" => "Details",
                    "name" => trim($_POST["name"]),
                    "phone" => trim($_POST["phone"]),
                    "email" => trim($_POST["email"]),
                    "street" => trim($_POST["street"]),
                    "city" => trim($_POST["city"]),
                    "postcode" => trim($_POST["postcode"]),
                    "password" => trim($_POST["password"]),
                    "confirm_password" => trim($_POST["confirmPassword"]),
                    "name_error" => "",
                    "phone_error" => "",
                    "email_error" => "",
                    "street_error" => "",
                    "city_error" => "",
                    "postcode_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => ""
                ];

                // Validate name
                if (empty($data["name"])) {
                    $data["name_error"] = "Please enter your name.";
                }

                // Validate phone
                if (empty($data["phone"])) {
                    $data["phone_error"] = "Please enter your phone number.";
                }

                // Validate email
                if (empty($data["email"])) {
                    $data["email_error"] = "Please enter your email.";
                } else {
                    // Check if email already exists
                    if ($this->userModel->findUserByEmail($data["email"]) && $data["email"] != $_SESSION["user_email"]) {
                        $data["email_error"] = "That email is already registered.";
                    }
                }

                // Validate address
                if (empty($data["street"])) {
                    $data["street_error"] = "Please enter your address line 1.";
                } elseif (empty($data["city"])) {
                    $data["city_error"] = "Please enter your city.";
                } elseif (empty($data["postcode"])) {
                    $data["postcode_error"] = "Please enter postcode.";
                } else {
                    // Check if address already exists
                    if ($this->userModel->findAddress($data["street"], $data["city"], $data["postcode"])) {
                        $address = $this->userModel->getAddress($_SESSION["user_id"]);
                        $data["addressid"] = $address->addid;
                    }
                }

                // Validate password
                if (empty($data["password"])) {
                    $data["password_error"] = "Please enter a password.";
                } elseif (strlen($data["password"]) < 6) {
                    $data["password_error"] = "Password must be at least 6 characters.";
                }

                // Validate password confirmation
                if (empty($data["confirm_password"])) {
                    $data["confirm_password_error"] = "Please confirm your password.";
                } else {
                    if ($data["password"] != $data["confirm_password"]) {
                        $data["confirm_password_error"] = "Passwords not matching.";
                    }
                }

                // Make errors empty
                if (empty($data["name_error"]) && empty($data["phone_error"]) && 
                empty($data["email_error"]) && empty($data["password_error"]) && 
                empty($data["street_error"]) && empty($data["city_error"]) && 
                empty($data["postcode_error"]) && empty($data["confirm_password_error"])) {
                    // Validated
                    
                    // Create new address
                    if (!isset($data["addressid"])) {
                        $this->userModel->newAddress(
                            $_SESSION["user_id"], $data["street"], $data["city"], $data["postcode"]
                        );
                        $data["addressid"] = $this->userModel->getAddressID(
                            $data["street"], $data["city"], $data["postcode"]
                            )->addid;
                    }

                    // Update details user
                    if ($this->userModel->updateDetails($data)) {
                        alertMessage("register_success", "Updated details.");
                        redirect("users/details");
                    } else {
                        die("Something went wrong.");
                    }
                } else {
                    // Load errors in view
                    $this->view("users/details", $data);
                }
            } else {
                // Initialise data
                $person = $this->userModel->getUser($_SESSION["user_id"]);
                $address = $this->userModel->getAddress($_SESSION["user_id"]);
                if ($address->success == false) {
                    $address->addstreet = "";
                    $address->addcity = "";
                    $address->addpostcode = "";
                }

                $data = [
                    "Heading" => "Details",
                    "name" => $person->personname,
                    "phone" => $person->personphone,
                    "email" => $person->personemail,
                    "street" => $address->addstreet,
                    "city" => $address->addcity,
                    "postcode" => $address->addpostcode,
                    "password" => "",
                    "confirm_password" => "",
                    "name_error" => "",
                    "phone_error" => "",
                    "email_error" => "",
                    "street_error" => "",
                    "city_error" => "",
                    "postcode_error" => "",
                    "password_error" => "",
                    "confirm_password_error" => ""
                ];

                if ($address->success == false) {
                    $data["Heading"] = "Add an address";
                }

                // Load view
                $this->view("users/details", $data);
            }
        }
    }
?>