<?php
$pageTitle = "Manage Applications - Tech Job Portal";
include 'header.inc';
include 'nav.inc';
require_once 'settings.php';

// Create EOI table if it doesn't exist
if ($conn) {
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
}

// Process actions
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        // Delete EOIs by job reference
        if ($action === 'delete_by_job' && isset($_POST['delete_job_ref'])) {
            $job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_ref']);
            $delete_query = "DELETE FROM eoi WHERE job_reference = '$job_ref'";
            if (mysqli_query($conn, $delete_query)) {
                $affected = mysqli_affected_rows($conn);
                $message = "Successfully deleted $affected application(s) with job reference $job_ref";
                $message_type = 'success';
            } else {
                $message = "Error deleting: " . mysqli_error($conn);
                $message_type = 'error';
            }
        }
        
        // Update EOI status
        if ($action === 'update_status' && isset($_POST['eoi_number']) && isset($_POST['new_status'])) {
            $eoi_number = (int)$_POST['eoi_number'];
            $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);
            $update_query = "UPDATE eoi SET status = '$new_status' WHERE EOInumber = $eoi_number";
            if (mysqli_query($conn, $update_query)) {
                $message = "Successfully updated status of EOI #$eoi_number to $new_status";
                $message_type = 'success';
            } else {
                $message = "Error updating: " . mysqli_error($conn);
                $message_type = 'error';
            }
        }
    }
}

// Get search parameters
$search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'all';
$search_value = isset($_GET['search_value']) ? mysqli_real_escape_string($conn, $_GET['search_value']) : '';

// Build query based on search type
$query = "SELECT * FROM eoi WHERE 1=1";

if ($search_type === 'job' && !empty($search_value)) {
    $query .= " AND job_reference LIKE '%$search_value%'";
} elseif ($search_type === 'name' && !empty($search_value)) {
    $query .= " AND (first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%')";
} elseif ($search_type === 'status' && !empty($search_value)) {
    $query .= " AND status = '$search_value'";
}

// Add ordering
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'EOInumber';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'DESC';
$query .= " ORDER BY $order_by $order_dir";

$result = $conn ? mysqli_query($conn, $query) : null;
?>

<main class="main-content">
    <div class="container">
        <section class="page-header">
            <h2>🔧 Manage Applications</h2>
            <p>HR Management Dashboard</p>
        </section>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Search and Filter Section -->
        <section class="manage-controls">
            <div class="search-box">
                <h3>🔍 Search & Filter</h3>
                <form method="get" action="manage.php" class="search-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="search_type">Search by:</label>
                            <select name="search_type" id="search_type">
                                <option value="all" <?php echo $search_type === 'all' ? 'selected' : ''; ?>>All</option>
                                <option value="job" <?php echo $search_type === 'job' ? 'selected' : ''; ?>>Job Reference</option>
                                <option value="name" <?php echo $search_type === 'name' ? 'selected' : ''; ?>>Applicant Name</option>
                                <option value="status" <?php echo $search_type === 'status' ? 'selected' : ''; ?>>Status</option>
                            </select>
                        </div>

                        <div class="form-group" id="search_value_group">
                            <label for="search_value">Search value:</label>
                            <input type="text" name="search_value" id="search_value" 
                                   value="<?php echo htmlspecialchars($search_value); ?>" 
                                   placeholder="Enter keyword...">
                        </div>

                        <div class="form-group" id="status_select_group" style="display: none;">
                            <label for="status_value">Status:</label>
                            <select name="search_value" id="status_value">
                                <option value="New" <?php echo $search_value === 'New' ? 'selected' : ''; ?>>New</option>
                                <option value="Current" <?php echo $search_value === 'Current' ? 'selected' : ''; ?>>Current</option>
                                <option value="Final" <?php echo $search_value === 'Final' ? 'selected' : ''; ?>>Final</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order_by">Sort by:</label>
                            <select name="order_by" id="order_by">
                                <option value="EOInumber" <?php echo $order_by === 'EOInumber' ? 'selected' : ''; ?>>EOI Number</option>
                                <option value="created_at" <?php echo $order_by === 'created_at' ? 'selected' : ''; ?>>Date Created</option>
                                <option value="last_name" <?php echo $order_by === 'last_name' ? 'selected' : ''; ?>>Last Name</option>
                                <option value="status" <?php echo $order_by === 'status' ? 'selected' : ''; ?>>Status</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="order_dir">Order:</label>
                            <select name="order_dir" id="order_dir">
                                <option value="ASC" <?php echo $order_dir === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                                <option value="DESC" <?php echo $order_dir === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="manage.php" class="btn btn-secondary">Reset</a>
                </form>
            </div>

            <!-- Delete by Job Reference -->
            <div class="delete-box">
                <h3>🗑️ Delete by Job Reference</h3>
                <form method="post" action="manage.php" class="delete-form" 
                      onsubmit="return confirm('Are you sure you want to delete all applications for this job?');">
                    <input type="hidden" name="action" value="delete_by_job">
                    <div class="form-row">
                        <input type="text" name="delete_job_ref" placeholder="Enter job reference" required>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- EOI List Section -->
        <section class="eoi-list">
            <h3>📋 Application List</h3>
            
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <div class="table-responsive">
                    <table class="eoi-table">
                        <thead>
                            <tr>
                                <th>EOI Number</th>
                                <th>Job Ref</th>
                                <th>Full Name</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Skills</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($eoi = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $eoi['EOInumber']; ?></td>
                                    <td><?php echo htmlspecialchars($eoi['job_reference']); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['first_name'] . ' ' . $eoi['last_name']); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($eoi['dob'])); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['street_address'] . ', ' . $eoi['suburb'] . ', ' . $eoi['state'] . ' ' . $eoi['postcode']); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['email']); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($eoi['skills']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo strtolower($eoi['status']); ?>">
                                            <?php echo htmlspecialchars($eoi['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y H:i', strtotime($eoi['created_at'])); ?></td>
                                    <td>
                                        <form method="post" action="manage.php" style="display: inline;">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="eoi_number" value="<?php echo $eoi['EOInumber']; ?>">
                                            <select name="new_status" class="status-select">
                                                <option value="New" <?php echo $eoi['status'] === 'New' ? 'selected' : ''; ?>>New</option>
                                                <option value="Current" <?php echo $eoi['status'] === 'Current' ? 'selected' : ''; ?>>Current</option>
                                                <option value="Final" <?php echo $eoi['status'] === 'Final' ? 'selected' : ''; ?>>Final</option>
                                            </select>
                                            <button type="submit" class="btn btn-small">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="eoi-stats">
                    <p>Total applications: <strong><?php echo mysqli_num_rows($result); ?></strong></p>
                </div>
            <?php else: ?>
                <p class="no-results">No applications found.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
// Show/hide search input based on search type
document.getElementById('search_type').addEventListener('change', function() {
    var searchValueGroup = document.getElementById('search_value_group');
    var statusSelectGroup = document.getElementById('status_select_group');
    
    if (this.value === 'status') {
        searchValueGroup.style.display = 'none';
        statusSelectGroup.style.display = 'block';
    } else {
        searchValueGroup.style.display = 'block';
        statusSelectGroup.style.display = 'none';
    }
});

// Initialize on page load
window.addEventListener('load', function() {
    var searchType = document.getElementById('search_type').value;
    if (searchType === 'status') {
        document.getElementById('search_value_group').style.display = 'none';
        document.getElementById('status_select_group').style.display = 'block';
    }
});
</script>

<?php 
if ($conn) { mysqli_close($conn); }
include 'footer.inc'; 
?>
