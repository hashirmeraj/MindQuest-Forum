<!DOCTYPE html>
<html lang="en">




    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us | MindQuest</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- jQuery (not required for Bootstrap 5 but included in your code) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js (required for Bootstrap 5) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-..."></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Header section including external PHP files for database connection and page header -->
    <header>
        <?php
        include './particles/connect.php'; // Connect to the database
        include './particles/header.php';  // Include the page header
        ?>
    </header>

    <!-- Main container for the About Us section -->
    <div class="container about-section mb-5 mt-4">
        <!-- Jumbotron for a large, prominent introduction -->
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">About MindQuest Forum</h1>
                <p class="lead">Welcome to MindQuest Forum, your go-to destination for engaging discussions and vibrant community interactions. At MindQuest, we believe in the power of shared knowledge and the value of diverse perspectives.</p>
            </div>
        </div>

        <!-- Section for the forum's mission -->
        <h2 class="display-6">Our Mission</h2>
        <p class="lead">Our mission is to provide a welcoming and inclusive space where users can connect, learn, and grow. Whether you’re seeking advice, sharing your expertise, or exploring new interests, MindQuest Forum is here to support your journey.</p>

        <!-- Section outlining what the forum offers -->
        <h2 class="display-6">What We Offer</h2>
        <ul class="lead">
            <li><strong>Engaging Discussions:</strong> Join threads on a wide range of topics and contribute to meaningful conversations.</li>
            <li><strong>Knowledge Sharing:</strong> Access and contribute to a wealth of information and insights from fellow members.</li>
            <li><strong>Community Support:</strong> Find and offer support within a network of like-minded individuals.</li>
            <li><strong>Expert Advice:</strong> Get answers to your questions from experts and experienced community members.</li>
        </ul>

        <!-- Section describing the forum's core values -->
        <h2 class="display-6">Our Values</h2>
        <p class="lead">At MindQuest Forum, we uphold the values of respect, collaboration, and integrity. We strive to create a positive environment where everyone feels valued and heard.</p>

        <!-- Invitation for users to join the forum -->
        <h2 class="display-6">Join Us</h2>
        <p class="lead">Becoming a part of MindQuest Forum is easy. Sign up today to start participating in discussions, connecting with others, and making the most of our community resources. We look forward to welcoming you!</p>

        <!-- Contact section with email link -->
        <h2 class="display-6">Contact Us</h2>
        <p class="lead">If you have any questions or feedback, please don’t hesitate to reach out to us at <a href="mailto:support@mindquestforum.com">support@mindquestforum.com</a>. We are always here to help!</p>
    </div>

    <!-- Bootstrap JS and dependencies for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Footer section including external PHP file for the footer -->
    <?php
    include './particles/footer.php'; // Include the page footer
    ?>

    <!-- Repeated Bootstrap JS script (should be removed to avoid redundancy) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
