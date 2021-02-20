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
        <p><?php echo $data["Subheading"]; ?></p>
        <a href="<?php echo URLROOT; ?>films/clear" class="btn btn-xl">
            Clear Basket <i class="fas fa-chevron-right btn-icon"></i>
        </a>
    </div>
</header>

<?php require APPROOT . "/views/includes/navbar.php" ?>

<section class="films-browse films-purchase">
    <table class="table text-xs">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>In Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalPrice = 0; ?>
            <?php for($item = 0; $item < count($data["basket"]); $item++) : ?>
            <tr>
                <td><?php echo $data["basket"][$item]["filmtitle"]; ?></td>
                <td>£<?php echo $data["basket"][$item]["price"]; ?></td>
                <td><?php echo $data["basket"][$item]["stocklevel"]; ?></td>
            </tr>
            <tr>
                <td colspan="3" class="basket">
                    <a href="<?php echo URLROOT; ?>films/remove/<?php echo $item; ?>" class="btn btn-md btn-remove">
                        Remove item <i class="fas fa-times btn-icon"></i>
                    </a>
                </td>
            </tr>
            <?php $totalPrice += $data["basket"][$item]["price"]; ?>
            <?php 
                endfor;
                $_SESSION["amount"] = $totalPrice;
            ?>
            <tr>
                <td colspan="3" class="basket text-md">
                    Total: £<?php echo $totalPrice; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="basket last">
                    <a href="<?php echo URLROOT; ?>films/confirm" class="btn btn-lg">
                        Confirm Purchase <i class="fas fa-times btn-icon"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</section>

<?php require APPROOT . "/views/includes/footer.php" ?>