<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['role'] = $row['role'];

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}

include 'header.php';
?>

<style>
.login-container{
    width:100%;
    display:flex;
    justify-content:center;
    margin-top:60px;
    margin-bottom:60px;
}

.login-box{
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0px 2px 15px rgba(0,0,0,0.1);
    width:350px;
    text-align:center;
}

.login-box h2{
    margin-bottom:25px;
}

.login-box input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ddd;
}

.login-box button{
    width:100%;
    padding:12px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

.login-box button:hover{
    background:#0056b3;
}
</style>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>