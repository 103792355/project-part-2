<?php
$pageTitle = "Home - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
?>

<main class="main-content">
    <div class="container">
        <section class="hero-section">
            <h2>Welcome to Tech Job Portal</h2>
            <p class="hero-description">
                A platform connecting talented candidates with exciting career opportunities in the information 
                technology field. We are committed to providing professional and effective recruitment experiences.
            </p>
            <div class="cta-buttons">
                <a href="jobs.php" class="btn btn-primary">View Jobs</a>
                <a href="apply.php" class="btn btn-secondary">Apply Now</a>
            </div>
        </section>

        <section class="features-section">
            <h3>Why Choose Us?</h3>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">💼</div>
                    <h4>Diverse Job Opportunities</h4>
                    <p>Hundreds of positions from leading companies in the technology industry</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h4>Fast Process</h4>
                    <p>Easy application, quick feedback from employers</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h4>Professional Support</h4>
                    <p>Dedicated consulting team supporting you throughout the application process</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h4>Information Security</h4>
                    <p>Committed to protecting your personal information in the best way</p>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <h3>Our Achievements</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Candidates</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">200+</div>
                    <div class="stat-label">Companies</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Job Listings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Satisfaction</div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.inc'; ?>
