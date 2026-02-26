<?php
session_start();
include 'db.php';

// Redirect logged-in users to their dashboard
if(isset($_SESSION['role'])){

    if($_SESSION['role'] == 'admin'){
        header("Location: admin_dashboard.php");
        exit();
    }

    if($_SESSION['role'] == 'organizer'){
        header("Location: organizer_dashboard.php");
        exit();
    }

    if($_SESSION['role'] == 'donor'){
        header("Location: donor_dashboard.php");
        exit();
    }
}

include 'header.php';
include 'progress_bar.php';

$sql = "SELECT * FROM campaigns WHERE status='approved'";
$result = mysqli_query($conn,$sql);
?>

<!-- Inline CSS -->
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

h2{
    text-align:center;
    margin-top:20px;
}

/* Campaign Grid */
.campaign-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:20px;
    padding:30px;
}

/* Campaign Card */
.campaign-card{
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.campaign-card:hover{
    transform:translateY(-5px);
}

.campaign-card img{
    border-radius:8px;
    height:180px;
    object-fit:cover;
}

.campaign-card h3{
    margin:10px 0;
}

.campaign-card p{
    color:#555;
}

button{
    background:#28a745;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:6px;
    cursor:pointer;
    width:100%;
    font-size:16px;
}

button:hover{
    background:#218838;
}
</style>

<h2>Approved Campaigns</h2>

<div class="campaign-grid">
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="campaign-card">
        <img src="uploads/<?php echo $row['image']; ?>" width="100%">
        <h3><?php echo $row['title']; ?></h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <a href="campaign_details.php?id=<?php echo $row['id']; ?>">
            <button>View Details</button>
        </a>
    </div>
<?php } ?>
</div>

<?php include 'footer.php'; ?>