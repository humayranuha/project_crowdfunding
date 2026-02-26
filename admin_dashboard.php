<?php
session_start();
include 'db.php';
include 'header.php';
include 'progress_bar.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM campaigns");
?>

<!-- Inline CSS -->
<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
}

h2,h3{
    text-align:center;
    margin-top:20px;
}

/* Admin Menu */
.admin-menu{
    display:flex;
    justify-content:center;
    gap:15px;
    margin:20px;
    flex-wrap:wrap;
}

.admin-menu button{
    background:#007bff;
    color:white;
    border:none;
    padding:12px 18px;
    border-radius:6px;
    cursor:pointer;
    font-size:15px;
    transition:0.3s;
}

.admin-menu button:hover{
    background:#0056b3;
}

/* Campaign Cards */
.campaign-card{
    width:80%;
    margin:20px auto;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.campaign-card:hover{
    transform:translateY(-5px);
}

.campaign-card h4{
    margin-bottom:10px;
}

.campaign-card p{
    color:#555;
}
</style>

<h2>Admin Dashboard</h2>

<div class="admin-menu">
    <a href="approve_campaign.php"><button>Pending Campaigns</button></a>
    <a href="manage_users.php"><button>Manage Users</button></a>
    <a href="view_all_donations.php"><button>View Donations</button></a>
    <a href="admin_logs.php"><button>Admin Logs</button></a>
</div>

<h3>All Campaign Overview</h3>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h4><?php echo $row['title']; ?> (<?php echo $row['status']; ?>)</h4>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>