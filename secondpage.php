<?php
session_start();
include "db_conn.php";
// Assuming $user_id contains the user's unique identifier
$sql = "SELECT * FROM `user_profile` WHERE user_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: loginform.php');
    exit;
}

if (mysqli_num_rows($result) > 0) {
    // Fetch the data
    $row = mysqli_fetch_assoc($result);
    // Decode the JSON string for projects
   
} else {
    echo "No user found with ID: " . $user_id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Name - Personal Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Set height of the sections to fill the viewport */
        #profile,
        #education,
        #skills,
        #projects,
        #contact {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            margin: 0;
            padding: 0;
        }

        /* Center the headers */
        h1, h2 {
            margin-top: 0; /* Remove default margin */
        }

        /* Style the user's name and profession */
        .user-name {
            font-size: 3.5em;
            font-weight: bold;
            margin-bottom: 0.1em;
            white-space: nowrap; /* Ensure username stays on one line */
        }

        .user-profession {
            font-size: 2.2em;
            font-weight: bold;
            color: gray;
            margin-bottom: 0.1em;
        }

        /* Style the profile picture */
        .profile-pic {
            width: 350px;
            height: 350px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Style the bio */
        .bio {
            font-size: 1em;
            font-weight: bold;
            margin-top: 0.1em;
        }

        /* Style the contact information */
        .contact-info {
            margin-top: 1em;
        }

        .contact-info h3 {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 0.5em;
        }

        .contact-info p {
            font-size: 0.9em;
            margin-bottom: 1em;
            white-space: nowrap; /* Ensure contact info stays on one line */
        }

        .contact-info i {
            margin-right: 5px; /* Add space between icons and text */
        }

        /* Style the edit profile link */
        .edit-profile {
            position: absolute;
            bottom: -25px;
        }

        .edit-profile i {
            margin-right: 5px;
        }

        .blur-bg {
            background-size: cover;
            backdrop-filter: blur(8px); /* Adjust blur intensity as needed */
            -webkit-backdrop-filter: blur(8px); /* For Safari */
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  background: url("background.jpg") no-repeat;
  background-size: cover;
  background-position: center;
}
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px 100px;
  background: rgba(255, 255, 255, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  backdrop-filter: blur(10px);
  border-bottom: 2px solid rgba(255, 255, 255, 0.2);
  z-index: 100;
}
.header::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.4),
    transparent
  );
  transition: 0.5s;
}
.header:hover::before {
  left: 100%;
}
.logo {
  color: black;
  font-size: 25px;
  text-decoration: none;
  font-weight: 600;
  cursor: default;
}
.navbar a {
  color: black;
  font-size: 18px;
  text-decoration: none;
  margin-left: 35px;
  transition: 0.3s;
}
.navbar a:hover {
  color: #f00;
}
#menu-icon {
  font-size: 36px;
  color: #fff;
  display: none;
}
/* BREAKPOINTS */
@media (max-width: 992px) {
  .header {
    padding: 1.25rem 4%;
  }
}
@media (max-width: 768px) {
  #menu-icon {
    display: block;
  }
  .navbar {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    padding: 0.5rem 4%;
    display: none;
  }
  .navbar.active {
    display: block;
  }
  .navbar a {
    
    display: block;
    margin: 1.5rem 0;
  }
  .nav-bg {
    position: absolute;
    top: 79px;
    left: 0;
    width: 100%;
    height: 295px;
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    z-index: 99;
    display: none;
  }
  .nav-bg.active {
    display: block;
  }
}

        /* Additional styling for the logout button */
        .btn-logout {
            color: white;
            background-color: #dc3545;
            border: none;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            margin-left: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Hover effect for the logout button */
        .btn-logout:hover {
            background-color: #c82333; /* Darker shade of red on hover */
        }

        .profile-section {
            background-image: url('your-cool-background-image.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0; /* Add some padding to the section if needed */
        }

        body {
            cursor: none;
            margin: 0; /* Remove default margin */
        }

        body h1 {
            color: #fff;
            font-family: "Protest Riot", sans-serif;
            font-size: 60px;
        }

        .cursor {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: deepskyblue;
            mix-blend-mode: difference;
            pointer-events: none;
           
           
        }

       

        #profile {
    position: relative;
    padding: 40px 0; /* Adjust padding as needed */
    background-color: transparent; /* Fallback background color */
    background-size: cover; /* Cover the entire element with the background image */
    overflow: hidden; /* Ensure the video does not overflow the container */
}

#bg-video {
    position: absolute;
    top: -10;
    left: 10;
    width: 100%;
    height: 120%;
    object-fit: cover; /* Ensure the video covers the entire element */
    z-index: -1; /* Ensure the video stays behind the content */
    background-position: bottom right; /* Align video to the bottom-right */
}

        .profile-image-container {
            border: 2px solid blue; /* Blue border */
            border-radius: 50%; /* Circular shape */
            width: 150px; /* Adjust the size as needed */
            height: 150px;
            overflow: hidden; /* Hide overflow to keep the circle shape */
            margin: 0 auto; /* Center the image */
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintain aspect ratio and cover the container */
        }

        .blue-border {
            border: 3px solid #31304D; /* Blue border color */
            padding: 3px; /* Adjust padding if needed */
        }

        .custom-card {
            background-color: transparent !important;
            border: none;
        }

        .list-group {
            background-color: transparent;
            border: none; /* Remove any border */
        }

        .list-group-item {
            background-color: transparent;
            border: none; /* Remove any border */
            margin-bottom: -16px; /* Adjust the bottom margin as needed */
        }

        .btn-custom {
            background-color: transparent; /* Specify your desired color */
            border-color: transparent; /* Specify your desired color */
        }

        .btn-custom:hover {
            background-color: transparent; /* Specify your desired hover color */
            border-color: #31304D; /* Specify your desired hover color */
        }

        /* Updated font and font size */
        .text-center,
        .text-muted {
            font-family: Arial, sans-serif;
            font-size: 20px;
        }

        .list-group-item strong {
            font-family: Arial, sans-serif;
            font-size: 25px;
        }

        .list-group-item p {
            font-family: Arial, sans-serif;
            font-size: 20px;
        }
        .logout-btn {
            font-size: 18px; /* Font size */
            font-weight: bold; /* Font weight */
            position: fixed;
            top: 5px; /* Adjust the distance from the top as needed */
            right: 20px; /* Adjust the distance from the right as needed */
            z-index: 9999; /* Ensure it's above other content */
            background-color: transparent; /* Default background color */
            color: black; /* Default text color */
            padding: 10px 20px; /* Adjust padding as needed */
            border-radius: 5px; /* Rounded corners */
            text-decoration: none; /* Remove underline */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        .logout-btn:hover {
            background-color: transparent; /* Background color on hover */
        }
        
    </style>
    
</head>
<body>
<header class="header">
<a href="logout.php" class="logo"><i class="fas fa-sign-out-alt"></i></a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="#profile">PROFILE</a>
            <a href="#education">EDUCATION</a>
            <a href="#skills">SKILLS</a>
            <a href="#projects">PROJECTS</a>
            <a href="#contact">CONTACT</a>
            
        </nav>
        <a href="publicView.php?user_id=<?php echo $_SESSION['user_id'] ?>"><i class="fas fa-eye"></i>View As</a>
    </header>
    <div class="nav-bg"></div>
    <script src="script.js"></script>

    <section class="content">
        <section id="profile">
        <video autoplay muted loop id="bg-video">
        <source src="img/Green Minimalist Illustrated Landscape Desktop Wallpaper (5).mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
            <div class="container-fluid">
                <?php
                // Check for error messages (from both GET and session)
                if (isset($_GET['error'])) {
                    $error_message = urldecode($_GET['error']);
                    echo "<div class='alert alert-danger'>$error_message</div>";
                } elseif (isset($_SESSION['user_pass_error'])) {
                    $error_message = $_SESSION['user_pass_error'];
                    echo "<div class='alert alert-danger'>$error_message</div>";
                    unset($_SESSION['user_pass_error']);  // Clear session error
                }

                // Check for success messages (from both GET and session)
                if (isset($_GET['success'])) {
                    $success_message = urldecode($_GET['success']);
                    echo "<div class='alert alert-success'>$success_message</div>";
                }
                ?>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline mx-auto bg-transparent custom-card">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <style>
                                        .profile-pic {
    width: 150px; /* Adjust the size as needed */
    height: 150px;
    border-radius: 50%; /* Make it a circle */
    border: 2px solid black; /* Black border */
}

                                    </style>
                                    <img src="<?php echo !empty($row['image']) ? $row['image'] : 'img/profile.png' ?>" alt="Profile Picture" class="profile-pic">

                                </div>
                                <h3 class="profile-username text-center" style="font-family: Arial, sans-serif; font-size: 35px; margin-top: 20px;">
                                    <strong><?php echo $row['full_name'] ?></strong><span></span>
                                </h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <div class="text-center">
                                            <i></i> <strong><?php echo !empty($row['profession']) ? $row['profession'] : 'No profession specified' ?></strong>
                                        </div>
                                        <a class="float-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="text-center">
                                            <strong><i class=""></i></strong>
                                            <p class="text-muted"><?php echo $row['bio'] ?></p>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-phone"></i> <?php echo !empty($row['phone_number']) ? $row['phone_number'] : 'No phone number provided' ?>
                                        <a class="float-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-map-marker-alt"></i> <?php echo !empty($row['address']) ? $row['address'] : 'No address specified' ?>
                                        <a class="float-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-envelope"></i> <?php echo !empty($row['email']) ? $row['email'] : 'No email available' ?>
                                        <a class="float-right"></a>
                                    </li>
                                </ul>
                                
                                <div class="col-12">
                                    <a href="editProfile.php" class="btn btn-custom btn-block">Edit Profile</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>




<style>

    .list-group {
        background-color: transparent;
        border: none; /* Remove any border */

    }

    .list-group-item {
        background-color: transparent;
        border: none; /* Remove any border */
    }

    .btn-custom {
        background-color: #transparent; /* Specify your desired color */
        border-color: #; /* Specify your desired color */
    }

    .btn-custom:hover {
        background-color: #; /* Specify your desired hover color */
        border-color: #31304D; /* Specify your desired hover color */
    }

    /* Updated font and font size */
    .text-center,
    .text-muted {
        font-family: Arial, sans-serif;
        font-size: ypx;

    }

    .list-group-item strong {
        font-family: Arial, sans-serif;
        font-size: 25px;
    }

    .list-group-item p {
        font-family: Arial, sans-serif;
        font-size: 20px;
    }

    .list-group {
        background-color: transparent;
        border: none; /* Remove any border */
    }

    .list-group-item {
        background-color: transparent;
        border: none; /* Remove any border */
        margin-bottom: -16px; /* Adjust the bottom margin as needed */
    }

    .list-group-item strong {
        font-family: Arial, sans-serif;
        font-size: 25px;
    }

    .list-group-item p {
        font-family: Arial, sans-serif;
        font-size: 20px;
    }

</style>


  </section>
</section>




    
        <style>
           #education {
            padding: 40px 0; /* Adjust padding as needed */
            background-color: #FF4061; /* Background color for education section */
           
    background-size: cover; /* Cover the entire element with the background image */
     
    /* Other options:
       background-position: top right;
       background-position: bottom left;
       background-position: bottom right;
    */
        }

        #education h2 {
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
        }

        #education .card {
            background-color: #FEECDE;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;

        }

        #education .card h3 {
            margin: 0 0 10px 0;
        }

        #education .card p {
            margin: 0;
        }


        </style>
        <div id="education">
        <div class="container">
            <h2>Education</h2>
            <?php
            $education = json_decode($row['education'], true); // Decoding JSON string into an associative array
            if (!empty($education)) {
                foreach ($education as $edu) {
                    if (isset($edu['degree']) && isset($edu['institution'])) {
                        echo '<div class="card">';
                        echo '<h3>' . htmlspecialchars($edu['degree']) . '</h3>';
                        echo '<p>' . htmlspecialchars($edu['institution']) . '</p>';
                        echo '</div>';
                    }
                }
            } else {
                echo "<p>No education history available.</p>";
            }
            ?>
        </div>
    </div>


