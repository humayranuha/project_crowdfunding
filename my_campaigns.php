<?php
include 'db.php';
include 'header.php';
include 'progress_bar.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM campaigns WHERE organizer_id='$user_id'");
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Page Title */
h2{
    text-align:center;
    margin-top:30px;
}

/* Campaign Grid */
.campaign-container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
    gap:25px;
    padding:30px;
}

/* Campaign Card */
.campaign-card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.campaign-card:hover{
    transform:translateY(-5px);
}

/* Text Style */
.campaign-card p{
    color:#555;
}

/* Buttons */
button{
    padding:10px 16px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    margin-right:8px;
    color:white;
    font-size:14px;
}

/* Edit Button */
button{
    background:#007bff;
}

button:hover{
    opacity:0.9;
}

/* Delete Button */
.danger{
    background:#dc3545;
}

.danger:hover{
    background:#c82333;
}
</style>

<h2>My Campaigns</h2>

<div class="campaign-container">

<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div class="campaign-card">

        <h3>
            <?php echo $row['title']; ?> 
            (<?php echo ucfirst($row['status']); ?>)
        </h3>

        <p>Target: ৳<?php echo $row['target_amount']; ?></p>
        <p>Raised: ৳<?php echo $row['raised_amount']; ?></p>

        <?php showProgress($row['raised_amount'],$row['target_amount']); ?>

        <br><br>

        <a href="edit_campaign.php?id=<?php echo $row['id']; ?>">
            <button>Edit</button>
        </a>

        <a href="delete_campaign.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure you want to delete this campaign?');">
            <button class="danger">Delete</button>
        </a>

    </div>
<?php } ?>

</div>

<?php include 'footer.php'; ?>