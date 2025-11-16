<?php
$pageTitle = "Apply - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
require_once 'settings.php';

// Get job reference from URL if provided
$job_ref = isset($_GET['job']) ? htmlspecialchars($_GET['job']) : '';

// Fetch job details if job reference is provided
$job_details = null;
if ($conn && !empty($job_ref)) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM jobs WHERE job_reference = ?");
    mysqli_stmt_bind_param($stmt, "s", $job_ref);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $job_details = mysqli_fetch_assoc($result);
}
?>

<main class="main-content">
    <div class="container">
        <section class="page-header">
            <h2>Application Form</h2>
            <?php if ($job_details): ?>
                <p>Applying for: <strong><?php echo htmlspecialchars($job_details['job_title']); ?></strong></p>
            <?php else: ?>
                <p>Fill in your information to apply for your desired position</p>
            <?php endif; ?>
        </section>

        <div class="form-container">
            <form action="process_eoi.php" method="post" novalidate="novalidate" class="application-form">
                
                <fieldset>
                    <legend>Job Information</legend>
                    
                    <div class="form-group">
                        <label for="job_reference">Job Reference Number <span class="required">*</span></label>
                        <input type="text" id="job_reference" name="job_reference" 
                               value="<?php echo $job_ref; ?>" 
                               placeholder="e.g., WD001" required>
                        <small>Enter the job reference number you want to apply for (5 characters)</small>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Personal Information</legend>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name <span class="required">*</span></label>
                            <input type="text" id="first_name" name="first_name" 
                                   placeholder="First Name" maxlength="20" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="required">*</span></label>
                            <input type="text" id="last_name" name="last_name" 
                                   placeholder="Last Name" maxlength="20" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth <span class="required">*</span></label>
                        <input type="date" id="dob" name="dob" required>
                        <small>You must be between 15 and 80 years old</small>
                    </div>

                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div class="radio-group">
                            <label><input type="radio" name="gender" value="Male" required> Male</label>
                            <label><input type="radio" name="gender" value="Female"> Female</label>
                            <label><input type="radio" name="gender" value="Other"> Other</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Contact Information</legend>
                    
                    <div class="form-group">
                        <label for="street_address">Street Address <span class="required">*</span></label>
                        <input type="text" id="street_address" name="street_address" 
                               placeholder="House number, street name" maxlength="40" required>
                    </div>

                    <div class="form-group">
                        <label for="suburb">Suburb/Town <span class="required">*</span></label>
                        <input type="text" id="suburb" name="suburb" 
                               placeholder="Suburb/Town/District" maxlength="40" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="state">State <span class="required">*</span></label>
                            <select id="state" name="state" required>
                                <option value="">-- Select State --</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="NT">NT</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="postcode">Postcode <span class="required">*</span></label>
                            <input type="text" id="postcode" name="postcode" 
                                   placeholder="Postcode" maxlength="4" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" 
                               placeholder="your.email@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" 
                               placeholder="0412345678" required>
                        <small>8-12 digits</small>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Skills</legend>
                    
                    <div class="form-group">
                        <label>Select your skills:</label>
                        <div class="checkbox-group">
                            <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label>
                            <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label>
                            <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label>
                            <label><input type="checkbox" name="skills[]" value="PHP"> PHP</label>
                            <label><input type="checkbox" name="skills[]" value="MySQL"> MySQL</label>
                            <label><input type="checkbox" name="skills[]" value="Python"> Python</label>
                            <label><input type="checkbox" name="skills[]" value="React"> React</label>
                            <label><input type="checkbox" name="skills[]" value="Vue.js"> Vue.js</label>
                            <label><input type="checkbox" name="skills[]" value="Node.js"> Node.js</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="other_skills">Other Skills</label>
                        <textarea id="other_skills" name="other_skills" rows="4" 
                                  placeholder="Describe your other skills..."></textarea>
                    </div>
                </fieldset>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                    <button type="reset" class="btn btn-secondary">Clear Form</button>
                </div>

            </form>
        </div>
    </div>
</main>

<?php 
if ($conn) { mysqli_close($conn); }
include 'footer.inc'; 
?>
