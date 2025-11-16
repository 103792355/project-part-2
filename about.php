<?php
$pageTitle = "About Us - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
?>

<main class="main-content">
    <div class="container">
        <section class="page-header">
            <h2>About Us</h2>
            <p>The development team behind Tech Job Portal</p>
        </section>

        <section class="about-section">
            <h3>Project Introduction</h3>
            <p>
                Tech Job Portal is an online recruitment platform developed to connect employers 
                with talented candidates in the information technology field. The project is built 
                using modern web technologies including PHP, MySQL, and contemporary web standards.
            </p>
            <p>
                This project is an extension of Part 1, integrating server-side data processing and 
                database management to create a complete and professional recruitment system.
            </p>
        </section>

        <section class="team-section">
            <h3>Team Members</h3>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">👨‍💻</div>
                    <h4>John Smith</h4>
                    <p class="member-id">Student ID: 123456789</p>
                    <p class="member-role">Team Leader & Backend Developer</p>
                    <div class="member-contributions">
                        <h5>Contributions:</h5>
                        <ul>
                            <li>Database structure design</li>
                            <li>Developed process_eoi.php with full validation</li>
                            <li>Built management system (manage.php)</li>
                            <li>Integrated database connection and settings</li>
                        </ul>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-avatar">👩‍💻</div>
                    <h4>Emily Johnson</h4>
                    <p class="member-id">Student ID: 987654321</p>
                    <p class="member-role">Frontend Developer & UI/UX Designer</p>
                    <div class="member-contributions">
                        <h5>Contributions:</h5>
                        <ul>
                            <li>User interface design (UI/UX)</li>
                            <li>Developed CSS and responsive design</li>
                            <li>Created HTML/PHP pages (index, jobs, apply)</li>
                            <li>Optimized user experience</li>
                        </ul>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-avatar">👨‍💼</div>
                    <h4>Michael Brown</h4>
                    <p class="member-id">Student ID: 456789123</p>
                    <p class="member-role">Full Stack Developer</p>
                    <div class="member-contributions">
                        <h5>Contributions:</h5>
                        <ul>
                            <li>Developed dynamic features for jobs.php</li>
                            <li>Built form validation (client and server-side)</li>
                            <li>Created enhancement features</li>
                            <li>Testing and bug fixing</li>
                        </ul>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-avatar">👩‍🎓</div>
                    <h4>Sarah Davis</h4>
                    <p class="member-id">Student ID: 321654987</p>
                    <p class="member-role">Database Administrator & QA</p>
                    <div class="member-contributions">
                        <h5>Contributions:</h5>
                        <ul>
                            <li>Designed and optimized database schema</li>
                            <li>Wrote queries and stored procedures</li>
                            <li>Quality assurance and testing</li>
                            <li>Project documentation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="tech-stack">
            <h3>Technologies Used</h3>
            <div class="tech-grid">
                <div class="tech-item">
                    <span class="tech-icon">🌐</span>
                    <h4>Frontend</h4>
                    <p>HTML5, CSS3, JavaScript</p>
                </div>
                <div class="tech-item">
                    <span class="tech-icon">⚙️</span>
                    <h4>Backend</h4>
                    <p>PHP 7.4+</p>
                </div>
                <div class="tech-item">
                    <span class="tech-icon">🗄️</span>
                    <h4>Database</h4>
                    <p>MySQL 5.7+</p>
                </div>
                <div class="tech-item">
                    <span class="tech-icon">🔧</span>
                    <h4>Server</h4>
                    <p>Apache/Nginx</p>
                </div>
            </div>
        </section>

        <section class="contact-section">
            <h3>Contact</h3>
            <p>If you have any questions about the project, please contact us:</p>
            <ul class="contact-info">
                <li>📧 Email: <a href="mailto:team@techportal.com">team@techportal.com</a></li>
                <li>🌐 Website: <a href="https://techportal.com">techportal.com</a></li>
                <li>📱 Phone: +1 (555) 123-4567</li>
            </ul>
        </section>
    </div>
</main>

<?php include 'footer.inc'; ?>
