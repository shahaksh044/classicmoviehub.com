<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$death_date = get_query_var('death_date');
$deaths = $wpdb->get_results($wpdb->prepare("
    SELECT name, u_name, DATE_FORMAT(died, '%%b %%e, %%Y') AS _died, death_city, death_state
    FROM agatti_people
    WHERE died LIKE %s
      AND active = 1
", $death_date . '%'), ARRAY_A);

if (!$deaths) {
    echo '<h2>No records found for the specified date.</h2>';
    return;
}

echo '<h2>Deaths for ' . esc_html($death_date) . '</h2>';
foreach ($deaths as $death) {
    $name = esc_html($death['name']);
    $died = esc_html($death['_died']);
    $deathplace = esc_html(trim($death['death_city'] . ', ' . $death['death_state'], ', '));

    echo "<div>
        <strong>{$name}</strong>
        <p>Died on: {$died}</p>
        <p>Place: {$deathplace}</p>
    </div>";
}
