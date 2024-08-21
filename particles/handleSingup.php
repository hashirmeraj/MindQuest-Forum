<?php
session_start();

include './connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['userName'];
    $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
    $userEmail = $_POST['singupEmail'];
    $userPassword = $_POST['singupPassword'];
    $confirmPassword = $_POST['confirmedPassword'];

    // Check whether email exists
    $existEmail = "SELECT * FROM `users1` WHERE user_email = '$userEmail' ";
    $result = mysqli_query($conn, $existEmail);
    $numRow = mysqli_num_rows($result);

    if ($numRow > 0) {
        $error = "Email already exists";
    } else {
        if ($userPassword == $confirmPassword) {
            $hash = password_hash($userPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users1`(`user_name`, `user_email`, `user_password`) VALUES ('$userName', '$userEmail', '$hash' )";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: /MindQuest/index.php?singupsuccess=true");
                exit();
            }
        } else {
            $error = "Password does not match";
        }
    }

    $_SESSION['error'] = $error;
    header("Location: /MindQuest/index.php?singupsuccess=false&error=$error");
    exit();
}
