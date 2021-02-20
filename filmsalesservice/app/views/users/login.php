<?php require APPROOT . "/views/includes/header.php" ?>
<header id="showcase" class="showcase">
    <div class="showcase-top">
        <a href="<?php echo URLROOT; ?>">
            <img src="<?php echo URLROOT; ?>images/logo_full.png" class="logo1" alt="Film Sales Service" />
            <img src="<?php echo URLROOT; ?>images/logo_small.png" class="logo2" alt="Film Sales Service" />
        </a>
        <a href="<?php echo URLROOT; ?>users/register" class="topBtn btn btn-rounded">Register Now</a>
    </div>
    <div class="showcase-content">
        <?php alertMessage("register_success"); ?>
        <h1><?php echo $data["Heading"]; ?></h1>
        <form class="sign-in" action="" method="post">
            <label class="text-md" for="email">Email:</label>
            <div class="input">
                <input class="<?php echo (!empty($data["email_error"])) ? "error-input" : ""; ?>" type="email"
                    name="email" id="email" value="<?php echo $data["email"]; ?>" />
                <p class="<?php echo (!empty($data["email_error"])) ? "error-message" : ""; ?>">
                    <?php echo $data["email_error"]; ?>
                </p>
            </div>
            <label class="text-md" for="password">Password:</label>
            <div class="input">
                <input class="<?php echo (!empty($data["password_error"])) ? "errorinput" : ""; ?>" type="password"
                    name="password" id="password" value="<?php echo $data["password"]; ?>" />
                <p class="<?php echo (!empty($data["password_error"])) ? "error-message" : ""; ?>">
                    <?php echo $data["password_error"]; ?>
                </p>
            </div>
            <button type="submit" class="btn btn-lg">
                Sign In <i class="fas fa-chevron-right btn-icon"></i>
            </button>
        </form>
    </div>
</header>
<?php require APPROOT . "/views/includes/footer.php" ?>