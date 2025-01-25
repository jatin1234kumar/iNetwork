<?php 

$showError = false;
$showAlert = false;

if($_SERVER["REQUEST_METHOD"] = "POST"){
    include '_dbconnect.php';
    $userEmail = $_POST['email'];
    $userPass = $_POST['password'];
    $userCPass = $_POST['confirmPassword'];

    $sql = "SELECT * from users where User_email='$userEmail'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num != 0){
        $showError = "Username already exists! Try with another username"; 
        header ("location: /projects/forum/index.php?signupsuccess=false&error=$showError");
        exit();
    } else{
        if($userPass === $userCPass){
            $passHash = password_hash($userPass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`S.no.`, `User_email`, `User_password`, `Date`) VALUES (Null, '$userEmail', '$$passHash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = "Successfully signed up! You can now login.";
                header ("location: /projects/forum/index.php?signupsuccess=true&success=$showAlert");
                exit();
            }
        }else {
            $showError = "Passwords do not match, Please try again";
            header ("location: /projects/forum/index.php?signupsuccess=false&error=$showError");
        }
    }
}

?>