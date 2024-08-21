<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags for character set and responsive design -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title of the page -->
    <title>MindQuest | Forum</title>

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery required for Bootstrap's JavaScript plugins -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js required for Bootstrap's JavaScript plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JavaScript for interactive components -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Additional Bootstrap and Popper.js for enhanced functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Including external PHP files for database connection and header -->
    <?php
    include './particles/connect.php'; // Connect to the database
    include './particles/header.php'; // Include the header of the page
    ?>

    <!-- Main content container -->
    <div class="container my-3">
        <h2 class="text-center">MindQuest Forum</h2> <!-- Page title -->

        <div class="row">
            <!-- PHP code to dynamically fetch and display categories from the database -->
            <?php
            // Query to select all categories from the database
            $sql = 'SELECT * FROM `categories`';
            $result = mysqli_query($conn, $sql); // Execute the query

            // Loop through each category and display it in a card format
            while ($row = mysqli_fetch_assoc($result)) {
                $catId = $row['category_id']; // Get the category ID
                $catName = $row['category_name']; // Get the category name
                $desc = $row['category_description']; // Get the category description
                $image = $row['category_image']; // Get the category image (assumed to be stored in BLOB format)

                // Display the category in a Bootstrap card
                echo ' 
                <div class="col-md-4">
                    <div class="card my-2" style="width: 18rem;">
                        <!-- Display the category image -->
                        <img src="data:image/jpeg;base64,' . base64_encode($image) . '" class="card-img-top" alt="Category Image">
                        <div class="card-body">
                            <!-- Display the category name as the card title -->
                            <h5 class="card-title ">' . $catName . '</h5>
                            <!-- Display a shortened version of the category description -->
                            <p class="card-text">' . substr($desc, 0, 150) . '....</p>
                            <!-- Link to the thread list for the selected category -->
                            <a href="threadslist.php?catid=' . $catId . '" class="btn btn-primary stretched-link">Read more</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap's bundled JS for enhanced functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Including external PHP file for the footer -->
    <?php
    include './particles/footer.php'; // Include the footer of the page
    ?>
</body>

</html>