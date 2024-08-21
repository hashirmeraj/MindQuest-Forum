<?php
include './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = "INSERT INTO `contact`(`contact_name`, `contact_email`, `contact_message`) VALUES ('[value-1]','[value-2]','[value-3]')";
    $result = mysqli_query($conn, $sql);
    $contactAlert = false;
    if ($result) {
        $contactAlert = true;
        header("Location: /MindQuest/contact.php?submit=true");
        exit();
    } else {
        $contactAlert = false;
        header("Location: /MindQuest/contact.php?submit=error");
        exit();
    }
}
header("Location:MindQuest/contact.php");
exit();
