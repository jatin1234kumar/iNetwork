<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "_dbconnect.php";
    $userEmail = $_POST["email"];
    $userPass = $_POST["password"];

    $sql = "SELECT * from users where User_email='$userEmail'";
    $result = mysqli_query($conn, $sql);
    $numRow = mysqli_num_rows($result);

    if($numRow == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($userPass, $row["User_password"])){
            session_start();
            $_SESSION["username"] = $userEmail;
            $_SESSION["logdein"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            header("location: /projects/forum/index.php?logedin=true");
            exit();
        }else {
            $showError = "Incorrect Password";
            header("location: /projects/forum/index.php?logedin=false&error=$showError");
        }
    }else {
        $showError = "Invalid Useremail";
        header("location: /projects/forum/index.php?logedin=false&error=$showError");
    }
}


?>