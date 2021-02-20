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
                <th>Amount</th>
                <th>Date</th>
                <th>Films Purchased</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data["payments"] as $payment) : ?>
            <tr>
                <td>£<?php echo $payment->amount; ?></td>
                <td><?php echo $payment->paydate; ?></td>
                <td><?php echo $payment->films; ?></td>
            </tr>
            <tr>
                <td colspan="3" class="basket">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require APPROOT . "/views/includes/footer.php" ?>