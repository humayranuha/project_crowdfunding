<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crowdfunding Platform</title>
</head>
<body>

<nav>
    <a href="index.php">Home</a>

<?php if(!isset($_SESSION['role'])){ ?>

    <a href="login.php">Login</a>
    <a href="register.php">Register</a>

<?php } else { ?>

    <?php if($_SESSION['role'] == 'admin'){ ?>
        <a href="admin_dashboard.php">Dashboard</a>
    <?php } ?>

    <?php if($_SESSION['role'] == 'organizer'){ ?>
        <a href="organizer_dashboard.php">Dashboard</a>
    <?php } ?>

    <?php if($_SESSION['role'] == 'donor'){ ?>
        <a href="donor_dashboard.php">Dashboard</a>
    <?php } ?>

    <a href="logout.php">Logout</a>

<?php } ?>

</nav>
<hr>