<style> 
#skills {
              padding: 40px 0; /* Adjust padding as needed */
            background-color: transparent; /* Background color for education section */
           
    background-size: cover; /* Cover the entire element with the background image */
     
    /* Other options:
       background-position: top right;
       background-position: bottom left;
       background-position: bottom right;
    */

}

#bg-videos {
    position: absolute;
    top: ;
    left: 0;
    width: 100%;
    height: 119%;
    object-fit: cover; /* Ensure the video covers the entire element */
    z-index: -1; /* Ensure the video stays behind the content */
    background-position: bottom right; /* Align video to the bottom-right */
}

#skills h2 {
    margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
    text-align: center;
}



.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Responsive grid */
    gap: 20px; /* Space between grid items */
    justify-items: center;
}

.skill-card {
    background-color: #FF4061; /* Card background color */
    border: 1px solid #222831; /* Card border */
    border-radius: 10px; /* Card border radius */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Card shadow */
    transition: box-shadow 0.3s ease-in-out; /* Smooth transition for shadow */
    width: 150px; /* Fixed width for portrait orientation */
    padding: 20px; /* Padding inside card */
    text-align: center; /* Center align the card content */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
}

.skill-card:hover {
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
}

.skill-card .card-text {
    margin: 0;
    font-size: 16px;
    text-align: center; /* Center text horizontally */
}

