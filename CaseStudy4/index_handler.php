<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

   
    if (empty($_POST['name'])) {
        $errors[] = "Name is required.";
    }

   
    if (empty($_POST['email']) || strpos($_POST['email'], '@') === false) {
        $errors[] = "Email must contain '@'.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    
    if (!empty($_POST['cellphone']) && !preg_match('/^[0-9]{11}$/', $_POST['cellphone'])) {
        $errors[] = "Cellphone must be exactly 11 digits.";
    }

    
    if (!empty($_POST['dob'])) {
        $dob = strtotime($_POST['dob']);
        $today = strtotime(date("Y-m-d"));
        if ($dob > $today) {
            $errors[] = "Date of birth cannot be in the future.";
        }
    }

    $validCivilStatus = ["Single", "Married", "Widowed", "Separated"];
if (empty($_POST['civil_status']) || !in_array($_POST['civil_status'], $validCivilStatus)) {
    $errors[] = "Please select a valid civil status.";
}

    
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;

    
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        $uploadOk = 0;
        $errors[] = "Uploaded file is not a valid image.";
    }

    
    if (file_exists($targetFile)) {
        $uploadOk = 0;
        $errors[] = "This image already exists. Please rename your file.";
    }

    
    if ($uploadOk == 1 && empty($errors)) {
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    }

    
    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bio-Data Result</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 20px; }
        .container { width: 900px; margin: auto; border: 1px solid black; padding: 20px; position: relative; }
        h2 { text-align: center; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
        .section { background: black; color: white; font-weight: bold; padding: 5px; margin-top: 15px; }
        .photo { position: absolute; top: 20px; right: 20px; border: 1px solid black; width: 120px; height: 120px; overflow: hidden; }
        .photo img { width: 120px; height: 120px; object-fit: cover; }
    </style>
</head>
<body>
<div class="container">
    <h2>BIO-DATA</h2>

    <?php if (isset($targetFile) && $uploadOk == 1): ?>
        <div class="photo">
            <img src="<?= htmlspecialchars($targetFile) ?>" alt="Uploaded Photo">
        </div>
    <?php endif; ?>

    
    <div class="section">PERSONAL DATA</div>
    <table border="0">
        <tr>
            <td>Position Desired: <?= htmlspecialchars($_POST['position']) ?></td>
            <td>Date: <?= htmlspecialchars($_POST['date']) ?></td>
        </tr>
        <tr>
            <td>Name: <?= htmlspecialchars($_POST['name']) ?></td>
            <td>Gender: <?= htmlspecialchars($_POST['gender']) ?></td>
        </tr>
        <tr>
            <td>City Address: <?= htmlspecialchars($_POST['city_address']) ?></td>
            <td>Provincial Address: <?= htmlspecialchars($_POST['prov_address']) ?></td>
        </tr>
        <tr>
            <td>Telephone: <?= htmlspecialchars($_POST['telephone']) ?></td>
            <td>Cellphone: <?= htmlspecialchars($_POST['cellphone']) ?></td>
        </tr>
        <tr>
            <td>Email: <?= htmlspecialchars($_POST['email']) ?></td>
            <td>Date of Birth: <?= htmlspecialchars($_POST['dob']) ?></td>
        </tr>
        <tr>
            <td>Birthplace: <?= htmlspecialchars($_POST['birthplace']) ?></td>
            <td>Citizenship: <?= htmlspecialchars($_POST['citizenship']) ?></td>
        </tr>
        <tr>
            <td>Height: <?= htmlspecialchars($_POST['height']) ?></td>
            <td>Weight: <?= htmlspecialchars($_POST['weight']) ?></td>
        </tr>
        <tr>
            <td>Religion: <?= htmlspecialchars($_POST['religion']) ?></td>
            <td>Civil Status: <?= htmlspecialchars($_POST['civil_status']) ?></td>
        </tr>
        <tr>
           <td>Civil Status: <?= htmlspecialchars($_POST['civil_status']) ?></td>

            <td>Date of Birth: <?= htmlspecialchars($_POST['spouse_dob']) ?></td>
        </tr>
        <tr>
            <td colspan="2">Name of Children: <?= nl2br(htmlspecialchars($_POST['children'])) ?></td>
        </tr>
        <tr>
            <td>Father’s Name: <?= htmlspecialchars($_POST['father']) ?></td>
            <td>Occupation: <?= htmlspecialchars($_POST['father_occ']) ?></td>
        </tr>
        <tr>
            <td>Mother’s Name: <?= htmlspecialchars($_POST['mother']) ?></td>
            <td>Occupation: <?= htmlspecialchars($_POST['mother_occ']) ?></td>
        </tr>
        <tr>
            <td colspan="2">Language/Dialect Spoken: <?= htmlspecialchars($_POST['language']) ?></td>
        </tr>
        <tr>
            <td colspan="2">Person to contact in case of emergency: <?= htmlspecialchars($_POST['emergency']) ?></td>
        </tr>
    </table>

    
    <div class="section">EDUCATIONAL BACKGROUND</div>
    <table border="0">
        <tr>
            <td>Elementary: <?= htmlspecialchars($_POST['elem']) ?></td>
            <td>Year Graduated: <?= htmlspecialchars($_POST['elem_year']) ?></td>
        </tr>
        <tr>
            <td>High School: <?= htmlspecialchars($_POST['hs']) ?></td>
            <td>Year Graduated: <?= htmlspecialchars($_POST['hs_year']) ?></td>
        </tr>
        <tr>
            <td>College: <?= htmlspecialchars($_POST['college']) ?></td>
            <td>Year Graduated: <?= htmlspecialchars($_POST['college_year']) ?></td>
        </tr>
        <tr>
            <td>Degree Received: <?= htmlspecialchars($_POST['degree']) ?></td>
            <td>Special Skills: <?= htmlspecialchars($_POST['skills']) ?></td>
        </tr>
    </table>

    
    <div class="section">EMPLOYMENT RECORD</div>
    <table border="0">
        <tr>
            <td>Company Name: <?= htmlspecialchars($_POST['company1']) ?></td>
            <td>Position: <?= htmlspecialchars($_POST['position1']) ?></td>
            <td>From: <?= htmlspecialchars($_POST['from1']) ?></td>
            <td>To: <?= htmlspecialchars($_POST['to1']) ?></td>
        </tr>
        <tr>
            <td>Company Name: <?= htmlspecialchars($_POST['company2']) ?></td>
            <td>Position: <?= htmlspecialchars($_POST['position2']) ?></td>
            <td>From: <?= htmlspecialchars($_POST['from2']) ?></td>
            <td>To: <?= htmlspecialchars($_POST['to2']) ?></td>
        </tr>
    </table>

    
    <div class="section">CHARACTER REFERENCE</div>
    <table border="0">
        <tr>
            <td>Name: <?= htmlspecialchars($_POST['ref1_name']) ?></td>
            <td>Position: <?= htmlspecialchars($_POST['ref1_pos']) ?></td>
            <td>Company: <?= htmlspecialchars($_POST['ref1_comp']) ?></td>
            <td>Contact No: <?= htmlspecialchars($_POST['ref1_contact']) ?></td>
        </tr>
        <tr>
            <td>Name: <?= htmlspecialchars($_POST['ref2_name']) ?></td>
            <td>Position: <?= htmlspecialchars($_POST['ref2_pos']) ?></td>
            <td>Company: <?= htmlspecialchars($_POST['ref2_comp']) ?></td>
            <td>Contact No: <?= htmlspecialchars($_POST['ref2_contact']) ?></td>
        </tr>
    </table>
</div>
</body>
</html>
