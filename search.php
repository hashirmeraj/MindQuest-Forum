<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search | MindQuest</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js (required for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include './particles/connect.php';
    include './particles/header.php';

    // Check if a search term is set
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        echo '<div class="container my-3">
                <h3 class="display-6 mb-5">Search result for <em>' . htmlspecialchars($search) . '</em></h3>';

        // Prepare the search query
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT * FROM `query` WHERE MATCH (`thread_title`, `thread_desc`) AGAINST ('$search')";

        // Execute the search query
        $result = mysqli_query($conn, $sql);

        // Pagination logic
        $results_per_page = 6;
        $totalRecord = mysqli_num_rows($result);
        $totalPages = ceil($totalRecord / $results_per_page);

        // Determine the current page
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
        $limitSql = "SELECT * FROM `query` WHERE MATCH (`thread_title`, `thread_desc`) AGAINST ('$search') LIMIT $results_per_page OFFSET $startingData";
        $limitResult = mysqli_query($conn, $limitSql);

        // Check if there are results
        if (mysqli_num_rows($limitResult) > 0) {
            while ($row = mysqli_fetch_assoc($limitResult)) {
                $threadId = $row['thread_id'];
                $threadTitle = $row['thread_title'];
                $threadDesc = $row['thread_desc'];

                // Display the search results
                echo '<div class="media my-3">
                    <img width="34px" src="https://th.bing.com/th/id/R.f29406735baf0861647a78ae9c4bf5af?rik=GKTBhov2iZge9Q&riu=http%3a%2f%2fcdn.onlinewebfonts.com%2fsvg%2fimg_206976.png&ehk=gCH45Zmryw3yqyqG%2fhd8WDQ53zwYfmC8K9OIkNHP%2fNU%3d&risl=&pid=ImgRaw&r=0" class="align-self-start mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0"><a class="text-decoration-none text-dark" href="thread.php?threadId=' . $threadId . '">' . $threadTitle . '</a></h5>
                        <p>' . $threadDesc . '</p>
                    </div>
                </div>';
            }

            // Pagination controls
            echo '<nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">';

            // Previous page button
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . ($page - 1) . '">Previous</a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
            }

            // Page number links
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . $i . '">' . $i . '</a></li>';
                }
            }

            // Next page button
            if ($page < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?search=' . urlencode($search) . '&page=' . ($page + 1) . '">Next</a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link">Next</a></li>';
            }

            echo '</ul>
            </nav>';
        } else {
            echo '<div class="jumbotron jumbotron-fluid border rounded-3 my-5">
                <div class="container">
                    <p aria-level="3" role="heading" style="padding-top:.33em">Your search - <span><em>' . htmlspecialchars($search) . '</em></span> - did not match any documents.</p>
                    <p style="margin-top:1em">Suggestions:</p>
                    <ul style="margin-left:1.3em;margin-bottom:2em">
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                    </ul>
                </div>
            </div>';
        }

        echo '</div>';
    }
    ?>
    <?php
    include './particles/footer.php';
    ?>
</body>

</html>