.skill-card .remove-skill-btn {
    border: none;
    background: none;
    color: #EEEEEE; /* Button color */
    font-size: 20px;
    cursor: pointer;
    transition: color 0.2s ease-in-out; /* Smooth transition for color */
}

.skill-card .remove-skill-btn:hover {
    color: #EEEEEE; /* Change color on hover */
}
</style>

    <div id="skills">
    <video autoplay muted loop id="bg-videos">
        <source src="img/Green Minimalist Illustrated Landscape Desktop Wallpaper (6).mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h2>My Skills</h2>
        <div class="skills-grid">
            <?php
            // Assuming $row['skills'] contains the JSON string for skills
            $skills = json_decode($row['skills']);
            if (!empty($skills)) {
                foreach ($skills as $skill) {
                    echo '<div class="skill-card">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . htmlspecialchars($skill) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No skills available.</p>";
            }
            ?>
        </div>
    </div>
</div>



<style>
    #projects {
        padding: 100px 0; /* Adjust padding as needed */
         color: black; /* Text color */
        
        background-size: cover; /* Cover the entire element with the background image */
        

}

#projects h2 {
    margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
    text-align: center;
}

#bg-videoss {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the video covers the entire element */
    z-index: -1; /* Ensure the video stays behind the content */
    background-position: bottom right; /* Align video to the bottom-right */
}
    .project_card {
        margin-bottom: 20px; /* Adjust spacing between project cards */
    }
    .project_card img {
        max-width: 100%; /* Ensure images don't exceed container width */
        height: auto; /* Maintain aspect ratio */
    }
