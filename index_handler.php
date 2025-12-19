<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid("photo_", true) . "." . $imageFileType;
    $targetFile = $targetDir . $newFileName;

    
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) die("Error: File is not an image.");

    $allowedTypes = ["jpg","jpeg","png","gif"];
    if (!in_array($imageFileType, $allowedTypes)) die("Error: Only JPG, JPEG, PNG & GIF allowed.");

    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        die("Error: Image upload failed.");
    }

    if (empty(trim($_POST['name']))) die("Error: Name is required.");

    if (strtotime($_POST['dob']) > time()) die("Error: Date of Birth cannot be in the future.");


    if (!str_contains($_POST['email'], "@")) die("Error: Invalid email.");

   
    if (!empty($_POST['telephone']) && strlen($_POST['telephone']) != 11) die("Error: Telephone must be 11 digits.");
    if (strlen($_POST['cellphone']) != 11) die("Error: Cellphone must be 11 digits.");

    
    $uploadedImage = $targetFile;
?>
<!DOCTYPE html>
<html>
<head>
    <title>BIO-DATA Result</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { width: 900px; margin: auto; border: 1px solid black; padding: 20px; position: relative; }
        h2 { text-align: center; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
        .section { background: black; color: white; font-weight: bold; padding: 5px; margin-top: 15px; }
        .photo { position: absolute; top: 20px; right: 20px; width: 150px; height: 150px; border: 1px solid #000; object-fit: cover; }
    </style>
</head>
<body>
<div class="container">
    <h2>BIO-DATA</h2>
    <img src="<?= $uploadedImage ?>" alt="Uploaded Photo" class="photo">
    
    <div class="section">PERSONAL DATA</div>
    <table>
        <tr>
            <td>Position Desired: <?= $_POST['position'] ?></td>
            <td>Date: <?= $_POST['date'] ?></td>
        </tr>
        <tr>
            <td>Name: <?= $_POST['name'] ?></td>
            <td>Gender: <?= $_POST['gender'] ?></td>
        </tr>
        <tr>
            <td>City Address: <?= $_POST['city_address'] ?></td>
            <td>Provincial Address: <?= $_POST['prov_address'] ?></td>
        </tr>
        <tr>
            <td>Telephone: <?= $_POST['telephone'] ?></td>
            <td>Cellphone: <?= $_POST['cellphone'] ?></td>
        </tr>
        <tr>
            <td>Email: <?= $_POST['email'] ?></td>
            <td>Date of Birth: <?= $_POST['dob'] ?></td>
        </tr>
        <tr>
            <td>Birthplace: <?= $_POST['birthplace'] ?></td>
            <td>Citizenship: <?= $_POST['citizenship'] ?></td>
        </tr>
        <tr>
            <td>Height: <?= $_POST['height'] ?></td>
            <td>Weight: <?= $_POST['weight'] ?></td>
        </tr>
        <tr>
            <td>Religion: <?= $_POST['religion'] ?></td>
            <td>Civil Status: <?= $_POST['civil_status'] ?></td>
        </tr>
        <tr>
            <td>Spouse: <?= $_POST['spouse'] ?></td>
            <td>Date of Birth: <?= $_POST['spouse_dob'] ?></td>
        </tr>
        <tr>
            <td colspan="2">Name of Children: <?= nl2br($_POST['children']) ?></td>
        </tr>
        <tr>
            <td>Father’s Name: <?= $_POST['father'] ?></td>
            <td>Occupation: <?= $_POST['father_occ'] ?></td>
        </tr>
        <tr>
            <td>Mother’s Name: <?= $_POST['mother'] ?></td>
            <td>Occupation: <?= $_POST['mother_occ'] ?></td>
        </tr>
        <tr>
            <td colspan="2">Language/Dialect Spoken: <?= $_POST['language'] ?></td>
        </tr>
        <tr>
            <td colspan="2">Person to contact in case of emergency: <?= $_POST['emergency'] ?></td>
        </tr>
    </table>


    <div class="section">EDUCATIONAL BACKGROUND</div>
    <table>
        <tr>
            <td>Elementary: <?= $_POST['elem'] ?></td>
            <td>Year Graduated: <?= $_POST['elem_year'] ?></td>
        </tr>
        <tr>
            <td>High School: <?= $_POST['hs'] ?></td>
            <td>Year Graduated: <?= $_POST['hs_year'] ?></td>
        </tr>
        <tr>
            <td>College: <?= $_POST['college'] ?></td>
            <td>Year Graduated: <?= $_POST['college_year'] ?></td>
        </tr>
        <tr>
            <td>Degree Received: <?= $_POST['degree'] ?></td>
            <td>Special Skills: <?= $_POST['skills'] ?></td>
        </tr>
    </table>

   
    <div class="section">EMPLOYMENT RECORD</div>
    <table>
        <tr>
            <td>Company Name: <?= $_POST['company1'] ?></td>
            <td>Position: <?= $_POST['position1'] ?></td>
            <td>From: <?= $_POST['from1'] ?></td>
            <td>To: <?= $_POST['to1'] ?></td>
        </tr>
        <tr>
            <td>Company Name: <?= $_POST['company2'] ?></td>
            <td>Position: <?= $_POST['position2'] ?></td>
            <td>From: <?= $_POST['from2'] ?></td>
            <td>To: <?= $_POST['to2'] ?></td>
        </tr>
    </table>

    
    <div class="section">CHARACTER REFERENCE</div>
    <table>
        <tr>
            <td>Name: <?= $_POST['ref1_name'] ?></td>
            <td>Position: <?= $_POST['ref1_pos'] ?></td>
            <td>Company: <?= $_POST['ref1_comp'] ?></td>
            <td>Contact No: <?= $_POST['ref1_contact'] ?></td>
        </tr>
        <tr>
            <td>Name: <?= $_POST['ref2_name'] ?></td>
            <td>Position: <?= $_POST['ref2_pos'] ?></td>
            <td>Company: <?= $_POST['ref2_comp'] ?></td>
            <td>Contact No: <?= $_POST['ref2_contact'] ?></td>
        </tr>
    </table>
</div>
</body>
</html>
<?php
}
?>
