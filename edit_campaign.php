<?php
include 'db.php';
include 'header.php';

$id = $_GET['id'];

if(isset($_POST['update'])){
    $title = $_POST['title'];

    mysqli_query($conn,"UPDATE campaigns SET title='$title' WHERE id='$id'");

    header("Location: my_campaigns.php");
    exit();
}

$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM campaigns WHERE id='$id'"));
?>

<style>
body{
    font-family:Arial, sans-serif;
    background:#f4f6f9;
}

/* Page Title */
h2{
    text-align:center;
    margin-top:40px;
}

/* Form Container */
.update-container{
    width:35%;
    margin:50px auto;
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    text-align:center;
}

/* Input */
.update-container input{
    width:100%;
    padding:14px;
    margin:15px 0;
    border-radius:6px;
    border:1px solid #ddd;
    font-size:16px;
}

/* Button */
button{
    width:100%;
    padding:14px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:6px;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#0056b3;
}
</style>

<h2>Update Campaign</h2>

<div class="update-container">
<form method="POST">

<input type="text" name="title" 
value="<?php echo $row['title']; ?>" required>

<button name="update">Update Campaign</button>

</form>
</div>

<?php include 'footer.php'; ?>