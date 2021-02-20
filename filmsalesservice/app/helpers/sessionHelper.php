<?php
    session_start();

    // Set up basket
    if (!isset($_SESSION["basket"])) {
        $_SESSION["basket"] = [];
    }

    // Alert message helper
    function alertMessage($name = "", $message = "", $class = "alert-green") {
        if (!empty($name)) {
            if(!empty($message) && empty($_SESSION[$name])) {
                if (!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }

                if (!empty($_SESSION[$name . "_class"])) {
                    unset($_SESSION[$name . "_class"]);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name . "_class"] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . "_class"]) ? $_SESSION[$name . "_class"] : "";
                echo "<div class=\"$class\" id=\"alert-message\">" . $_SESSION[$name] . "</div>";
                unset($_SESSION[$name]);
                unset($_SESSION[$name . "_class"]);
            }
        }
    }

    // Check if logged in
    function isLoggedIn() {
        if (isset($_SESSION["user_id"])) {
            return true;
        } else {
            return false;
        }
    }
?>