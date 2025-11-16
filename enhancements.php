<?php
$pageTitle = "Enhancements - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
?>

<main class="main-content">
    <div class="container">
        <section class="page-header">
            <h2>✨ Enhancement Features</h2>
            <p>Additional features developed for the project</p>
        </section>

        <section class="enhancements-intro">
            <p>
                In addition to the basic requirements, we have developed many advanced features 
                to enhance the user experience and management capabilities of the system.
            </p>
        </section>

        <div class="enhancements-list">
            
            <!-- Enhancement 1: Sorting -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">1</span>
                    <h3>Sorting and Filtering EOIs</h3>
                    <span class="enhancement-points">+2 points</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        The manage.php page includes the ability to sort applications by various criteria 
                        such as EOI Number, date created, last name, and status. Supports both ascending 
                        and descending order.
                    </p>
                    
                    <h4>How to use:</h4>
                    <ul>
                        <li>Access the <a href="manage.php">Manage</a> page</li>
                        <li>Select sorting criterion from "Sort by" dropdown</li>
                        <li>Choose ascending or descending order</li>
                        <li>Click "Search" to apply</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>SQL ORDER BY clause, PHP GET parameters, Dynamic query building</p>
                </div>
            </article>

            <!-- Enhancement 2: Advanced Search -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">2</span>
                    <h3>Advanced Search</h3>
                    <span class="enhancement-points">+2 points</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        The search system allows filtering applications by multiple criteria: job reference, 
                        applicant name (first or last name), and status. Search uses LIKE queries for 
                        partial matching.
                    </p>
                    
                    <h4>Features:</h4>
                    <ul>
                        <li>Search by job reference</li>
                        <li>Search by applicant first or last name</li>
                        <li>Filter by status (New, Current, Final)</li>
                        <li>Combine search with sorting</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>SQL LIKE operator, Dynamic WHERE clauses, JavaScript for UI enhancement</p>
                </div>
            </article>

            <!-- Enhancement 3: Responsive Design -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">3</span>
                    <h3>Responsive Design</h3>
                    <span class="enhancement-points">+1 point</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        The entire website is designed to be responsive, automatically adjusting the interface 
                        to suit all screen sizes from phones, tablets to desktops.
                    </p>
                    
                    <h4>Features:</h4>
                    <ul>
                        <li>Flexible grid layout</li>
                        <li>Mobile-first approach</li>
                        <li>Touch-friendly buttons and forms</li>
                        <li>Optimized typography for mobile</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>CSS3 Media Queries, Flexbox, CSS Grid</p>
                </div>
            </article>

            <!-- Enhancement 4: Data Validation -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">4</span>
                    <h3>Advanced Validation</h3>
                    <span class="enhancement-points">+1 point</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        Multi-level validation system with both client-side and server-side validation. 
                        Particularly checks that postcodes match the selected state.
                    </p>
                    
                    <h4>Validation rules:</h4>
                    <ul>
                        <li>Age 15-80 calculated from date of birth</li>
                        <li>First and last name max 20 characters, letters only</li>
                        <li>Email format validation</li>
                        <li>Phone number 8-12 digits</li>
                        <li>Postcode 4 digits matching state</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>PHP validation, Regular expressions, Custom validation logic</p>
                </div>
            </article>

            <!-- Enhancement 5: UI/UX Improvements -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">5</span>
                    <h3>UI/UX Improvements</h3>
                    <span class="enhancement-points">+1 point</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        The interface is designed with harmonious colors, clear typography, 
                        and smooth animations to create a good user experience.
                    </p>
                    
                    <h4>Features:</h4>
                    <ul>
                        <li>Modern card-based design</li>
                        <li>Smooth transitions and animations</li>
                        <li>Color-coded status badges</li>
                        <li>Intuitive navigation menu with active states</li>
                        <li>Forms with clear labels and helpful hints</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>CSS3 Animations, Custom CSS properties, Modern color palette</p>
                </div>
            </article>

            <!-- Enhancement 6: Auto-populate -->
            <article class="enhancement-card">
                <div class="enhancement-header">
                    <span class="enhancement-number">6</span>
                    <h3>Auto-populate Job Reference</h3>
                    <span class="enhancement-points">+1 point</span>
                </div>
                <div class="enhancement-content">
                    <h4>Description:</h4>
                    <p>
                        When clicking "Apply Now" from the jobs page, the job reference is automatically 
                        filled in the application form, saving time for users.
                    </p>
                    
                    <h4>How it works:</h4>
                    <ul>
                        <li>Link from jobs.php passes job reference via URL parameter</li>
                        <li>apply.php receives and automatically fills in the form</li>
                        <li>Displays selected job information</li>
                    </ul>
                    
                    <h4>Technology:</h4>
                    <p>PHP GET parameters, URL query strings, Form pre-population</p>
                </div>
            </article>

        </div>

        <section class="summary">
            <h3>Summary</h3>
            <div class="summary-content">
                <p><strong>Total enhancement features:</strong> 6 features</p>
                <p><strong>Total points:</strong> 8/8 points</p>
                <p>
                    These advanced features not only meet the scoring requirements but also 
                    truly enhance the quality and usability of the system. We focus on 
                    creating a complete, professional, and user-friendly product.
                </p>
            </div>
        </section>

    </div>
</main>

<?php include 'footer.inc'; ?>
