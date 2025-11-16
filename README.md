Tech Job Portal - Project Part 2

📋 Project Introduction

Tech Job Portal is an online recruitment platform developed using PHP and MySQL. This project is an extension of Part 1, integrating server-side data processing and database management to create a complete recruitment system.

🗂️ Project Structure

```
project2/
├── index.php              # Home page
├── jobs.php              # Job listings (dynamic from DB)
├── apply.php             # Application form
├── about.php             # About the team
├── enhancements.php      # Enhancement features list
├── settings.php          # Database configuration
├── process_eoi.php       # Form processing
├── manage.php            # HR management page
├── header.inc            # Header template
├── nav.inc               # Navigation menu
├── footer.inc            # Footer template
├── images/               # Images directory
├── styles/
│   ├── style.css         # Main CSS file
│   └── images/           # CSS images
└── README.md             # This file
```

🚀 Installation Guide

System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP/MAMP (for local environment)

Installation Steps

1. **Copy project to web server directory**
   ```bash
   # For XAMPP
   C:\xampp\htdocs\project2\
   
   # For WAMP
   C:\wamp64\www\project2\
   ```

2. **Configure database**
   
   Open `settings.php` and update connection info:
   ```php
   $host = "localhost";
   $user = "root";
   $pwd = "";
   $sql_db = "project2_db";
   ```

3. Start web server and MySQL
   
   Use XAMPP Control Panel to start Apache and MySQL

4. Access website
   
   Open browser and go to: `http://localhost/project2/`

5. Database auto-creation
   
   Tables `eoi` and `jobs` will be automatically created on first access

📊 Database Structure

`eoi` Table (Expressions of Interest)

| Field | Type | Description |
|-------|------|-------------|
| EOInumber | INT (PK, Auto) | Application number |
| job_reference | VARCHAR(10) | Job reference |
| first_name | VARCHAR(20) | First name |
| last_name | VARCHAR(20) | Last name |
| dob | DATE | Date of birth |
| gender | VARCHAR(10) | Gender |
| street_address | VARCHAR(40) | Street address |
| suburb | VARCHAR(40) | Suburb/Town |
| state | VARCHAR(3) | State |
| postcode | VARCHAR(4) | Postcode |
| email | VARCHAR(100) | Email address |
| phone | VARCHAR(12) | Phone number |
| skills | TEXT | Skills |
| status | VARCHAR(20) | Status (New/Current/Final) |
| created_at | TIMESTAMP | Creation date |

`jobs` Table

| Field | Type | Description |
|-------|------|-------------|
| job_id | INT (PK, Auto) | Job ID |
| job_reference | VARCHAR(10) | Job reference (unique) |
| job_title | VARCHAR(100) | Job title |
| company_name | VARCHAR(100) | Company name |
| location | VARCHAR(100) | Location |
| salary_range | VARCHAR(50) | Salary range |
| job_type | VARCHAR(50) | Job type |
| description | TEXT | Description |
| requirements | TEXT | Requirements |
| responsibilities | TEXT | Responsibilities |
| benefits | TEXT | Benefits |
| posted_date | DATE | Posted date |
| closing_date | DATE | Closing date |
| status | VARCHAR(20) | Status |

✅ Implemented Features

Task A: Technical Requirements

1. ✅ Code Reusability (Modularisation)
- Common components separated into `.inc` files
- `header.inc` - Header and meta tags
- `nav.inc` - Navigation menu
- `footer.inc` - Footer
- All main pages have `.php` extension

2. ✅ Database Connection (settings.php)
- Database configuration file
- Auto-creates database if not exists
- Uses mysqli for security

3. ✅ EOI Table
- Auto-creates table if not exists
- Default status: "New"
- Other statuses: "Current", "Final"
- Automatic timestamp for created_at

4. ✅ Processing and Validation (process_eoi.php)
Security:
- Cannot be accessed directly via URL (redirects to apply.php)
- Sanitizes all inputs (trim, stripslashes, htmlspecialchars)
- Prepared statements to prevent SQL injection

Validation:
- Form has `novalidate="novalidate"` to test server-side validation
- Checks all required fields
- First/Last name: max 20 chars, letters only
- Age: 15-80 (calculated from DOB)
- Email: format validation
- Phone: 8-12 digits
- Postcode: 4 digits, must match state
- Displays EOInumber on success

