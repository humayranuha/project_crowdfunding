<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

/* Approve Campaign */
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($conn,"UPDATE campaigns SET status='approved' WHERE id='$id'");
    header("Location: approve_campaign.php");
    exit();
}

/* Reject Campaign */
if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    mysqli_query($conn,"UPDATE campaigns SET status='rejected' WHERE id='$id'");
    header("Location: approve_campaign.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM campaigns WHERE status='pending'");
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Page Title */
h2{
    text-align:center;
    margin-top:20px;
}

/* Campaign Container */
.campaign-container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:20px;
    padding:30px;
}

/* Campaign Card */
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

.campaign-card p{
    color:#555;
}

/* Buttons */
button{
    border:none;
    padding:10px 15px;
    border-radius:6px;
    cursor:pointer;
    margin-right:8px;
    color:white;
    font-size:14px;
}

button:hover{
    opacity:0.9;
}

.danger{
    background:#dc3545;
}

.danger:hover{
    background:#c82333;
}

button:not(.danger){
    background:#28a745;
}

button:not(.danger):hover{
    background:#218838;
}
</style>

<h2>Pending Campaigns</h2>

<div class="campaign-container">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">
        <h3><?php echo $row['title']; ?></h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <br><br>

        <a href="?approve=<?php echo $row['id']; ?>">
            <button>Approve</button>
        </a>

        <a href="?reject=<?php echo $row['id']; ?>">
            <button class="danger">Reject</button>
        </a>
    </div>
<?php } ?>
</div>

<?php include 'footer.php'; ?>