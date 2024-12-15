<?php
// Add this code to a custom plugin or theme's `functions.php`

// Hook to process data when a specific query variable is set
add_action('template_redirect', function () {
   // global $wpdb;

    // Get the current URL
  $actual_url = $_SERVER['REQUEST_URI'];

    // Redirect if the conditions are met
    if (stripos($actual_url, "bio.php") !== false && empty($_GET['id'])) {
        wp_redirect(home_url('/actors/all/last-name/a/'), 301);
        exit;
    }

    // Fetch parameters from the request
    $u_name = isset($_GET['u_name']) ? sanitize_text_field($_GET['u_name']) : '';
    $person_id = isset($_GET['person_id']) ? intval($_GET['person_id']) : null;
    $person_name = isset($_GET['name']) ? mb_convert_encoding(sanitize_text_field($_GET['name']), "UTF-8") : '';
    $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';

    // Validate job type
    $array_job_types = array("a", "d", "p", "w", "m");
    if (!empty($type) && !in_array($type, $array_job_types)) {
        $type = '';
    }

    // Database table name (use WordPress table prefix)
    $table_name = $wpdb->prefix . 'agatti_people';

    // Fetch person data based on `u_name`
    if ($u_name) {
        $person = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT *, 
                DATE_FORMAT(birthday, '%%b %%e, %%Y') as _birthday,
                DATE_FORMAT(died, '%%b %%e, %%Y') as _died,
                MONTH(birthday) as month_birth,
                DAY(birthday) as day_birth,
                DATE_FORMAT(birthday, '%%b %%e') as _birth_day_month
                FROM $table_name WHERE u_name = %s",
                $u_name
            ),
            ARRAY_A
        );

        if ($person) {
            echo $person_id = $person['id'];
        }
    }

    // Handle redirection based on `person_id`
    if ($person_id && empty($u_name)) {
        $u_name = $wpdb->get_var(
            $wpdb->prepare("SELECT u_name FROM $table_name WHERE id = %d", $person_id)
        );

        if ($u_name) {
            wp_redirect(home_url('/bio/' . $u_name . '/'), 301);
            exit;
        }
    }
});
// Fetch and sanitize person details
$birth = isset($person['_birthday']) ? esc_html($person['_birthday']) : 'N/A';

if (!isset($person['_died']) || empty($person['_died'])) {
    $_died = 'N/A';
} else {
    $_died = sprintf(
        '<span itemprop="deathDate" content="%s" datetime="%s">%s</span>',
        esc_attr($person['died']),
        esc_attr($person['died']),
        esc_html($person['_died'])
    );
}

// Determine job role
$stats_job = '';
if (isset($person['director'])) {
    if ($person['director'] == 0) {
        $stats_job = ($person['gender'] == 1) ? 'Actor' : 'Actress';
    } elseif ($person['director'] == 1) {
        $stats_job = 'Director';
    } elseif ($person['director'] == 2) {
        $stats_job = 'Actor/Director';
    }
}

// Fetch additional person details
$birth_city = isset($person['birth_city']) ? esc_html($person['birth_city']) : '';
$birth_state = isset($person['birth_state']) ? esc_html($person['birth_state']) : '';
$birthplace = $birth_city && $birth_state ? $birth_city . ', ' . $birth_state : 'Unknown';

$death_city = isset($person['death_city']) ? esc_html($person['death_city']) : '';
$death_state = isset($person['death_state']) ? esc_html($person['death_state']) : '';
$deathplace = $death_city && $death_state ? $death_city . ', ' . $death_state : 'Unknown';

$mother = isset($person['mother']) ? esc_html($person['mother']) : 'Unknown';
$father = isset($person['father']) ? esc_html($person['father']) : 'Unknown';

$star_number = isset($person['star_number']) ? esc_html($person['star_number']) : '';
$star_street = isset($person['star_street']) ? esc_html($person['star_street']) : '';
$walk_of_fame = trim("$star_number $star_street");

$buried = isset($person['buried']) ? esc_html($person['buried']) : 'Unknown';
$buried_city = isset($person['buried_city']) ? esc_html($person['buried_city']) : '';
$buried_state = isset($person['buried_state']) ? esc_html($person['buried_state']) : '';
$buried_location = $buried_city && $buried_state ? "$buried ($buried_city, $buried_state)" : 'Unknown';

$birthname = isset($person['birthname']) ? wp_html_excerpt(esc_html($person['birthname']), 30) : 'Unknown';
$full_name = isset($person['first_name'], $person['last_name']) 
    ? esc_html($person['first_name'] . ' ' . $person['last_name']) 
    : 'Unknown';

$astro = isset($person['astrological']) ? esc_html($person['astrological']) : 'N/A';

// Thumbnail generation
$folder = 'thumbs';
$person_image = function_exists('getThumbnail') 
    ? esc_url(getThumbnail($person['id'], $folder)) 
    : 'default-thumbnail.jpg';

// Generate stats HTML
$stats = sprintf(
    '<!--<br/>%s<br/><br/>%s<br/><br/><span class="mask_words born"></span> %s <br/>%s<br/><br/><span class="mask_words passed"></span> %s<br/>%s-->',
    $stats_job,
    $full_name,
    $birth,
    $birthplace,
    $_died,
    $deathplace
);
?>
<?php
// Construct URLs for ratings and comments
$url_to_go_to_ratings = add_query_arg(
    [
        'id' => $person['id'],
        '_comments_action' => $_comments_action,
        'type' => $type,
    ],
    'ratings.php'
);

$url_to_go_to_comments = add_query_arg(
    [
        'id' => $person['id'],
        'type' => $type,
    ],
    'comments.php'
);

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    $url_to_go_to_ratings = add_query_arg(
        'url_to_go_to',
        urlencode($url_to_go_to_ratings),
        'login.php'
    );
    $url_to_go_to_comments = add_query_arg(
        'url_to_go_to',
        urlencode($url_to_go_to_comments),
        'login.php'
    );
}

// Prepare data for social sharing
$summary = isset($person['wiki_summary']) ? esc_html($person['wiki_summary']) : 'No summary available';
$summary = wp_strip_all_tags($summary); // Sanitize and strip HTML tags

$pinterest_description = sprintf(
    '%s (Born %s)',
    esc_html($full_name),
    esc_html($person['_birthday'])
);

$image_url = sprintf(
    'http://www.classicmoviehub.com/images/thumbs/%s.jpg',
    esc_attr($person['id'])
);

// Build the array to pass to social sharing function
$array_passed = [
    'summary' => $summary,
    'pinterest_description' => $pinterest_description,
    'title' => isset($prefix) ? esc_html($prefix) : 'Untitled',
    'images' => esc_url($image_url),
];

// Example function call for social menu (adjust parameters as needed)
// _social_menu($element_id = NULL, $array_passed = $array_passed, $show_title = true, $show_permlink = true, $css = '', $object_type = 'quote');
?>
