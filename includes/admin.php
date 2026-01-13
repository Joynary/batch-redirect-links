<?php
// Ajax handler for fetching site info
add_action('wp_ajax_guide_fetch_site_info', function() {
    require_once __DIR__ . '/fetcher.php';
    $url = esc_url_raw($_POST['url']);
    $info = guide_fetch_site_info($url);
    wp_send_json($info);
});

// Ajax handler for batch import (CSV/links)
add_action('wp_ajax_guide_batch_import', function() {
    require_once __DIR__ . '/fetcher.php';
    $urls = isset($_POST['urls']) ? (array)$_POST['urls'] : [];
    $results = [];
    foreach ($urls as $url) {
        $results[] = guide_fetch_site_info($url);
    }
    wp_send_json($results);
}); 