</style>
<div id="projects">
<video autoplay muted loop id="bg-videoss">
        <source src="img/Green Minimalist Illustrated Landscape Desktop Wallpaper (9).mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h2>Projects</h2>
        <div class="project-card">
           <?php
// Assuming $profile_picture contains the profile picture content retrieved from the database
if (!empty($profile_picture)) {
    // Convert profile picture content to base64 format
    $profile_picture_base64 = base64_encode($profile_picture);
    // Output the image using the base64-encoded content
    echo '<img src="data:image/jpeg;base64,' . $profile_picture_base64 . '" alt="Profile Picture">';
} else {
    // Display a placeholder image if no profile picture is available
    echo '<img src="" alt="">';
}
?>
        </div>
    </div>
</div>

        <style>
            #contact {
            padding: 40px 0; /* Adjust padding as needed */
            background-color: #FF4061; /* Background color for education section */
           
    background-size: cover; /* Cover the entire element with the background image */
     
    /* Other options:
       background-position: top right;
       background-position: bottom left;
       background-position: bottom right;
    */
        }

        #contact h2 {
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
            text-align: center;
        }
#contact {
    position: relative;
    padding: 40px 0; /* Adjust padding as needed */
    background-color: #F2EFE5; /* Fallback background color */
    /* Remove background image properties */
    background-size: cover; /* Cover the entire element with the background image */

}

