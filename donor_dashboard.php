<?php
session_start();
include 'db.php';
include 'header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'donor'){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT d.*, c.title 
        FROM donations d
        JOIN campaigns c ON d.campaign_id = c.id
        WHERE d.donor_id='$user_id'";

$result = mysqli_query($conn,$sql);
?>

<h2>My Donations</h2>

<table border="1">
<tr>
    <th>Campaign</th>
    <th>Transaction ID</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['transaction_id']; ?></td>
    <td>৳<?php echo $row['amount']; ?></td>
    <td><?php echo $row['payment_status']; ?></td>
    <td><?php echo $row['donated_at']; ?></td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>