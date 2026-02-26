<?php
include 'db.php';
include 'header.php';

if(isset($_POST['create'])){

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $target = $_POST['target'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);

    $organizer_id = $_SESSION['user_id'];

    mysqli_query($conn,"INSERT INTO campaigns 
        (organizer_id,title,description,target_amount,image)
        VALUES ('$organizer_id','$title','$desc','$target','$image')");
}
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

/* Form Container */
.form-container{
    width:40%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
}

/* Inputs */
.form-container input,
.form-container textarea{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ddd;
    font-size:15px;
}

textarea{
    height:120px;
    resize:none;
}

/* File Input */
input[type="file"]{
    border:none;
}

/* Submit Button */
button{
    width:100%;
    padding:14px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#0056b3;
}
</style>

<h2>Create Campaign</h2>

<div class="form-container">
<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Campaign Title" required>

<textarea name="description" placeholder="Campaign Description"></textarea>

<input type="number" name="target" placeholder="Target Amount" required>

<input type="file" name="image" required>

<button name="create">Create Campaign</button>

</form>
</div>

<?php include 'footer.php'; ?>