<?php
// Check if the message parameter is set in the URL
 //if(isset($_GET['message'])) {
     // Redirect to the same page without the message parameter
 //    header("Location: sent_notice.php");
//     exit(); // Make sure to exit after redirection
 //}
?> 
<!DOCTYPE html>
<html>
<head>
    <title>SENT NOTICE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h2 class="text-dark">NOTICE</h2>
                            <?php
                            if(isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<div class='alert alert-success'>$message</div>";
                            }
                            ?>
                            <form action="index.php" method="post">
                                <button type="submit" class="btn btn-primary w-100 mt-3">Log In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
    crossorigin="anonymous"></script>
</body>
</html>
