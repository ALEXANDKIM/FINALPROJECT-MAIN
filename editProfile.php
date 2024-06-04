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
        <link rel="stylesheet" href="profile.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <style>
        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        #contact.dark-mode {
            background-color: #333333;
        }

        .checkbox-wrapper-51 input[type="checkbox"] {
            visibility: hidden;
            display: none;
        }

        .checkbox-wrapper-51 .toggle {
            position: relative;
            display: block;
            width: 42px;
            height: 24px;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            transform: translate3d(0, 0, 0);
        }

        .checkbox-wrapper-51 .toggle:before {
            content: "";
            position: relative;
            top: 1px;
            left: 1px;
            width: 40px;
            height: 22px;
            display: block;
            background: #c8ccd4;
            border-radius: 12px;
            transition: background 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            display: block;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(154,153,153,0.75);
            transition: all 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span svg {
            margin: 7px;
            fill: none;
        }

        .checkbox-wrapper-51 .toggle span svg path {
            stroke: #c8ccd4;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 24;
            stroke-dashoffset: 0;
            transition: all 0.5s linear;
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle:before {
            background: #1175c7;
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle span {
            transform: translateX(18px);
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle span path {
            stroke: #000000;
            stroke-dasharray: 25;
            stroke-dashoffset: 25;
        }

        .navbar .dark-mode-toggle {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .navbar {
            padding: 0.5rem 0.75rem;
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1rem;
            font-weight: 500;
            padding: 0 0.5rem;
            color: #185ee0;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #0045b3;
            text-decoration: none;
        }

        .navbar-expand-lg .navbar-nav {
            flex-direction: row;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding: 0 0.5rem;
        }

        .dark-mode-toggle {
            margin-left: auto;
        }

        .tabs * {
            z-index: 2;
        }

        .container input[type="radio"] {
            display: none;
        }

        .notification {
            display: flex;
            align-items: center;
            justify-content: center;
            width: .8rem;
            height: .8rem;
            position: absolute;
            top: 10px;
            left: 30%;
            font-size: 10px;
            margin-left: 0.75rem;
            border-radius: 50%;
            margin: 0px;
            background-color: #e6eef9;
            transition: 0.15s ease-in;
        }

        .container input[type="radio"]:checked + label {
            color: #185ee0;
        }

        .container input[type="radio"]:checked + label > .notification {
            background-color: #185ee0;
            color: #fff;
            margin: 0px;
        }

        .container input[id="radio-1"]:checked ~ .glider {
            transform: translateX(0);
        }

        .container input[id="radio-2"]:checked ~.glider {
            transform: translateX(100%);
        }

        .container input[id="radio-3"]:checked ~ .glider {
            transform: translateX(200%);
        }

        .container input[id="radio-4"]:checked ~ .glider {
            transform: translateX(300%);
        }

        .container input[id="radio-5"]:checked ~ .glider {
            transform: translateX(400%);
        }

        @media (max-width: 700px) {
            .tabs {
                transform: scale(0.6);
            }
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .image-container img {
            max-width: 200px;
            border-radius: 50%;
        }

        .information-container {
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .information-container label {
            font-weight: bold;
        }

        .information-container input,
        .information-container textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .section-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            margin-top: 2rem;
        }

        .education-input,
        .skill-input,
        .project-input {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .education-input .educ-item,
        .skill-input .skill-item,
        .project-input .project_card {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .project_card img {
            max-width: 100px;
            border-radius: 8px;
        }

        .submitBtn {
            background-color: #185ee0;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submitBtn:hover {
            background-color: #0045b3;
        }
    </style>
    </head>
    <body>
        

        <form action="submitProfile.php?id=132" method="post" enctype="multipart/form-data">
    <div class="container-fluid p-0">   
        <div class="form-container">`
            <div class="image-container">  
                <img src="<?php echo $row['image'] ?>" id="image-preview">
            </div>
            <input type="file" id="image-input" name="image" accept="image/*">  
                <div class="information-container">
                    <label for="full_name">Full name</label>
                    <input type="text" name="name" id="full_name" value="<?php echo $row['full_name'] ?>" required>
                    <label for="profession">Profession</label>
                    <input type="text" name="profession" id="profession" value="<?php echo $row['profession'] ?>" required>
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" required><?php echo $row['bio'] ?></textarea >

                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>" required>
                    <label for="phone_number" >Phone number</label>
                    <input type="text" name="phoneNumber" id="phone_number" value="<?php echo $row['phone_number'] ?>" required>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" required>  
                    
                    <div class="divider"></div>

                    <span>Education</span>
    <button type="button" id="educ-btn">+</button>
    <div class="education-input">
        <?php
            $education = json_decode($row['education'], true); // Decoding JSON string into an associative array
            if (is_array($education)) {
                foreach ($education as $edu) {
                    echo '<div class="educ-item">';
                    echo '<input type="text" name="degree[]" placeholder="Degree" value="' . (isset($edu['degree']) ? htmlspecialchars($edu['degree']) : '') . '">';
                    echo '<input type="text" name="institution[]" placeholder="Institution" value="' . (isset($edu['institution']) ? htmlspecialchars($edu['institution']) : '') . '">';
                    echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn">x</button>';
                    echo '</div>';
                }
            } else {
                echo '<div class="educ-item">';
                echo '<input type="text" name="degree[]" placeholder="Degree">';
                echo '<input type="text" name="institution[]" placeholder="Institution">';
                echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn">x</button>';
                echo '</div>';
            }
        ?>
    </div>
    
    <script>
        document.getElementById('educ-btn').addEventListener('click', function() {
            var container = document.querySelector('.education-input');
            var newItem = document.createElement('div');
            newItem.classList.add('educ-item');
            newItem.innerHTML = `
                <input type="text" name="degree[]" placeholder="Degree">
                <input type="text" name="institution[]" placeholder="Institution">
                <button type="button" class="remove-skill-btn" onclick="removeInput(this)">x</button>
            `;
            container.appendChild(newItem);
        });

        function removeInput(button) {
            var item = button.parentElement;
            item.parentElement.removeChild(item);
        }
    </script>


    <div class="section-label">
    <span>Skills</span>
    <button type="button" id="skill-btn">+</button>
</div>
<div class="skill-input">
    <?php
        $skills = json_decode($row['skills']);
        if (!empty($skills)) {
            foreach ($skills as $skill) {
                echo '<div class="skill-item">';
                echo '<input type="text" name="skill[]" placeholder="Skill" value="' . htmlspecialchars($skill) . '">';
                echo '<button type="button" class="remove-skill-btn">x</button>';
                echo '</div>';
            }
        } else {
            echo '<div class="skill-item">';
            echo '<input type="text" name="skill[]" placeholder="Skill">';
            echo '<button type="button" class="remove-skill-btn">x</button>';
            echo '</div>';
        }
    ?>
</div>

<script>
    document.getElementById('skill-btn').addEventListener('click', function() {
        addSkillInput('');
    });

    document.querySelectorAll('.remove-skill-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            removeInput(button);
        });
    });

    function addSkillInput(skillValue) {
        var container = document.querySelector('.skill-input');
        var newItem = document.createElement('div');
        newItem.classList.add('skill-item');
        newItem.innerHTML = `
            <input type="text" name="skill[]" placeholder="Skill" value="${skillValue}">
            <button type="button" class="remove-skill-btn">x</button>
        `;
        container.appendChild(newItem);

        // Attach event listener for the new remove button
        newItem.querySelector('.remove-skill-btn').addEventListener('click', function() {
            removeInput(newItem.querySelector('.remove-skill-btn'));
        });
    }

    function removeInput(button) {
        var item = button.parentElement;
        item.parentElement.removeChild(item);
    }
</script>




                </div>
                <div class="divider"></div>
<div class="section-label">
    <span>Project</span>
    <button type="button" id="project-btn">+</button>
</div>
<div class="project-input">
    <!-- Project items will be dynamically added here -->
</div>

<script>
    // Counter for unique IDs
    var projectCounter = 0;

    // Function to add a new project item
    function addProjectItem() {
        var container = document.querySelector('.project-input');
        var newItem = document.createElement('div');
        newItem.classList.add('project_card');
        newItem.innerHTML = `
            <input type="file" id="project_image_${projectCounter}" name="projectimage[]" accept="image/*">
            <textarea name="projectDescription[]" placeholder="Project description"></textarea>
            <button type="button" class="remove-project-btn" onclick="removeProjectItem(this)">Remove</button>
        `;
        container.appendChild(newItem);
        projectCounter++;
    }

    // Function to remove a project item
    function removeProjectItem(button) {
        var item = button.parentElement;
        item.parentElement.removeChild(item);
    }

    // Event listener for adding a new project item
    document.getElementById('project-btn').addEventListener('click', function() {
        addProjectItem();
    });
</script>

<form id="linkForm">
                <label for="facebookLink">Facebook:</label>
                <input type="url" id="facebookLink" name="facebookLink" placeholder="https://facebook.com/yourprofile">
                <br>
                <label for="linkedinLink">LinkedIn:</label>
                <input type="url" id="linkedinLink" name="linkedinLink" placeholder="https://linkedin.com/in/yourprofile">
                <br>
                <label for="googleLink">Google:</label>
                <input type="url" id="googleLink" name="googleLink" placeholder="https://plus.google.com/yourprofile">
                <br>
                <label for="instagramLink">Instagram:</label>
                <input type="url" id="instagramLink" name="instagramLink" placeholder="https://instagram.com/yourprofile">
                <br>
            </form>
            <script src="script.js"></script>
         

                
                
                <button type="submit" style="margin:auto" class="submitBtn">Submit</button>
             
            </div>
        </div>
    </form>

        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQ=" crossorigin="anonymous"></script>
        <script>

    function removeInput(button) {  
            var inputItem = button.parentNode;
            inputItem.parentNode.removeChild(inputItem);
        }


        
            document.querySelectorAll('.navbar-brand').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('data-target')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Dark mode toggle
            const darkModeToggle = document.getElementById('cbx-51');

                document.body.classList.toggle('dark-mode');
                // document.getElementById('contact').classList.toggle('dark-mode');
                
                // Smooth transition for navbar background color
                const navbar = document.querySelector('.navbar');
                navbar.style.transition = 'background-color 0.5s ease';
                navbar.style.backgroundColor = document.body.classList.contains('dark-mode') ? '#343a40' : '#f8f9fa';
            darkModeToggle.addEventListener('change', function() {
                document.body.classList.toggle('dark-mode');
                document.getElementById('contact').classList.toggle('dark-mode');
                
                // Smooth transition for navbar background color
                const navbar = document.querySelector('.navbar');
                navbar.style.transition = 'background-color 0.5s ease';
                navbar.style.backgroundColor = document.body.classList.contains('dark-mode') ? '#343a40' : '#f8f9fa';
            });


            const educBtn = document.getElementById('educ-btn');
            const skillBtn = document.getElementById('skill-btn');;
            const projectBtn = document.getElementById('project-btn');;

            

            educBtn.addEventListener('click', function() {
                const educationInput = document.querySelector('.education-input');
                const educItem = document.createElement('div');
                educItem.classList.add('educ-item');

                const newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('name', 'education[]');

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'x';
                removeBtn.setAttribute('type', 'button');
                removeBtn.classList.add('remove-skill-btn');
                removeBtn.addEventListener('click', function() {
                    removeInput(this);
                });

                educItem.appendChild(newInput);
                educItem.appendChild(removeBtn);
                educationInput.appendChild(educItem);
            });

            skillBtn.addEventListener('click', function() {
                const skillInput = document.querySelector('.skill-input');
                const newSkillItem = document.createElement('div');
                newSkillItem.classList.add('skill-item');

                const newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('name', 'skill[]');

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'x';
                removeBtn.setAttribute('type', 'button');
                removeBtn.classList.add('remove-skill-btn');
                removeBtn.addEventListener('click', function() {
                    removeInput(this);
                });

                newSkillItem.appendChild(newInput);
                newSkillItem.appendChild(removeBtn);
                skillInput.appendChild(newSkillItem);
            });

            projectBtn.addEventListener('click', function() {
                const skillInput = document.querySelector('.project-input');
                const newInput = document.createElement('input');
                const newInput2 = document.createElement('textarea');
                newInput.setAttribute('type', 'file');
                newInput.setAttribute('name', 'projectDescription[]');
                newInput2.setAttribute('type', 'text');
                newInput2.setAttribute('accept', 'image/*');
                newInput2.setAttribute('placeholder', 'Project Description');
                newInput2.setAttribute('name', 'projectimage[]');
                skillInput.appendChild(newInput);
                skillInput.appendChild(newInput2);
            });



            document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                }
            });
        });

        </script>
    </body>
    </html>


