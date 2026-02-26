<?php
include 'db.php';

$message = "";
$redirect = "donor_dashboard.php";

if(isset($_GET['tran_id'])){

    $tran_id = $_GET['tran_id'];

    $res = mysqli_query($conn,"SELECT * FROM donations WHERE transaction_id='$tran_id'");
    $donation = mysqli_fetch_assoc($res);

    if($donation && $donation['payment_status'] == 'pending'){

        $donation_id = $donation['id'];
        $campaign_id = $donation['campaign_id'];
        $amount = $donation['amount'];

        // Update donation status
        mysqli_query($conn,"UPDATE donations 
                            SET payment_status='success'
                            WHERE transaction_id='$tran_id'");

        // Insert SSL transaction record (mock)
        mysqli_query($conn,"INSERT INTO sslcommerz_transactions
            (donation_id, tran_id, amount, currency, status, store_amount)
            VALUES
            ('$donation_id','$tran_id','$amount','BDT','VALID','$amount')");

        // Update campaign raised amount
        mysqli_query($conn,"UPDATE campaigns
                            SET raised_amount = raised_amount + $amount
                            WHERE id='$campaign_id'");

        $message = "🎉 Payment Successful! <br> Thank you for your donation ❤️";
    }
    else{
        $message = "⚠ Transaction already processed or not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Status</title>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.success-box{
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    text-align:center;
}

.success-box h2{
    color:#28a745;
}

.success-box p{
    color:#555;
    font-size:18px;
}
</style>

<!-- Auto redirect after 4 seconds -->
<meta http-equiv="refresh" content="4;url=<?php echo $redirect; ?>">

</head>

<body>

<div class="success-box">
    <h2><?php echo $message; ?></h2>
    <p>You will be redirected to your dashboard shortly...</p>
</div>

</body>
</html>