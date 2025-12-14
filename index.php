<!DOCTYPE html>
<html>
<head>
    <title>Bio-Data Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 900px;
            margin: auto;
            border: 1px solid black;
            padding: 20px;
        }
        h2 {
            text-align: center;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
            vertical-align: top;
        }
        .section {
            background: black;
            color: white;
            font-weight: bold;
            padding: 5px;
            margin-top: 15px;
        }
        input, textarea {
            width: 95%;
            padding: 5px;
        }
        .btn {
            margin-top: 20px;
            display: block;
            padding: 10px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
            width: 200px;
        }
        .btn:hover {
            background: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>BIO-DATA</h2>
    <form action="index_handler.php" method="POST" enctype="multipart/form-data">

        <tr>
            <td colspan="2">
                Upload Photo: <input type="file" name="photo" accept="image/*" required>
            </td>
        </tr>

        <div class="section">PERSONAL DATA</div>
        <table border="0">
            <tr>
                <td>Position Desired: <input type="text" name="position" required></td>
                <td>Date: <input type="date" name="date" required></td>
            </tr>
            <tr>
                <td>Name: <input type="text" placeholder="Ex. Dela Cruz, Juan G." name="name" required></td>
                <td>Gender: 
                    <select name="gender" required>
                        <option value="">--Select--</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>City Address: <input type="text" name="city_address" required></td>
                <td>Provincial Address: <input type="text" name="prov_address"></td>
            </tr>
            <tr>
                <td>Telephone: <input type="text" name="telephone"></td>
                <td>Cellphone: <input type="text" name="cellphone" required></td>
            </tr>
            <tr>
                <td>Email: <input type="email" name="email" required></td>
                <td>Date of Birth: <input type="date" name="dob" required max="<?= date('Y-m-d') ?>"></td>

            </tr>
            <tr>
                <td>Birthplace: <input type="text" name="birthplace" required></td>
                <td>Citizenship: <input type="text" name="citizenship" required></td>
            </tr>
            <tr>
                <td>Height: <input type="text" name="height"></td>
                <td>Weight: <input type="text" name="weight"></td>
            </tr>
            <tr>
                <td>Religion: <input type="text" name="religion"></td>
                <td>Civil Status: <input type="text" name="civil_status"></td>
            </tr>
            <tr>
                <td>Spouse: <input type="text" name="spouse"></td>
                <td>Date of Birth: <input type="date" name="spouse_dob" max="<?= date('Y-m-d') ?>"></td>

            </tr>
            <tr>
                <td colspan="2">Name of Children: <textarea name="children"></textarea></td>
            </tr>
            <tr>
                <td>Father’s Name: <input type="text" placeholder="Ex. Dela Cruz, Juan G." name="father"></td>
                <td>Occupation: <input type="text" name="father_occ"></td>
            </tr>
            <tr>
                <td>Mother’s Name: <input type="text" placeholder="Ex. Dela Cruz, Juan G." name="mother"></td>
                <td>Occupation: <input type="text" name="mother_occ"></td>
            </tr>
            <tr>
                <td colspan="2">Language/Dialect Spoken: <input type="text" name="language"></td>
            </tr>
            <tr>
                <td colspan="2">Person to contact in case of emergency: <input type="text" name="emergency"></td>
            </tr>
        </table>

        <div class="section">EDUCATIONAL BACKGROUND</div>
        <table border="0">
            <tr>
                <td>Elementary: <input type="text" name="elem"></td>
                <td>Year Graduated: <input type="text" name="elem_year"></td>
            </tr>
            <tr>
                <td>High School: <input type="text" name="hs"></td>
                <td>Year Graduated: <input type="text" name="hs_year"></td>
            </tr>
            <tr>
                <td>College: <input type="text" name="college"></td>
                <td>Year Graduated: <input type="text" name="college_year"></td>
            </tr>
            <tr>
                <td>Degree Received: <input type="text" name="degree"></td>
                <td>Special Skills: <input type="text" name="skills"></td>
            </tr>
        </table>

        <div class="section">EMPLOYMENT RECORD</div>
        <table border="0">
            <tr>
                <td>Company Name: <input type="text" name="company1"></td>
                <td>Position: <input type="text" name="position1"></td>
                <td>From: <input type="text" name="from1"></td>
                <td>To: <input type="text" name="to1"></td>
            </tr>
            <tr>
                <td>Company Name: <input type="text" name="company2"></td>
                <td>Position: <input type="text" name="position2"></td>
                <td>From: <input type="text" name="from2"></td>
                <td>To: <input type="text" name="to2"></td>
            </tr>
        </table>

        <div class="section">CHARACTER REFERENCE</div>
        <table border="0">
            <tr>
                <td>Name: <input type="text" name="ref1_name"></td>
                <td>Position: <input type="text" name="ref1_pos"></td>
                <td>Company: <input type="text" name="ref1_comp"></td>
                <td>Contact No: <input type="text" name="ref1_contact"></td>
            </tr>
            <tr>
                <td>Name: <input type="text" name="ref2_name"></td>
                <td>Position: <input type="text" name="ref2_pos"></td>
                <td>Company: <input type="text" name="ref2_comp"></td>
                <td>Contact No: <input type="text" name="ref2_contact"></td>
            </tr>
        </table>

        <button type="submit" class="btn">Submit</button>
    </form>
</div>
</body>
</html>
