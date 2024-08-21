<?php
$loginAlert = "false";
include './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userEmail = $_POST['inputEmail'];
    $userPassword = $_POST['inputPassword'];
    $existEmail = "SELECT * FROM `users1` WHERE user_email = '$userEmail' ";
    $result = mysqli_query($conn, $existEmail);
    $numRow = mysqli_num_rows($result);
    if ($numRow == 1) {
        $row = mysqli_fetch_assoc($result);
        $userName = $row['user_name'];
        $userId = $row['user_id'];
        if (password_verify($userPassword, $row['user_password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['LoggedinID'] = $userId;
            $_SESSION['userName'] = $userName;
            $_SESSION['userEmail'] = $userEmail;
            header("Location: /MindQuest/index.php?login=$userName ");
            $loginAlert = "approved";
            exit();
        } else {
            $loginAlert = "disapproved";
            header("Location: /MindQuest/index.php?login=false");
        }
    }
    header("Location: /MindQuest/index.php?login=false");
}
