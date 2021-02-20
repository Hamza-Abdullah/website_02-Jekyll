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
    </div>
</header>

<?php require APPROOT . "/views/includes/navbar.php" ?>

<section class="films-browse">
    <table class="table text-xs">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data["films"] as $film) : ?>
            <tr>
                <td><?php echo $film->filmtitle; ?></td>
                <td><?php echo $film->filmdescription; ?></td>
                <td><?php echo $film->Genre; ?></td>
                <td><?php echo $film->filmrating; ?></td>
                <td>£6.99</td>
            </tr>
            <tr>
                <td colspan="5" class="basket">
                    <?php if($film->stocklevel > 0) : ?>
                    <a href="<?php echo URLROOT; ?>films/add/<?php echo $film->filmid; ?>" class="btn btn-md">
                        Add to basket <i class="fas fa-chevron-right btn-icon"></i>
                    </a>
                    <?php else : ?>
                    OUT OF STOCK
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require APPROOT . "/views/includes/footer.php" ?>