<section <?php echo isset($breadc_if_active) ? $breadc_if_active : '';?>>
<?php
// Define the mapping of breadcrumbs for different pages
$breadcrumbs = array(
    'index' => array('<i class="fa-solid fa-house"></i>' => 'index.php', 'Home' => '#'),
    'read' => array('<i class="fa-solid fa-house"></i>' => 'index.php', $title_parent => '', $title_h1 => '#'),
    'view' => array('<i class="fa-solid fa-house"></i>' => 'index.php', $title_parent => '', $title_h1 => '#'),
    'create' => array('<i class="fa-solid fa-house"></i>' => 'index.php', $title_parent => '', $title_h1 => "index.php?page=read&txn=$txn", 'Create Record' => '#'),
    'update' => array('<i class="fa-solid fa-house"></i>' => 'index.php', $title_parent => '', $title_h1 => "index.php?page=read&txn=$txn", 'Update Record' => '#'),
    // Add other pages as needed
);

// Get the current page from the query string
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'index';

// Check if the current page has breadcrumbs defined
if (isset($breadcrumbs[$currentPage])) {
    echo '<nav aria-label="breadcrumb">';
    echo '<ol class="breadcrumb">';

    // Generate breadcrumb links
    foreach ($breadcrumbs[$currentPage] as $label => $url) {
        if ($label === $title_parent) {
            // If it's the title_parent, display it as plain text (non-link) and add a slash
            echo "<li class='breadcrumb-item'>$label &nbsp; /</li>";
        } elseif ($url === '#') {
            // For the last item in the breadcrumbs (current page), display it as active
            echo "<li class='breadcrumb-item active' aria-current='page'>$label</li>";
        } else {
            // For other items, display as a link
            echo "<li class='breadcrumb-item'><a href='$url'>$label</a> &nbsp; / </li>";
        }
    }

    echo '</ol>';
    echo '</nav>';
}
?>

</section>
