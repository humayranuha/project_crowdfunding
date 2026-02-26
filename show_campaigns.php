<?php
session_start();
include 'db.php';
include 'header.php';
include 'progress_bar.php';

/* Only logged users can browse */
if(!isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}

/* Fetch only approved campaigns */
$sql = "SELECT * FROM campaigns WHERE status='approved'";
$result = mysqli_query($conn,$sql);
?>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

h2{
    text-align:center;
    margin-top:25px;
}

/* Campaign Grid */
.campaign-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:25px;
    padding:30px;
}

/* Campaign Card */
.campaign-card{
    background:white;
    padding:18px;
    border-radius:12px;
    box-shadow:0px 2px 12px rgba(0,0,0,0.1);
    transition:0.3s;
}

.campaign-card:hover{
    transform:translateY(-6px);
}

.campaign-card img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:10px;
}

.campaign-card h3{
    margin:12px 0;
}

.campaign-card p{
    color:#555;
}

/* Remove View Details Button Style */
.no-button{
    display:block;
    text-align:center;
    background:#28a745;
    color:white;
    padding:10px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}
</style>

<h2>All Approved Campaigns</h2>

<div class="campaign-grid">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="campaign-card">

        <img src="uploads/<?php echo $row['image']; ?>">

        <h3><?php echo $row['title']; ?></h3>

        <p><strong>Target:</strong> ৳<?php echo $row['target_amount']; ?></p>
        <p><strong>Raised:</strong> ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

    </div>

<?php } ?>

</div>

<?php include 'footer.php'; ?>