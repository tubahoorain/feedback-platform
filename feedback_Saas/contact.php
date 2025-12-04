<?php
// Include your database connection file
include 'db_connection.php';

// Initialize a variable for messages
$message = '';
$message_type = ''; // 'success' or 'error'

// Check if the form was submitted
if(isset($_POST['submit'])){
    // Retrieve form data - Sanitize input for security!
    // For a real application, use prepared statements to prevent SQL injection.
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $messege = $_POST['mes']; // Renamed to avoid conflict with PHP's $message

    // Check database connection first
    if (!$conn) {
        $message = "Database connection failed: " . mysqli_connect_error();
        $message_type = 'error';
    } else {
        // Construct the SQL query
        // Ensure all string values are enclosed in single quotes
        $sql = "INSERT INTO contact(fname, lname, email, messege) VALUES('$fname', '$lname', '$email', '$message')";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if($result){
            $message = "Your message has been sent successfully!";
            $message_type = 'success';
            // Optionally, clear form fields after successful submission
            // header("Location: contact.php?status=success"); // Redirect to clear POST data
            // exit();
        } else {
            $message = "Error: " . mysqli_error($conn);
            $message_type = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedbackSaaS - Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Styles for the dynamic message */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        .alert-success {
            background-color: #d1fae5; /* Tailwind green-100 */
            color: #065f46; /* Tailwind green-800 */
            border: 1px solid #a7f3d0; /* Tailwind green-200 */
        }
        .alert-error {
            background-color: #fee2e2; /* Tailwind red-100 */
            color: #991b1b; /* Tailwind red-800 */
            border: 1px solid #fecaca; /* Tailwind red-200 */
        }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    <!-- Nav -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="index.php" class="flex items-center cursor-pointer">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-2 text-white font-bold text-xl">F</div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">Feedback<span class="text-indigo-600">SaaS</span></span>
                </a>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Home</a>
                    <a href="features.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Features</a>
                    <a href="pricing.php" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Pricing</a>
                    <a href="contact.php" class="text-sm font-medium text-indigo-600 transition-colors">Contact</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                     <a href="index.php" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium">Login</a>
                     <a href="index.php" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Get Started</a>
                </div>
                 <div class="md:hidden flex items-center">
                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-900 p-2"><i data-lucide="menu"></i></button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 py-4 px-4 space-y-4 shadow-lg absolute w-full">
            <a href="index.php" class="block w-full text-left py-2 font-medium text-gray-600">Home</a>
            <a href="features.php" class="block w-full text-left py-2 font-medium text-gray-600">Features</a>
            <a href="pricing.php" class="block w-full text-left py-2 font-medium text-gray-600">Pricing</a>
            <a href="contact.php" class="block w-full text-left py-2 font-medium text-gray-600">Contact</a>
        </div>
    </nav>

    <main class="flex-1">
        <div class="bg-gray-50 py-20 px-6 text-center">
            <h1 class="text-4xl font-bold mb-6 text-gray-900">Get in Touch</h1>
            <p class="text-gray-600 text-xl max-w-2xl mx-auto">Have questions about the platform? Our team is ready to help you.</p>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-16">
              
              <!-- Contact Info -->
              <div class="space-y-10">
                <div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>
                  <p class="text-gray-600 mb-8">Fill out the form and our sales team will get back to you within 24 hours.</p>
                  
                  <div class="space-y-6">
                    <div class="flex items-start gap-4">
                      <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600"><i data-lucide="mail"></i></div>
                      <div>
                        <div class="font-medium text-gray-900">Email Us</div>
                        <div class="text-gray-600">support@feedbacksaas.com</div>
                      </div>
                    </div>
                    <div class="flex items-start gap-4">
                      <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600"><i data-lucide="phone"></i></div>
                      <div>
                        <div class="font-medium text-gray-900">Call Us</div>
                        <div class="text-gray-600">+92 300 1234567</div>
                      </div>
                    </div>
                    <div class="flex items-start gap-4">
                      <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600"><i data-lucide="map-pin"></i></div>
                      <div>
                        <div class="font-medium text-gray-900">Visit Us</div>
                        <div class="text-gray-600">Lahore, Pakistan</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="p-8 bg-indigo-900 rounded-2xl text-white">
                  <h4 class="font-bold text-lg mb-2">Enterprise Support</h4>
                  <p class="text-indigo-200 text-sm">Need a custom solution for a large organization? We offer white-labeling and dedicated server options.</p>
                </div>
              </div>

              <!-- Contact Form -->
              <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $message_type; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form method="post" class="space-y-6">
                  <div class="grid md:grid-cols-2 gap-6">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                      <input type="text" name="fname" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="your name" required>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                      <input type="text" name="lname" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="your last name" required>
                    </div>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="example@company.com" required>
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea rows="4" name="mes" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="How can we help you?" required></textarea>
                  </div>

                  <button type="submit" name="submit" class="w-full py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700">Send Message</button>
                </form>
              </div>

            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm">
            <p>© 2024 FeedbackSaaS Platform. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>