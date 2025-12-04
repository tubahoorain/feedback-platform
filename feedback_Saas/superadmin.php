<?php
session_start();
include 'db_connection.php'; // Database connection file include karein

// 1. Security Check (Optional: Uncomment karein jab login system ready ho)
// if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'superadmin') {
//     header("Location: index.php");
//     exit();
// }

// 2. Stats Fetch Karne ka Logic
// Total Companies
$sql_count = "SELECT COUNT(*) as total FROM users1 WHERE role != 'admin'"; 
$result_count = $conn->query($sql_count);
$total_companies = $result_count->fetch_assoc()['total'];

// Pending Companies Count
$sql_pending = "SELECT COUNT(*) as pending FROM users1 WHERE status = 'pending'";
$result_pending = $conn->query($sql_pending);
$pending_companies = $result_pending->fetch_assoc()['pending'];

// Dummy Revenue Logic (Example: 3000 PKR per company)
$monthly_revenue = $total_companies * 3000; 

// 3. Companies List Fetch Karne ka Logic (Newest first)
$sql_users = "SELECT * FROM users1 ORDER BY id DESC";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin - FeedbackSaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">
    
    <!-- Alert Logic -->
    <?php if (isset($_GET['msg'])): ?>
        <script>
            <?php if($_GET['msg'] == 'approved') echo "alert('Account Approved Successfully & Email Sent!');"; ?>
            <?php if($_GET['msg'] == 'deleted') echo "alert('Company deleted successfully!');"; ?>
            // URL clean karne ke liye
            window.history.replaceState(null, null, window.location.pathname);
        </script>
    <?php endif; ?>

    <!-- Header -->
    <header class="bg-gray-800 border-b border-gray-700 p-4 flex justify-between items-center sticky top-0 z-10">
        <div class="flex items-center gap-2">
          <i data-lucide="shield" class="text-indigo-500"></i>
          <span class="font-bold text-xl tracking-tight">SuperAdmin<span class="text-indigo-500">Panel</span></span>
        </div>
        <a href="logout.php" class="px-3 py-1.5 bg-gray-700 border border-gray-600 rounded text-sm hover:bg-gray-600 transition-colors">Logout</a>
    </header>

    <div class="p-4 md:p-8 max-w-7xl mx-auto space-y-8">
        
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Active Companies -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-500/20 rounded-lg text-indigo-400"><i data-lucide="users"></i></div>
                    <div>
                        <div class="text-sm text-gray-400">Total Companies</div>
                        <div class="text-2xl font-bold"><?php echo $total_companies; ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Requests -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-yellow-500/20 rounded-lg text-yellow-400"><i data-lucide="clock"></i></div>
                    <div>
                        <div class="text-sm text-gray-400">Pending Approvals</div>
                        <div class="text-2xl font-bold"><?php echo $pending_companies; ?></div>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-500/20 rounded-lg text-green-400"><i data-lucide="dollar-sign"></i></div>
                    <div>
                        <div class="text-sm text-gray-400">Est. Revenue</div>
                        <div class="text-2xl font-bold">PKR <?php echo number_format($monthly_revenue); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-xl">
            <div class="p-6 border-b border-gray-700 flex justify-between items-center bg-gray-800">
                <h3 class="text-lg font-semibold text-white">Registered Tenants</h3>
                <span class="flex items-center gap-1 text-xs text-green-400 bg-green-900/30 px-2 py-1 rounded-full"><span class="w-2 h-2 rounded-full bg-green-500"></span> Live Data</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-gray-900/50 uppercase text-xs font-semibold text-gray-500">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Company Info</th>
                            <th class="px-6 py-4">Payment</th>
                            <th class="px-6 py-4">Status</th> <!-- New Column Header -->
                            <th class="px-6 py-4">Joined Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php 
                        if ($result_users->num_rows > 0) {
                            while($row = $result_users->fetch_assoc()) { 
                                // Status color logic
                                $status_color = ($row['status'] == 'active') ? 'text-green-400 bg-green-900/20' : 'text-yellow-400 bg-yellow-900/20';
                        ?>
                            <tr class="hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-6 py-4 text-gray-500">#<?php echo $row['id']; ?></td>
                                
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white text-base"><?php echo htmlspecialchars($row['company_name']); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['email']); ?></div>
                                    <div class="text-xs text-gray-600 mt-1"><?php echo htmlspecialchars($row['full_name']); ?></div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-300"><?php echo isset($row['payment_method']) ? $row['payment_method'] : 'N/A'; ?></span>
                                        <span class="text-[10px] text-gray-500 truncate max-w-[100px]" title="<?php echo $row['transaction_id']; ?>">
                                            <?php echo isset($row['transaction_id']) ? $row['transaction_id'] : '-'; ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold uppercase <?php echo $status_color; ?>">
                                        <?php echo isset($row['status']) ? $row['status'] : 'pending'; ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <?php echo isset($row['created_at']) ? date("d M Y", strtotime($row['created_at'])) : '-'; ?>
                                </td>
                                
                                <!-- ACTIONS COLUMN (Here is your requested code) -->
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-3">
                                        
                                        <!-- Approval Logic -->
                                        <?php if(isset($row['status']) && $row['status'] == 'pending'): ?>
                                            <a href="approve_user.php?id=<?php echo $row['id']; ?>&email=<?php echo $row['email']; ?>" 
                                               onclick="return confirm('Are you sure you want to approve this company?')"
                                               class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition-colors shadow-sm">
                                               Approve
                                            </a>
                                        <?php else: ?>
                                            <span class="flex items-center text-green-500 text-xs font-medium border border-green-500/30 bg-green-500/10 px-2 py-1 rounded cursor-default">
                                                <i data-lucide="check" class="w-3 h-3 mr-1"></i> Active
                                            </span>
                                        <?php endif; ?>

                                        <!-- Delete Button -->
                                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                                           onclick="return confirm('WARNING: This will delete the company and ALL their data. Are you sure?')" 
                                           class="p-2 text-gray-500 hover:bg-red-900/30 hover:text-red-400 rounded-lg transition-all" title="Delete User">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </a>

                                    </div>
                                </td>
                                <!-- End Actions Column -->

                            </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-8 text-gray-500'>No companies registered yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Icons initialize karein
        lucide.createIcons();
    </script>
</body>
</html>