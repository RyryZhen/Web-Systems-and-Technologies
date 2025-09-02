<?php

$name        = "Ryan Fernandez";
$title       = "Web and Mobile Technologies Student";
$phone       = "09318464366";
$email       = "22ur0979@psu.edu.ph";
$linkedin    = "linkedin.com/in/ryanfernadez";
$gitlab      = "gitlab.com/iamryzen10@gmail.com";
$address     = "Oraan, Manaoag, Pangasinan, PH";
$dob         = "14 August 2003";
$gender      = "Male";
$nationality = " Filipino";
$photo       = "profile.png"; 


$highschool   = "Manaoag National High School";
$hs_years     = "2016 to 2022";
$hs_score     = "92%";
$hs_activities = [
    "Special Program in Mathematics Student",
    "Math Club",
    "Science Club (Robotics)",
    "2nd Year Supreme Student Council Member Representative"
];

$college        = "PSU Urdaneta Campus";
$college_years  = "2022 to Present";
$degree         = "BS Information Technology";
$specialization = "Web and Mobile Technologies";


$experience_title = "Bachelor of Science in Information Technology major in Web and Mobile Technologies";
$experience_years = "2022 – Present";
$experience_tasks = [
    "Developed responsive websites for school purposes.",
    "Created a rental website using HTML, CSS, JavaScript, and PHP as a Final Requirement in System Analysis and Design.",
    "Explored creative workflows combining design tools and digital artistry."
];


$skills = ["HTML", "CSS", "Java", "Figma", "Canva" , "Capcut"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $name; ?> - Resume</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }
        .container {
            display: flex;
            flex-direction: column; 
            min-height: 100vh;
            max-width: 80%;   
    margin: 0 auto;
        }

       
        .left {
            background: linear-gradient(#004080 , #a3a1ffff);
            color: white;
            padding: 40px 25px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .photo img {
            border-radius: 50%;
            width: 160px;
            height: 160px;
            object-fit: cover;
            border: 4px solid #fff;
            margin-bottom: 15px;
            background: #FFDA27
        }
        .name {
            font-size: 26px;
            margin: 10px 0 5px;
        }
        .title {
            font-size: 18px;
            margin-bottom: 20px;
            font-style: italic;
        }

        
        .info {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            gap: 12px;
            width: 70%;
            margin-top: 25px;
            text-align: left;
            font-size: 1.05rem;
            line-height: 1.6;
        }
        .info p {
            margin: 0;
            padding: 2px;
        }
        .info b {
            display: inline-block;
            width: 90px; 
        }
        .info p:last-child {
            grid-column: 1 / -1; 
            margin-top: 15px;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
        }

        
        .right {
            padding: 40px;
            background: #fff;
        }
        .bottom-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
            max-width: 800px;
            margin: 0 auto;
            text-align: justify;
        }

        
        .section {
            width: 100%;
            background: #fff;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        h2 {
            border-bottom: 2px solid #ddd;
            color: #004080;
            padding-bottom: 6px;
            margin-top: 0;
            font-size: 22px;
        }

        
        ul {
            margin: 8px 0 0 20px;
            padding: 0;
        }
        .section.experience p {
            font-size: 1.05rem;
            font-weight: 500;
            margin-bottom: 12px;
            color: #222;
        }
        .section.experience ul {
            list-style: none;
            margin: 0;
        }
        .section.experience ul li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 10px;
            line-height: 1.6;
            font-size: 0.98rem;
            text-align: justify;
        }
        .section.experience ul li::before {
            content: "✔";
            position: absolute;
            left: 0;
            color: #004080;
            font-weight: bold;
        }

        
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-top: 10px;
        }
        .skill-item {
            background: #004080;
            color: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="left">
        <div>
            <div class="photo">
                <?php if($photo != "NA") { ?>
                    <img src="<?php echo $photo; ?>" alt="Profile Photo">
                <?php } else { echo "<p>No Photo</p>"; } ?>
            </div>
            <h1 class="name"><?php echo $name; ?></h1>
            <p class="title"><?php echo $title; ?></p>
        </div>

        
        <div class="info">
            <p><b>Phone:</b> <?php echo $phone ?: "NA"; ?></p>
            <p><b>Email:</b> <?php echo $email ?: "NA"; ?></p>
            <p><b>LinkedIn:</b> <?php echo $linkedin ?: "NA"; ?></p>
            <p><b>GitLab:</b> <?php echo $gitlab ?: "NA"; ?></p>
            <p><b>Address:</b> <?php echo $address ?: "NA"; ?></p>
            <p><b>DOB:</b> <?php echo $dob ?: "NA"; ?></p>
            <p><b>Gender:</b> <?php echo $gender ?: "NA"; ?></p>
            <p><b>Nationality:</b> <?php echo $nationality ?: ", "; ?></p>
            <p ><br>
                A Bachelor of Science in Information Technology 3rd year student with a 
                strong dedication in software development, web technologies, and UI/UX design. 
                Currently diving deeper knowledge in HTML, CSS, JavaScript, PHP, and MySQL,
                 with minor experience in creating responsive and user-friendly web applications
                 for school purposes. 
                 Skilled in using design tools like Figma and Canva to craft visually appealing
                  interfaces. Eager to leverage technical skills and creativity to contribute to 
                  innovative projects in a dynamic work environment.
            </p>
        </div>
    </div>

    
    <div class="right">
        <div class="bottom-section">

        
            <div class="section">
                <h2>Education</h2>
                <p><b><?php echo $hs_years; ?></b> - <?php echo $highschool; ?> (<?php echo $hs_score; ?>)</p>
                <p>Activities:</p>
                <ul>
                    <?php foreach ($hs_activities as $activity) {
                        echo "<li>$activity</li>";
                    } ?>
                </ul>
                <p><b><?php echo $college_years; ?></b> - <?php echo $degree; ?>, <?php echo $college; ?></p>
                <p>Specialization: <?php echo $specialization; ?></p>
            </div>

            
            <div class="section experience">
                <h2>Experience</h2>
                <p><b><?php echo $experience_years; ?></b> - <?php echo $experience_title; ?></p>
                <ul>
                    <?php foreach ($experience_tasks as $task) {
                        echo "<li>$task</li>";
                    } ?>
                </ul>
            </div>

            
            <div class="section">
                <h2>Skills</h2>
                <div class="skills">
                    <?php foreach ($skills as $skill) { ?>
                        <div class="skill-item"><?php echo $skill; ?></div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
