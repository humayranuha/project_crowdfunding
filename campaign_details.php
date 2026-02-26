<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

$id = $_GET['id'];
$sql = "SELECT * FROM campaigns WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Campaign Container */
.campaign-details{
    width:60%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    text-align:center;
}

/* Title */
.campaign-details h2{
    margin-bottom:20px;
}

/* Campaign Image */
.campaign-details img{
    width:100%;
    max-height:400px;
    object-fit:cover;
    border-radius:10px;
}

/* Text Style */
.campaign-details p{
    color:#555;
    line-height:1.6;
    margin:10px 0;
}

/* Donate Button */
.donate-btn{
    margin-top:20px;
    display:inline-block;
    background:#28a745;
    color:white;
    padding:14px 25px;
    border-radius:8px;
    text-decoration:none;
    font-size:18px;
    transition:0.3s;
}

.donate-btn:hover{
    background:#218838;
}
</style>

<div class="campaign-details">

<h2><?php echo $row['title']; ?></h2>

<img src="uploads/<?php echo $row['image']; ?>">

<p><?php echo $row['description']; ?></p>

<p><strong>Target:</strong> ৳<?php echo $row['target_amount']; ?></p>
<p><strong>Raised:</strong> ৳<?php echo $row['raised_amount']; ?></p>

<?php showProgress($row['raised_amount'],$row['target_amount']); ?>

<br>

<a class="donate-btn" href="donate.php?id=<?php echo $row['id']; ?>">
    Donate Now
</a>

</div>

<?php include 'footer.php'; ?>