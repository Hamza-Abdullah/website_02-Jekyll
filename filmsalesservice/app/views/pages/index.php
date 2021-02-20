<?php require APPROOT . "/views/includes/header.php" ?>
<header id="showcase" class="showcase">
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
        <p><?php echo $data["Subheading"]; ?></p>
        <a href="<?php echo URLROOT; ?>users/register" class="btn btn-xl">
            Register Now <i class="fas fa-chevron-right btn-icon"></i>
        </a>
    </div>
</header>

<section class="tabs">
    <div class="container">
        <div id="tab-1" class="tab-item tab-border">
            <i class="fas fa-door-open fa-3x"></i>
            <p class="hide-sm">Easy to use</p>
        </div>
        <div id="tab-2" class="tab-item">
            <i class="fas fa-address-card fa-3x"></i>
            <p class="hide-sm">Created by Hamza Abdullah</p>
        </div>
    </div>
</section>

<section class="tab-content">
    <div class="container">
        <!-- Tab 1 content -->
        <div id="tab-1-content" class="tab-content-item show">
            <div class="tab-1-content-grid">
                <div>
                    <p class="text-lg text-light-color">
                        It's incredibly easy to join Film Sales Service.
                        Simply register today, and get access to a vast
                        collection of films to browse and purchase.
                    </p>
                    <a href="<?php echo URLROOT; ?>users/register" class="btn btn-lg">Register Now</a>
                </div>
                <img src="<?php echo URLROOT; ?>images/laptop_mockup.jpg" alt="" />
            </div>
        </div>
        <!-- Tab 2 content -->
        <div id="tab-2-content" class="tab-content-item">
            <div class="tab-2-content-top">
                <p class="text-lg">
                    Film Sales Service - Created by Hamza Abdullah.
                </p>
                <a href="<?php echo URLROOT; ?>users/register" class="btn btn-lg">Register Now</a>
            </div>
            <div class="tab-2-content-bottom">
                <div>
                    <i class="fab fa-html5"></i>
                    <p class="text-md">Born with HTML</p>
                </div>
                <div>
                    <i class="fab fa-css3-alt"></i>
                    <p class="text-md">Looks awesome with CSS</p>
                </div>
                <div>
                    <i class="fab fa-php"></i>
                    <p class="text-md">
                        Functions with PHP
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require APPROOT . "/views/includes/footer.php" ?>