5. ✅ Management Page (manage.php)
Features:
- List all EOIs
- Search by job reference
- Search by applicant name
- Filter by status
- Delete all EOIs by job reference
- Update EOI status
- Sort by multiple criteria

6. ✅ Dynamic Job Descriptions (jobs.php)
- Creates jobs table in database
- Page content created dynamically from database
- Auto-inserts sample jobs on first run
- Displays complete job information

7. ✅ About Page (about.php)
- Development team information
- Individual member contributions
- Technologies used
- Contact information

8. ✅ Enhancements (enhancements.php)

🎨 Enhancement Features (8/8 points)

1. Sorting and Filtering EOIs (+2 points)
- Sort by: EOInumber, created_at, last_name, status
- Support ascending/descending order
- Integrated with search

2. Advanced Search (+2 points)
- Search by job reference
- Search by applicant name (LIKE query)
- Filter by status
- Partial matching support

3. Responsive Design (+1 point)
- Mobile-first approach
- Flexbox and CSS Grid
- Media queries for all screen sizes
- Touch-friendly UI

4. Advanced Validation (+1 point)
- Comprehensive server-side validation
- Regex validation for multiple fields
- Age calculation from DOB
- Postcode-state matching

5. UI/UX Improvements (+1 point)
- Modern card-based design
- Smooth animations and transitions
- Color-coded status badges
- Intuitive navigation
- Professional color scheme

6. Auto-populate Job Reference (+1 point)
- Click "Apply Now" from jobs.php
- Job reference automatically filled in form
- Displays selected job info
- URL parameter passing

🎨 Design & UI/UX

Color Scheme
- Primary: #2563eb (Blue)
- Secondary: #64748b (Slate)
- Success: #10b981 (Green)
- Error: #ef4444 (Red)

Typography
- Font family: System font stack (San Francisco, Segoe UI, Roboto)
- Responsive font sizes
- Clear hierarchy

Components
- Card-based layout
- Modern form design
- Status badges
- Interactive buttons
- Responsive tables

🔒 Security

1. SQL Injection Protection
   - Uses prepared statements
   - mysqli_real_escape_string for dynamic queries

2. XSS Prevention
   - htmlspecialchars() for all outputs
   - Input sanitization

3. Access Control
   - process_eoi.php only accepts POST requests
   - Redirects if accessed directly

4. Data Validation
   - Complete server-side validation
   - Does not trust client-side validation

📱 Responsive Design

Website works well on:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (< 768px)

🧪 Testing

Test Cases Performed

1. Database Connection
   - ✅ Auto-creates database
   - ✅ Auto-creates tables
   - ✅ Inserts sample data

2. Form Validation
   - ✅ Required fields
   - ✅ Field length limits
   - ✅ Format validation
   - ✅ Age validation
   - ✅ Postcode-state matching

3. CRUD Operations
   - ✅ Create EOI
   - ✅ Read EOI (list, search)
   - ✅ Update EOI status
   - ✅ Delete EOI by job reference

4. Security
   - ✅ Direct URL access prevention
   - ✅ SQL injection protection
   - ✅ XSS prevention

📝 Important Notes

1. Relative links**: All links use relative paths
2. novalidate attribute**: Form has novalidate to test server-side validation
3. Database auto-creation**: Tables and sample data created automatically
4. Error handling**: Clear error messages
5. User feedback**: Success/error messages after all actions

🎯 Complete Checklist

Task A
- [x] Modularisation with .inc files
- [x] settings.php with database connection
- [x] EOI table with all fields
- [x] process_eoi.php with validation and security
- [x] manage.php with all management functions
- [x] jobs.php dynamic from database
- [x] about.php with team information
- [x] enhancements.php and 6 enhancement features

Task B
- [x] Correct directory structure
- [x] All files in correct location
- [x] Correct naming conventions
- [x] Relative links only
- [x] Correct file extensions (.php, .inc)

👥 Team Information

Detailed team information can be found on the [About](about.php) page.

📞 Contact

- Email: team@techportal.com
- Website: techportal.com
- Phone: +1 (555) 123-4567

📄 License

This project was developed for educational purposes.

---

Note: This is an educational project. In a production environment, additional security features and optimizations are required.

 
 