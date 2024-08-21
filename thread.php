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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-------import php files---->
    <?php include './particles/connect.php';
    include './particles/header.php';
    $prompt = false;
    ?>


    <!---- PHP for Insert comments--->
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $id = $_GET['threadId'];
        $commentDesc = $_POST['commentDesc'];
        $commentDesc = htmlspecialchars($commentDesc, ENT_QUOTES, 'UTF-8');
        $userId = $_POST['loginId'];
        $sql = "INSERT INTO `comments`(`comment_desc`, `thread_Id`, `comment_Userid`) VALUES ('$commentDesc', '$id', '$userId')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $prompt = true;
        }
    }
    ?>

    <!---- PHP for showing alert--->
    <?php

    if ($prompt) {
        echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Comment added Sucesscully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
    }
    ?>



    <!----- Showing Head----->
    <?php
    $threadId = $_GET['threadId'];
    $sql = "SELECT * FROM `query` WHERE thread_id = $threadId";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $threadTitle = $row['thread_title'];
        $threadDesc = $row['thread_desc'];
    }
    ?>
    <!--- Body Of Jumbotron --->
    <div class="container my-4">
        <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-normal"> <?php echo $threadTitle ?> </h1>
                <p class="col-md-15 fs-6"> <?php echo $threadDesc ?></p>
            </div>

            <hr />

            <!-- display Poster name -->
            <?php

            // fetching Poster Id from Query Table

            $sql = "SELECT `thread_userId`FROM `query` WHERE `thread_id` = $threadId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $posterId = $row['thread_userId'];

            // fetching Poster Name from User table using Poster id

            $sql2 = "SELECT  `user_name` FROM `users1` WHERE `user_id` = $posterId";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posterName = $row2['user_name'];

            //Poster Name
            echo '<p>Posted by: <em><b>' . ucfirst($posterName) . '</b></em></p>';
            ?>
        </div>
    </div>
    <!-- input comment -->
    <div class="container my-2">
        <h3>Post a Comment</h3>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $loginId = $_SESSION['LoggedinID'];
            echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
            <div class="form-group">
            <label for="textArea">Type your answer</label>
            <textarea name="commentDesc" class="form-control" id="textArea" rows="3"></textarea>
            <input type="hidden" name="loginId" value="' . $loginId . '">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
            </div>';
        } else {
            echo '
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Note:</strong> You are not logged in. Please <a data-bs-toggle="modal" data-bs-target="#loginModel" class="alert-link">login</a> to post a comment.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>


        <!---Solution----->
        <div class="container my-5 ">
            <h2>Discussion</h2>
            <!-- php for fetching comments from databse-->
            <?php
            $id = $_GET['threadId'];

            // Finding total number of records
            $sql = "SELECT * FROM `comments` WHERE thread_Id = $id";
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
            $limitSql = "SELECT * FROM `comments` WHERE thread_Id = $id LIMIT $results_per_page OFFSET $startingData";
            $limitResult = mysqli_query($conn, $limitSql);

            // Display comments 
            $noResult = true;
            while ($row = mysqli_fetch_assoc($limitResult)) {
                $noResult = false;
                $commentId = $row['comment_id'];
                $commentDesc = $row['comment_desc'];
                $userId =  $row['comment_Userid'];
                $commentTime = $row['comment_time'];
                $commentTime = date("F j, Y");

                // fetching user name from user table 
                $sql2 = "SELECT  `user_name` FROM `users1` WHERE `user_id` = $userId";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $username = $row2['user_name'];

                echo '<div class="media my-3  ">
            <img width="34px" src="https://th.bing.com/th/id/R.f29406735baf0861647a78ae9c4bf5af?rik=GKTBhov2iZge9Q&riu=http%3a%2f%2fcdn.onlinewebfonts.com%2fsvg%2fimg_206976.png&ehk=gCH45Zmryw3yqyqG%2fhd8WDQ53zwYfmC8K9OIkNHP%2fNU%3d&risl=&pid=ImgRaw&r=0" class="align-self-start mr-3" alt="...">
            <div class="media-body">
                <p class=" my-0"><span class="font-weight-bold mr-5"> ' . ucfirst($username) . '</span> ' . $commentTime . ' </p>
                <p class="mt-0"> ' . $commentDesc . '</p>
            </div>
        </div>';
            }

            if ($noResult) {
                echo '<div class="container my-5">
            <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-normal">No Results</h1>
                    <p class="col-md-8 fs-4">Be the first person to post a comment.</p>
                </div>
            </div>
        </div>';
            } else {
                // Pagination
                echo '
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">';

                // Previous page button
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?threadId=' . $threadId . '&page=' . ($page - 1) . '">Previous</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
                }

                // Page number links
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="?threadId=' . $threadId . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Next page button
                if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?threadId=' . $threadId . '&page=' . ($page + 1) . '">Next</a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
                }

                echo '</ul>
                </nav>';
            }
            ?>

        </div>
    </div>
    <?php
    include './particles/footer.php';
    ?>
</body>

</html>