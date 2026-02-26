<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: index.php");
    exit();
}

/* Delete User */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM users WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM users");
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Title */
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

/* Table Design */
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

/* Delete Button */
button{
    background:#dc3545;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#c82333;
}
</style>

<h2>Manage Users</h2>

<div class="table-container">
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo ucfirst($row['role']); ?></td>
    <td>
        <a href="?delete=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this user?');">
            <button>Delete</button>
        </a>
    </td>
</tr>
<?php } ?>

</table>
</div>

<?php include 'footer.php'; ?>