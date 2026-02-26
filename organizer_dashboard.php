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

<h2>Organizer Dashboard</h2>

<a href="create_campaign.php"><button>Create Campaign</button></a>
<a href="my_campaigns.php"><button>My Campaigns</button></a>

<h3>My Campaigns Overview</h3>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h4><?php echo $row['title']; ?> (<?php echo $row['status']; ?>)</h4>
        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>