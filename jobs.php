<?php
$pageTitle = "Job Listings - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
require_once 'settings.php';

// Create jobs table if it doesn't exist
$create_jobs_table = "CREATE TABLE IF NOT EXISTS jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference VARCHAR(10) NOT NULL UNIQUE,
    job_title VARCHAR(100) NOT NULL,
    company_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    salary_range VARCHAR(50),
    job_type VARCHAR(50),
    description TEXT NOT NULL,
    requirements TEXT NOT NULL,
    responsibilities TEXT NOT NULL,
    benefits TEXT,
    posted_date DATE NOT NULL,
    closing_date DATE,
    status VARCHAR(20) DEFAULT 'Active'
)";

if ($conn) {
    mysqli_query($conn, $create_jobs_table);
    
    // Insert sample jobs if table is empty
    $check_query = "SELECT COUNT(*) as count FROM jobs";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] == 0) {
        $sample_jobs = [
            [
                'WD001',
                'Senior Web Developer',
                'Group 8',
                'Hanoi, Vietnam',
                '$25,000 - $35,000 per year',
                'Full-time',
                'We are looking for an experienced Senior Web Developer to join our product development team.',
                'At least 3 years of experience with PHP, MySQL, JavaScript. Experience with Laravel, Vue.js is an advantage. Good teamwork skills required.',
                'Develop and maintain web applications. Work with the team to design and implement new features. Code review and mentor junior developers.',
                'Competitive salary, Full insurance, Annual travel, Dynamic working environment',
                date('Y-m-d'),
                date('Y-m-d', strtotime('+30 days'))
            ],
            [
                'FS002',
                'Full Stack Developer',
                'Group 8',
                'Ho Chi Minh City, Vietnam',
                '$20,000 - $30,000 per year',
                'Full-time',
                'Join us in developing web applications from front-end to back-end. Work in an Agile environment with modern technologies.',
                '2+ years of Full Stack experience. Proficient in React, Node.js, Express, MongoDB. Knowledge of RESTful API, Git, Docker.',
                'Design and develop RESTful APIs. Build responsive user interfaces. Optimize application performance. Participate in sprint planning and code reviews.',
                'Attractive salary and bonuses, Training and development, Flexible remote work, Regular team building',
                date('Y-m-d'),
                date('Y-m-d', strtotime('+45 days'))
            ],
            [
                'FE003',
                'Frontend Developer',
                'Group 8',
                'Da Nang, Vietnam',
                '$15,000 - $22,000 per year',
                'Full-time',
                'Frontend developer specialist for web and mobile application projects. Requires creative thinking and good design skills.',
                '1-2 years of experience with HTML5, CSS3, JavaScript. Knowledge of React or Vue.js. Understanding of UX/UI design principles.',
                'Convert designs into high-quality HTML/CSS code. Develop reusable components. Ensure responsive design and cross-browser compatibility.',
                'Creative environment, Training in new technologies, Flexible working hours, Career advancement opportunities',
                date('Y-m-d'),
                date('Y-m-d', strtotime('+60 days'))
            ]
        ];
        
        $insert_query = "INSERT INTO jobs (job_reference, job_title, company_name, location, salary_range, job_type, description, requirements, responsibilities, benefits, posted_date, closing_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        
        foreach ($sample_jobs as $job) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $job[0], $job[1], $job[2], $job[3], $job[4], $job[5], $job[6], $job[7], $job[8], $job[9], $job[10], $job[11]);
            mysqli_stmt_execute($stmt);
        }
    }
}
?>

<main class="main-content">
    <div class="container">
        <section class="page-header">
            <h2>Job Listings</h2>
            <p>Explore exciting career opportunities in the technology field</p>
        </section>

        <div class="jobs-container">
            <?php
            if ($conn) {
                $query = "SELECT * FROM jobs WHERE status = 'Active' ORDER BY posted_date DESC";
                $result = mysqli_query($conn, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($job = mysqli_fetch_assoc($result)) {
                        echo '<article class="job-card">';
                        echo '<div class="job-header">';
                        echo '<h3>' . htmlspecialchars($job['job_title']) . '</h3>';
                        echo '<span class="job-reference">Ref: ' . htmlspecialchars($job['job_reference']) . '</span>';
                        echo '</div>';
                        echo '<div class="job-meta">';
                        echo '<span class="company">🏢 ' . htmlspecialchars($job['company_name']) . '</span>';
                        echo '<span class="location">📍 ' . htmlspecialchars($job['location']) . '</span>';
                        echo '<span class="salary">💰 ' . htmlspecialchars($job['salary_range']) . '</span>';
                        echo '<span class="job-type">⏰ ' . htmlspecialchars($job['job_type']) . '</span>';
                        echo '</div>';
                        
                        echo '<div class="job-section">';
                        echo '<h4>Job Description</h4>';
                        echo '<p>' . nl2br(htmlspecialchars($job['description'])) . '</p>';
                        echo '</div>';
                        
                        echo '<div class="job-section">';
                        echo '<h4>Requirements</h4>';
                        echo '<p>' . nl2br(htmlspecialchars($job['requirements'])) . '</p>';
                        echo '</div>';
                        
                        echo '<div class="job-section">';
                        echo '<h4>Responsibilities</h4>';
                        echo '<p>' . nl2br(htmlspecialchars($job['responsibilities'])) . '</p>';
                        echo '</div>';
                        
                        if (!empty($job['benefits'])) {
                            echo '<div class="job-section">';
                            echo '<h4>Benefits</h4>';
                            echo '<p>' . nl2br(htmlspecialchars($job['benefits'])) . '</p>';
                            echo '</div>';
                        }
                        
                        echo '<div class="job-footer">';
                        echo '<span class="posted-date">Posted: ' . date('M d, Y', strtotime($job['posted_date'])) . '</span>';
                        if (!empty($job['closing_date'])) {
                            echo '<span class="closing-date">Deadline: ' . date('M d, Y', strtotime($job['closing_date'])) . '</span>';
                        }
                        echo '<a href="apply.php?job=' . htmlspecialchars($job['job_reference']) . '" class="btn btn-primary">Apply Now</a>';
                        echo '</div>';
                        echo '</article>';
                    }
                } else {
                    echo '<p class="no-jobs">No jobs are currently available.</p>';
                }
            } else {
                echo '<p class="error-message">Unable to connect to the database.</p>';
            }
            ?>
        </div>
    </div>
</main>

<?php 
if ($conn) { mysqli_close($conn); }
include 'footer.inc'; 
?>
