<?php
session_start();
include 'db.php';
include 'header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'organizer'){
    header("Location: index.php");
    exit();
}

$organizer_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM campaigns WHERE organizer_id='$organizer_id'");
?>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
}

/* Page Title */
h2,h3{
    text-align:center;
    margin-top:20px;
}

/* Action Buttons */
.organizer-actions{
    text-align:center;
    margin:25px;
}

.organizer-actions button{
    background:#28a745;
    color:white;
    border:none;
    padding:12px 18px;
    margin:5px;
    border-radius:6px;
    font-size:15px;
    cursor:pointer;
    transition:0.3s;
}

.organizer-actions button:hover{
    background:#218838;
}

/* Campaign Cards */
.campaign-container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:20px;
    padding:30px;
}

.campaign-card{
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

<h2>Organizer Dashboard</h2>

<div class="organizer-actions">
    <a href="create_campaign.php"><button>Create Campaign</button></a>
    <a href="my_campaigns.php"><button>My Campaigns</button></a>
</div>

<h3>My Campaigns Overview</h3>

<div class="campaign-container">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h4><?php echo $row['title']; ?> (<?php echo $row['status']; ?>)</h4>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>
    </div>
<?php } ?>
</div>

<?php include 'footer.php'; ?>