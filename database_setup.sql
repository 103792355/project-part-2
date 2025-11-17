-- ================================================
-- Tech Job Portal - Database Setup Script
-- ================================================
-- NOTE: The application will auto-create these tables
-- This file is provided for manual setup if needed
-- ================================================

-- Create database
CREATE DATABASE IF NOT EXISTS project2_db;
USE project2_db;

-- ================================================
-- Table: eoi (Expressions of Interest)
-- ================================================
CREATE TABLE IF NOT EXISTS eoi (
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_job_reference (job_reference),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ================================================
-- Table: jobs
-- ================================================
CREATE TABLE IF NOT EXISTS jobs (
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
    status VARCHAR(20) DEFAULT 'Active',
    INDEX idx_job_reference (job_reference),
    INDEX idx_status (status),
    INDEX idx_posted_date (posted_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ================================================
-- Sample Data: Jobs
-- ================================================
INSERT INTO jobs (job_reference, job_title, company_name, location, salary_range, job_type, description, requirements, responsibilities, benefits, posted_date, closing_date, status) VALUES
('WD001', 'Senior Web Developer', 'Group 8', 'Hanoi, Vietnam', '$25,000 - $35,000 per year', 'Full-time', 
'We are looking for an experienced Senior Web Developer to join our product development team.', 
'At least 3 years of experience with PHP, MySQL, JavaScript. Experience with Laravel, Vue.js is an advantage. Good teamwork skills required.',
 'Develop and maintain web applications. Work with the team to design and implement new features. Code review and mentor junior developers.', 
'Competitive salary, Full insurance, Annual travel, Dynamic working environment', 
CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'Active'),

('FS002', 'Full Stack Developer', 'Group 8', 'Ho Chi Minh City, Vietnam', '$20,000 - $30,000 per year', 'Full-time', 
'Join us in developing web applications from front-end to back-end. Work in an Agile environment with modern technologies.', 
'2+ years of Full Stack experience. Proficient in React, Node.js, Express, MongoDB. Knowledge of RESTful API, Git, Docker.', 
'Design and develop RESTful APIs. Build responsive user interfaces. Optimize application performance. Participate in sprint planning and code reviews.', 
'Attractive salary and bonuses, Training and development, Flexible remote work, Regular team building', 
CURDATE(), DATE_ADD(CURDATE(), INTERVAL 45 DAY), 'Active'),

('FE003', 'Frontend Developer', 'Group 8', 'Da Nang, Vietnam', '$15,000 - $22,000 per year', 'Full-time', 
'Frontend developer specialist for web and mobile application projects. Requires creative thinking and good design skills.', 
'1-2 years of experience with HTML5, CSS3, JavaScript. Knowledge of React or Vue.js. Understanding of UX/UI design principles.', 
'Convert designs into high-quality HTML/CSS code. Develop reusable components. Ensure responsive design and cross-browser compatibility.', 
'Creative environment, Training in new technologies, Flexible working hours, Career advancement opportunities', 
CURDATE(), DATE_ADD(CURDATE(), INTERVAL 60 DAY), 'Active');

-- ================================================
-- Sample Data: EOI (for testing)
-- ================================================
INSERT INTO eoi (job_reference, first_name, last_name, dob, gender, street_address, suburb, state, postcode, email, phone, skills, status) VALUES
('WD001', 'John', 'Smith', '1995-05-15', 'Male', '123 Main Street', 'Melbourne', 'VIC', '3000', 'john.smith@example.com', '0412345678', 'PHP, MySQL, JavaScript, Laravel', 'New'),
('WD001', 'Emily', 'Johnson', '1998-08-20', 'Female', '456 Queen Street', 'Sydney', 'NSW', '2000', 'emily.j@example.com', '0498765432', 'HTML, CSS, JavaScript, React', 'Current'),
('FS002', 'Michael', 'Brown', '1996-03-10', 'Male', '789 George Street', 'Brisbane', 'QLD', '4000', 'michael.b@example.com', '0401234567', 'React, Node.js, MongoDB, Express', 'New'),
('FE003', 'Sarah', 'Davis', '1999-11-25', 'Female', '321 Collins Street', 'Melbourne', 'VIC', '3001', 'sarah.d@example.com', '0476543210', 'HTML, CSS, JavaScript, Vue.js', 'Final');

-- ================================================
-- Useful Queries
-- ================================================

-- List all EOIs with job information
-- SELECT e.*, j.job_title, j.company_name 
-- FROM eoi e 
-- LEFT JOIN jobs j ON e.job_reference = j.job_reference;

-- Count EOIs by status
-- SELECT status, COUNT(*) as count 
-- FROM eoi 
-- GROUP BY status;

-- Count EOIs by job
-- SELECT job_reference, COUNT(*) as applicants 
-- FROM eoi 
-- GROUP BY job_reference;

-- Recent applications (last 7 days)
-- SELECT * FROM eoi 
-- WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY);

-- ================================================
-- End of Setup Script
-- ================================================
