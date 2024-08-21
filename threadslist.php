<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thread | MindQuest</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js (required for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include './particles/connect.php'; ?>
    <?php include './particles/header.php'; ?>

    <?php
    // PHP code to handle form submission
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $catid = $_GET['catid'];
        $th_title = $_POST['threadTitle'];
        $th_title = htmlspecialchars($th_title, ENT_QUOTES, 'UTF-8');
        $th_desc = $_POST['threadDesc'];
        $th_desc = htmlspecialchars($th_desc, ENT_QUOTES, 'UTF-8');
        $userId = $_POST['loginId'];
        $sql = "INSERT INTO `query` (`thread_title`, `thread_desc`, `thread_catId`, `thread_userId`) VALUES ('$th_title', '$th_desc', '$catid', '$userId')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Thread was added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    }
    ?>

    <?php
    // PHP code to fetch and display category details
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $catid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row['category_name'];
        $desc = $row['category_description'];
    }
    ?>
    <!--- Body Of Jumbotron--->
    <div class="container my-4">
        <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-normal">Welcome to <?php echo $catName; ?> Forum</h1>
                <p class="col-md-15 fs-6"><?php echo $desc; ?></p>
            </div>
            <hr />
            <p>Posted by: <em><b>Admin</b></em></p>
        </div>
    </div>

    <!---Form for Asking Question--->
    <div class="container my-2">
        <h3>Ask a Thread</h3>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $loginId = $_SESSION['LoggedinID'];
            echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <div class="form-group">
                <label for="threadTitle">Thread Title</label>
                <input type="text" name="threadTitle" class="form-control" id="threadTitle" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Write your thread concisely and clearly.</small>
            </div>
            <div class="form-group">
                <label for="textArea">Thread Description</label>
                <textarea name="threadDesc" class="form-control" id="textArea" rows="3"></textarea>
                <input type="hidden" name="loginId" value="' . $loginId . '">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>';
        } else {
            echo '
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Note:</strong> You are not logged in. Please <a data-bs-toggle="modal" data-bs-target="#loginModel" class="alert-link">login</a> to start a discussion.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>

        <!---Questions----->
        <div class="container my-5">
            <h2>Browse Questions</h2>
            <?php
            // Finding total number of records
            $sql = "SELECT * FROM `query` WHERE thread_catId = $catid";
            $result = mysqli_query($conn, $sql);

            // Pagination logic
            $results_per_page = 6;
            $totalRecord = mysqli_num_rows($result);
            $totalPages = ceil($totalRecord / $results_per_page);

            if (!isset($_GET['page']) || $_GET['page'] <= 0) {
                $page = 1;
            } else {
                $page = (int)$_GET['page'];
                if ($page > $totalPages) {
                    $page = $totalPages;
                }
            }

            $startingData = ($page - 1) * $results_per_page;

            // SQL for limited records 
            $limitSql = "SELECT * FROM `query` WHERE `thread_catId` = $catid LIMIT $results_per_page OFFSET $startingData";
            $limitResult = mysqli_query($conn, $limitSql);

            // Display questions 
            $noResult = true;
            while ($row = mysqli_fetch_assoc($limitResult)) {
                $noResult = false;
                $threadId = $row['thread_id'];
                $threadTitle = $row['thread_title'];
                $threadDesc = $row['thread_desc'];
                $thread_userId = $row['thread_userId'];
                $threadTime = $row['date'];
                $threadTime = date("F j, Y");
                // Fetching user name from user table 
                $sql2 = "SELECT `user_name` FROM `users1` WHERE `user_id` = $thread_userId";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $username = $row2['user_name'];

                // Showing questions 
                echo '<div class="media my-3">
                    <img width="34px" src="https://th.bing.com/th/id/R.f29406735baf0861647a78ae9c4bf5af?rik=GKTBhov2iZge9Q&riu=http%3a%2f%2fcdn.onlinewebfonts.com%2fsvg%2fimg_206976.png&ehk=gCH45Zmryw3yqyqG%2fhd8WDQ53zwYfmC8K9OIkNHP%2fNU%3d&risl=&pid=ImgRaw&r=0" class="align-self-start mr-3" alt="...">
                    <div class="media-body">
                        <p class="my-0"> <span class="font-weight-bold mr-5">' . ucfirst($username) . '</span> ' . $threadTime . '</p>
                        <h5 class="mt-0"><a class="text-decoration-none text-dark" href="thread.php?threadId=' . $threadId . '">' . $threadTitle . '</a></h5>
                        <p>' . $threadDesc . '</p>
                    </div>
                </div>';
            }

            if ($noResult) {
                echo '
                <div class="jumbotron jumbotron-fluid border rounded-3">
                    <div class="container">
                        <h1 class="display-6">No Question Found</h1>
                        <p class="lead">Be the first person to ask a Question.</p>
                    </div>
                </div>';
            } else {
                // Pagination
                echo '
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">';

                // Previous page button
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?catid=' . $catid . '&page=' . ($page - 1) . '">Previous</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
                }

                // Page number links
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?catid=' . $catid . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Next page button
                if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?catid=' . $catid . '&page=' . ($page + 1) . '">Next</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
                }

                echo '</ul>
                </nav>';
            }
            ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
    include './particles/footer.php';
    ?>
</body>

</html>