<?php
// Prevent direct access to this page
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: apply.php");
    exit();
}

$pageTitle = "Processing Application - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
require_once 'settings.php';

// Sanitization function
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validation variables
$errors = [];
$success = false;
$eoi_number = '';

// Sanitize all inputs
$job_reference = isset($_POST['job_reference']) ? sanitize_input($_POST['job_reference']) : '';
$first_name = isset($_POST['first_name']) ? sanitize_input($_POST['first_name']) : '';
$last_name = isset($_POST['last_name']) ? sanitize_input($_POST['last_name']) : '';
$dob = isset($_POST['dob']) ? sanitize_input($_POST['dob']) : '';
$gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
$street_address = isset($_POST['street_address']) ? sanitize_input($_POST['street_address']) : '';
$suburb = isset($_POST['suburb']) ? sanitize_input($_POST['suburb']) : '';
$state = isset($_POST['state']) ? sanitize_input($_POST['state']) : '';
$postcode = isset($_POST['postcode']) ? sanitize_input($_POST['postcode']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
$skills = isset($_POST['skills']) ? $_POST['skills'] : [];
$other_skills = isset($_POST['other_skills']) ? sanitize_input($_POST['other_skills']) : '';

// Server-side Validation

// Job Reference validation
if (empty($job_reference)) {
    $errors[] = "Job reference number cannot be empty.";
} elseif (!preg_match('/^[A-Z0-9]{5}$/', $job_reference)) {
    $errors[] = "Job reference must be exactly 5 alphanumeric characters.";
}

// First name validation
if (empty($first_name)) {
    $errors[] = "First name cannot be empty.";
} elseif (strlen($first_name) > 20) {
    $errors[] = "First name cannot exceed 20 characters.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
    $errors[] = "First name can only contain letters.";
}

// Last name validation
if (empty($last_name)) {
    $errors[] = "Last name cannot be empty.";
} elseif (strlen($last_name) > 20) {
    $errors[] = "Last name cannot exceed 20 characters.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
    $errors[] = "Last name can only contain letters.";
}

// Date of birth validation
if (empty($dob)) {
    $errors[] = "Date of birth cannot be empty.";
} else {
    $dob_timestamp = strtotime($dob);
    $today = time();
    $age = floor(($today - $dob_timestamp) / (365.25 * 24 * 60 * 60));
    
    if ($age < 15 || $age > 80) {
        $errors[] = "Age must be between 15 and 80 years old.";
    }
}

// Gender validation
if (empty($gender)) {
    $errors[] = "Please select a gender.";
} elseif (!in_array($gender, ['Male', 'Female', 'Other'])) {
    $errors[] = "Invalid gender selection.";
}

// Street address validation
if (empty($street_address)) {
    $errors[] = "Street address cannot be empty.";
} elseif (strlen($street_address) > 40) {
    $errors[] = "Street address cannot exceed 40 characters.";
}

// Suburb validation
if (empty($suburb)) {
    $errors[] = "Suburb/Town cannot be empty.";
} elseif (strlen($suburb) > 40) {
    $errors[] = "Suburb/Town cannot exceed 40 characters.";
}

// State validation
$valid_states = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
if (empty($state)) {
    $errors[] = "Please select a state.";
} elseif (!in_array($state, $valid_states)) {
    $errors[] = "Invalid state selection.";
}

// Postcode validation - must match state
$state_postcodes = [
    'VIC' => ['3000', '3001', '3002', '3003', '3004'],
    'NSW' => ['2000', '2001', '2002', '2003', '2004'],
    'QLD' => ['4000', '4001', '4002', '4003', '4004'],
    'NT' => ['0800', '0801', '0802', '0803', '0804'],
    'WA' => ['6000', '6001', '6002', '6003', '6004'],
    'SA' => ['5000', '5001', '5002', '5003', '5004'],
    'TAS' => ['7000', '7001', '7002', '7003', '7004'],
    'ACT' => ['2600', '2601', '2602', '2603', '2604']
];

if (empty($postcode)) {
    $errors[] = "Postcode cannot be empty.";
} elseif (!preg_match('/^\d{4}$/', $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
} elseif (!empty($state) && isset($state_postcodes[$state]) && !in_array($postcode, $state_postcodes[$state])) {
    $errors[] = "Postcode does not match the selected state.";
}

// Email validation
if (empty($email)) {
    $errors[] = "Email address cannot be empty.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Phone validation
if (empty($phone)) {
    $errors[] = "Phone number cannot be empty.";
} elseif (!preg_match('/^\d{8,12}$/', $phone)) {
    $errors[] = "Phone number must be between 8 and 12 digits.";
}

// Skills validation (combine checkboxes and other skills)
$skills_array = [];
foreach ($skills as $skill) {
    $skills_array[] = sanitize_input($skill);
}
if (!empty($other_skills)) {
    $other_skills_array = array_map('trim', explode(',', $other_skills));
    $skills_array = array_merge($skills_array, $other_skills_array);
}
$skills_string = implode(', ', $skills_array);

// If no errors, proceed with database operations
if (empty($errors) && $conn) {
    // Create EOI table if it doesn't exist
    $create_table_query = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
        job_reference VARCHAR(10) NOT NULL,
        first_name VARCHAR(20) NOT NULL,
        last_name VARCHAR(20) NOT NULL,
        dob DATE NOT NULL,
        gender VARCHAR(10) NOT NULL,
        street_address VARCHAR(40) NOT NULL,
        suburb VARCHAR(40) NOT NULL,
        state VARCHAR(3) NOT NULL,
        postcode VARCHAR(4) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(12) NOT NULL,
        skills TEXT,
        status VARCHAR(20) DEFAULT 'New',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    mysqli_query($conn, $create_table_query);
    
    // Insert the EOI record
    $insert_query = "INSERT INTO eoi (job_reference, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";
    
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $job_reference, $first_name, $last_name, $dob, $gender, $street_address, $suburb, $state, $postcode, $email, $phone, $skills_string);
    
    if (mysqli_stmt_execute($stmt)) {
        $eoi_number = mysqli_insert_id($conn);
        $success = true;
    } else {
        $errors[] = "An error occurred while saving data. Please try again.";
    }
    
    mysqli_stmt_close($stmt);
}
?>

<main class="main-content">
    <div class="container">
        <?php if ($success): ?>
            <div class="success-message">
                <h2>✅ Application Submitted Successfully!</h2>
                <div class="eoi-details">
                    <p><strong>EOI Number:</strong> <span class="eoi-number"><?php echo $eoi_number; ?></span></p>
                    <p><strong>Job Reference:</strong> <?php echo htmlspecialchars($job_reference); ?></p>
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                </div>
                <p class="success-note">We will contact you as soon as possible. Please save your EOI number for reference.</p>
                <div class="action-buttons">
                    <a href="jobs.php" class="btn btn-primary">View More Jobs</a>
                    <a href="index.php" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                <h2>❌ Errors Occurred</h2>
                <p>Please check the following information:</p>
                <ul class="error-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="action-buttons">
                    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
                    <a href="apply.php" class="btn btn-secondary">Fill Form Again</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php 
if ($conn) { mysqli_close($conn); }
include 'footer.inc'; 
?>
