<?php
session_start();

// Clear session data
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.logout-box{
    background:white;
    padding:40px;
    border-radius:10px;
    text-align:center;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
}

.logout-box h2{
    color:#28a745;
}

.logout-box a{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#007bff;
    color:white;
    padding:10px 20px;
    border-radius:6px;
    transition:0.3s;
}

.logout-box a:hover{
    background:#0056b3;
}
</style>

</head>

<body>

<div class="logout-box">
    <h2>You have been logged out successfully</h2>
    <p>Redirecting to home page...</p>

    <a href="index.php">Go to Home</a>
</div>

</body>
</html>

<?php
// Optional auto redirect after 3 seconds
header("refresh:3;url=index.php");
exit();
?>