<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get the month and year from the URL or GET parameters
global $wp_query;
$month_date = $wp_query->get('month_date');

// If month_date is empty, try to get from GET parameters
if (empty($month_date) && isset($_GET['month']) && isset($_GET['year'])) {
    $month_date = strtolower($_GET['month']) . '-' . $_GET['year'];
}

// Validate and parse month_date
if (!preg_match('/^([a-z]+)-(\d{4})$/', $month_date, $matches)) {
    error_log('Invalid month_date: ' . $month_date);
    wp_redirect(home_url('/database/'), 301);
    exit;
}

$month_name = ucfirst($matches[1]);
$year = $matches[2];

// Validate year
if ($year < 1800 || $year > date('Y')) {
    wp_redirect(home_url('/database/'), 301);
    exit;
}

// Months mapping
$months = ['All Months' => 0,
    'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4, 
    'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8, 
    'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
];

// Validate month
if (!isset($months[$month_name])) {
    wp_redirect(home_url('/database/'), 301);
    exit;
}

// Get the template header
get_header();
?>

<div class="section-block-upper">
   <?php 
    // Use the existing shortcode function to display birthdays
    echo do_shortcode('[birthday_list]');
    
    ?>
   
</div>

    
<?php
get_footer();
?>