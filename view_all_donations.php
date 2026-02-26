<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

$sql = "SELECT d.*, u.full_name, c.title 
        FROM donations d
        JOIN users u ON d.donor_id = u.id
        JOIN campaigns c ON d.campaign_id = c.id";

$result = mysqli_query($conn,$sql);
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

/* Table Container */
.table-container{
    width:90%;
    margin:30px auto;
    overflow-x:auto;
}

/* Table Styling */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}

th{
    background:#007bff;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f1f5ff;
}

/* Status Highlight */
td:nth-child(4){
    font-weight:bold;
}
</style>

<h2>All Donations</h2>

<div class="table-container">
<table>
<tr>
    <th>Donor</th>
    <th>Campaign</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Transaction ID</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td>৳<?php echo $row['amount']; ?></td>
    <td><?php echo ucfirst($row['payment_status']); ?></td>
    <td><?php echo $row['transaction_id']; ?></td>
</tr>
<?php } ?>

</table>
</div>

<?php include 'footer.php'; ?>