.social {
  margin: 0;
  list-style: none;
  padding-left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  
}

.social .social-item {
  margin: 0 30px;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.social .social-item .social-link {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #fff;
  text-align: center;
  transform: perspective(1000px) rotate(-30deg) skew(25deg)
    translate(0, 0);
  transition: all 0.4s ease;
}

.social .social-item .social-link::before {
  content: "";
  position: absolute;
  top: 5px;
  left: -10px;
  height: 100%;
  width: 10px;
  background: #b1b1b1;
  transition: all 0.4s ease;
  transform: rotate(0deg) skewY(-45deg);
}

.social .social-item .social-link::after {
  content: "";
  position: absolute;
  top: 40px;
  left: -5px;
  height: 10px;
  width: 100%;
  background: #b1b1b1;
  transition: all 0.4s ease;
  transform: rotate(0deg) skewX(-45deg);
}

.social .social-item .social-link:hover {
  transform: perspective(1000px) rotate(-30deg) skew(25deg) translate(5px, -5px);
  box-shadow: -20px 20px 10px rgba(0, 0, 0, 0.5);
}

.social .social-item:nth-child(1) a {
  color: #3b5999;
}

.social .social-item:nth-child(1):hover a {
  background: #3b5999;
}

.social .social-item:nth-child(1):hover a::before {
  background: #3b5999;
}

.social .social-item:nth-child(1):hover a::after {
  background: #3b5999;
}

.social .social-item:nth-child(2) a {
  color: #55acee;
}

.social .social-item:nth-child(2):hover a {
  background: #55acee;
}

.social .social-item:nth-child(2):hover a::before {
  background: #55acee;
}

.social .social-item:nth-child(2):hover a::after {
  background: #55acee;
}

.social .social-item:nth-child(3) a {
  color: #dd4b39;
}

.social .social-item:nth-child(3):hover a {
  background: #dd4b39;
}

.social .social-item:nth-child(3):hover a::before {
  background: #dd4b39;
}

.social .social-item:nth-child(3):hover a::after {
  background: #dd4b39;
}

.social .social-item:nth-child(4) a {
  color: #e4405f;
}

.social .social-item:nth-child(4):hover a {
  background: #e4405f;
}

.social .social-item:nth-child(4):hover a::before {
  background: #e4405f;
}

.social .social-item:nth-child(4):hover a::after {
  background: #e4405f;
}

.social .social-item .social-link:hover {
  color: #ffffff;
}


        </style>
<div id="contact">
    <div class="form-container">
        <h2>Contacts</h2>
        <ul class="social">
                <li class="social-item">
                    <a id="facebookLinkAnchor" class="social-link" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.19795 21.5H13.198V13.4901H16.8021L17.198 9.50977H13.198V7.5C13.198 6.94772 13.6457 6.5 14.198 6.5H17.198V2.5H14.198C11.4365 2.5 9.19795 4.73858 9.19795 7.5V9.50977H7.19795L6.80206 13.4901H9.19795V21.5Z" fill="currentColor"></path>
                        </svg>
                    </a>
                </li>
                <li class="social-item">
                    <a id="linkedinLinkAnchor" class="social-link" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0zm-13.08 20.45H5.26V9h3.89v11.45zM7.47 7.58a2.24 2.24 0 1 1 0-4.47 2.24 2.24 0 0 1 0 4.47zM20.45 20.45h-3.89v-5.57c0-1.33-.03-3.05-1.86-3.05-1.86 0-2.14 1.45-2.14 2.95v5.67h-3.89V9h3.73v1.56h.05c.52-.99 1.8-2.04 3.71-2.04 3.96 0 4.69 2.61 4.69 6v6.93z" fill="currentColor"/>
                        </svg>
                    </a>
                </li>
                <li class="social-item">
                    <a id="googleLinkAnchor" class="social-link" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12C6 15.3137 8.68629 18 12 18C14.6124 18 16.8349 16.3304 17.6586 14H12V10H21.8047V14H21.8C20.8734 18.5645 16.8379 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C15.445 2 18.4831 3.742 20.2815 6.39318L17.0039 8.68815C15.9296 7.06812 14.0895 6 12 6C8.68629 6 6 8.68629 6 12Z" fill="currentColor"></path>
                        </svg>
                    </a>
                </li>
                <li class="social-item">
                    <a id="instagramLinkAnchor" class="social-link" href="#">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7ZM9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12Z" fill="currentColor"></path>
                        <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5 1C2.79086 1 1 2.79086 1 5V19C1 21.2091 2.79086 23 5 23H19C21.2091 23 23 21.2091 23 19V5C23 2.79086 21.2091 1 19 1H5ZM19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" fill="currentColor"></path>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>

        </div>
    </div>

<div class="cursor"></div>


    <script>
        document.addEventListener('mousemove', e => {
            const cursor = document.querySelector('.cursor');
            cursor.style.left = e.pageX + 'px';
            cursor.style.top = e.pageY + 'px';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQ=" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.navbar-brand').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('data-target')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        
    </script>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var fileInput = document.getElementById('profile_picture');

    fileInput.addEventListener('change', function(event) {
      var file = fileInput.files[0];
      var allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Add more allowed types if needed
      var fileType = file.type;

      if (!allowedTypes.includes(fileType)) {
        alert('Please select a valid image file (JPEG, PNG, GIF).');
        fileInput.value = ''; // Clear the file input
      }
    });
  });
</script>

<script>
    const menuIcon = document.querySelector('#menu-icon');
const navbar = document.querySelector('.navbar');
const navbg = document.querySelector('.nav-bg');
menuIcon.addEventListener('click', () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
    navbg.classList.toggle('active');
});
</script>
<script>
        // Custom smooth scrolling with JavaScript
        document.querySelectorAll('.navbar a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script>
function updateProfileLinks() {
    var facebookLink = document.getElementById("facebookLink").value;
    var linkedinLink = document.getElementById("linkedinLink").value;
    var googleLink = document.getElementById("googleLink").value;
    var instagramLink = document.getElementById("instagramLink").value;

    updateLink("facebookLinkAnchor", facebookLink);
    updateLink("linkedinLinkAnchor", linkedinLink);
    updateLink("googleLinkAnchor", googleLink);
    updateLink("instagramLinkAnchor", instagramLink);
}

function updateLink(anchorId, link) {
    var anchor = document.getElementById(anchorId);
    if (link) {
        anchor.href = link;
        anchor.target = "_blank"; // Open link in new tab
    } else {
        anchor.href = "#";
        anchor.removeAttribute("target");
    }
}
</script>


</body>
</html>
