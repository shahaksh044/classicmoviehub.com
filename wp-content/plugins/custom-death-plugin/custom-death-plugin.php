<?php
/*
Plugin Name: Custom Death Plugin
Description: Displays death anniversaries for classic movie stars, includes custom URL routing, dropdowns, and date reformatting.
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Step 1: Initialization
add_action('init', 'custom_death_plugin_init');
function custom_death_plugin_init() {
    // Redirect logic for 'cache' parameter
    if (isset($_GET['cache']) && $_GET['cache'] != "0") {
        wp_redirect('https://www.classicmoviehub.com/', 301);
        exit;
    }

    // Add rewrite rules for custom death plugin
    add_rewrite_tag('%death_page%', '([^&]+)');
    add_rewrite_tag('%death_date%', '([^&]+)');

    add_rewrite_rule(
        '^custom-death-plugin/deaths/month/([^/]+)/?$',
        'index.php?death_page=1&death_date=$matches[1]',
        'top'
    );
}

register_activation_hook(__FILE__, 'custom_death_plugin_activate');
function custom_death_plugin_activate() {
    custom_death_plugin_init();
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'custom_death_plugin_deactivate');
function custom_death_plugin_deactivate() {
    flush_rewrite_rules();
}

// Step 2: Query Vars
add_filter('query_vars', 'custom_death_plugin_query_vars');
function custom_death_plugin_query_vars($vars) {
    $vars[] = 'death_page';
    $vars[] = 'death_date';
    return $vars;
}

// Step 3: Template Redirect
add_action('template_redirect', function () {
    $is_death_page = get_query_var('death_page') == '1';

    if ($is_death_page) {
        $death_date = get_query_var('death_date');
        
        if ($death_date) {
            include plugin_dir_path(__FILE__) . 'templates/custom-deaths.php';
            exit;
        }

        wp_redirect(home_url('/database/'), 301);
        exit;
    }
});

// Step 4: Death List Shortcode
add_shortcode('death_list', 'custom_death_plugin_display_deaths');
function custom_death_plugin_display_deaths() {
    global $wpdb;

    $selected_month = isset($_GET['month']) ? sanitize_text_field($_GET['month']) : date('F');
    $selected_year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
    $selected_day = isset($_GET['day']) ? intval($_GET['day']) : 0;

    $months = [
        'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
        'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
        'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12
    ];

    if (!isset($months[$selected_month])) {
        $selected_month = date('F');
    }

    $current_year = date('Y');
    if ($selected_year < 1800 || $selected_year > $current_year) {
        $selected_year = $current_year;
    }

    if ($selected_day < 0 || $selected_day > 31) {
        $selected_day = 0;
    }

    $query_conditions = [];
    $query_params = [];

    $query_conditions[] = "MONTH(died) = %d";
    $query_params[] = $months[$selected_month];

    if (!empty($selected_year)) {
        $query_conditions[] = "YEAR(died) = %d";
        $query_params[] = $selected_year;
    }

    if ($selected_day > 0) {
        $query_conditions[] = "DAY(died) = %d";
        $query_params[] = $selected_day;
    }

    $where_clause = implode(' AND ', $query_conditions);

    $query = $wpdb->prepare("
        SELECT DISTINCT SQL_CALC_FOUND_ROWS
               name, u_name, birth_city, death_city, death_state,
               DATE_FORMAT(died, '%%b %%e, %%Y') AS _died, 
               gender, default_job
        FROM agatti_people
        WHERE {$where_clause}
          AND active = 1
        ORDER BY died DESC, name ASC
    ", $query_params);

    $results = $wpdb->get_results($query, ARRAY_A);
    $total_count = $wpdb->get_var("SELECT FOUND_ROWS()");

    $output = '';
    $output .= "
    <form method='get' action='" . esc_url(home_url('index.php/custom-death-plugin/deaths/month/')) . "'>
        <input type='hidden' name='death_page' value='1'>
        <select name='month'>";
    
    foreach ($months as $month => $month_num) {
        $selected = ($month === $selected_month) ? 'selected' : '';
        $output .= "<option value='{$month}' {$selected}>{$month}</option>";
    }

    $output .= "</select>
        <select name='year'>";

    for ($year = $current_year; $year >= 1800; $year--) {
        $selected = ($year == $selected_year) ? 'selected' : '';
        $output .= "<option value='{$year}' {$selected}>{$year}</option>";
    }

    $output .= "</select>
        <select name='day'>
            <option value='0'>All Days</option>";

    for ($day = 1; $day <= 31; $day++) {
        $selected = ($day == $selected_day) ? 'selected' : '';
        $output .= "<option value='{$day}' {$selected}>{$day}</option>";
    }

    $output .= "</select>
        <input type='submit' value='Filter'>
    </form>";

    if (!$results) {
        $output .= '<p>No records found for the selected criteria.</p>';
        return $output;
    }

    $output .= "<h3>{$total_count} Death Records in {$selected_month}</h3>";

    foreach ($results as $death) {
        $name = esc_html($death['name']);
        $died = esc_html($death['_died']);
        $deathplace = esc_html(trim($death['death_city'] . ', ' . $death['death_state'], ', '));

        $output .= "<div>
            <strong>{$name}</strong>
            <p>Died on: {$died}</p>
            <p>Place: {$deathplace}</p>
        </div>";
    }

    return $output;
}
