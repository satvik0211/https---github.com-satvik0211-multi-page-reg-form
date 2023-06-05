<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test1";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $fathersFirstName = $_POST['fathersfirstName'];
    $fathersLastName = $_POST['fatherslastName'];
    $mothersFirstName = $_POST['mothersfirstName'];
    $mothersLastName = $_POST['motherslastName'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $country = $_POST['country'];
    $homeTelephone = $_POST['homemob'];
    $personalMobile = $_POST['personalmob'];
    $hscInstitutionName = $_POST['HSCinsname'];
    $hscBoard = $_POST['HSCboard'];
    $hscPercentage = $_POST['HSCPercentage'];
    $sscInstitutionName = $_POST['SSCinsname'];
    $sscBoard = $_POST['SSCboard'];
    $sscPercentage = $_POST['SSCPercentage'];
    $currentInstitutionName = $_POST['currinsname'];
    $currentPursuing = $_POST['currentpursing'];
    $overallPercentage = $_POST['Overallpercentage'];
    $currentBacklog = $_POST['currentback'];
    $photo = $_FILES['photo']['name'];
    $hscMark = $_FILES['HSCmark']['name'];
    $sscMark = $_FILES['SSCmark']['name'];
    $semMark = $_FILES['semm']['name'];

    // Define file size limits
    $maxPhotoSize = 4 * 1024 * 1024; // 4MB
    $maxMarkSize = 10 * 1024 * 1024; // 10MB

    // Check file sizes
    $photoSize = $_FILES['photo']['size'];
    $hscMarkSize = $_FILES['HSCmark']['size'];
    $sscMarkSize = $_FILES['SSCmark']['size'];
    $semMarkSize = $_FILES['semm']['size'];

    if ($photoSize > $maxPhotoSize || $hscMarkSize > $maxMarkSize || $sscMarkSize > $maxMarkSize || $semMarkSize > $maxMarkSize) {
        echo("File size limit exceeded. Please make sure the photo file is up to 4MB and the other files are up to 10MB.
        please go back");
        exit;
    }

    // Move uploaded files to a directory
    $targetDir = "uploads/";
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetDir . $photo);
    move_uploaded_file($_FILES['HSCmark']['tmp_name'], $targetDir . $hscMark);
    move_uploaded_file($_FILES['SSCmark']['tmp_name'], $targetDir . $sscMark);
    move_uploaded_file($_FILES['semm']['tmp_name'], $targetDir . $semMark);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("insert into registration (
        first_name,
        last_name,
        dob,
        email,
        fathers_first_name,
        fathers_last_name,
        mothers_first_name,
        mothers_last_name,
        gender,
        nationality,
        address,
        district,
        country,
        home_telephone,
        personal_mobile,
        hsc_institution_name,
        hsc_board,
        hsc_percentage,
        ssc_institution_name,
        ssc_board,
        ssc_percentage,
        current_institution_name,
        current_pursuing,
        overall_percentage,
        current_backlog,
        photo,
        hsc_mark,
        ssc_mark,
        sem_mark
    ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssssssssssssssssssssss", $firstName, $lastName, $dob, $email, $fathersFirstName, $fathersLastName, $mothersFirstName, $mothersLastName, $gender, $nationality, $address, $district, $country, $homeTelephone, $personalMobile, $hscInstitutionName, $hscBoard, $hscPercentage, $sscInstitutionName, $sscBoard, $sscPercentage, $currentInstitutionName, $currentPursuing, $overallPercentage, $currentBacklog, $photo, $hscMark, $sscMark, $semMark);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
?>