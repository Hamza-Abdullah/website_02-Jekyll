<?php require APPROOT . "/views/includes/header.php" ?>
<header id="showcase" class="showcase showcase-films">
    <div class="showcase-top">
        <a href="./">
            <img src="<?php echo URLROOT; ?>images/logo_full.png" class="logo1" alt="Film Sales Service" />
            <img src="<?php echo URLROOT; ?>images/logo_small.png" class="logo2" alt="Film Sales Service" />
        </a>
        <?php if(isset($_SESSION["user_id"])) : ?>
        <a href="<?php echo URLROOT; ?>users/logout" class="topBtn btn btn-rounded">Sign Out</a>
        <?php else : ?>
        <a href="<?php echo URLROOT; ?>users/login" class="topBtn btn btn-rounded">Sign In</a>
        <?php endif; ?>
    </div>
    <div class="showcase-content">
        <h1><?php echo $data["Heading"]; ?></h1>
    </div>
</header>

<?php require APPROOT . "/views/includes/navbar.php" ?>

<?php require APPROOT . "/views/includes/footer.php" ?>