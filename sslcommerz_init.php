<?php
$tran_id = $_GET['tran_id'];

// Simulate gateway processing delay
sleep(2);

// Redirect directly to success page
header("Location: success.php?tran_id=$tran_id");
exit();
?>