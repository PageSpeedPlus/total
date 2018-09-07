<?php
/**
 * Admin (include 'functions/admin.php';)
 * ----------------------------------------------------------
 * * Entfernen aller Dashboard-Widgets
 * * Anzahl Anhänge pro Post anzeigen
 * * Medienbibliothek mit Spalte für die Medien-ID
 * * Post & Page ID anzeigen
 * * 
 * * 
 * ----------------------------------------------------------
 */ 
 

/**
 * Entfernen aller Dashboard-Widgets
 */
function ah_remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
 
} 
add_action('wp_dashboard_setup', 'ah_remove_dashboard_widgets' );


/**
 * Anzahl Anhänge pro Post anzeigen
 *
 * Manchmal haben Sie einen Beitrag mit mehreren Anhängen und es wäre nett, eine Zählung der gesamten Medien zu sehen, die an einen Beitrag angehängt sind. Wenn Sie dieses Snippet zur functions.php Ihres Wordpress-Themes hinzufügen, wird die Anzahl der Post-Anhänge in einer benutzerdefinierten Admin-Spalte angezeigt.
 * 
 * @link http://wpsnipp.com/index.php/functions-php/display-post-attachment-count-in-admin-column/
 */
add_filter('manage_posts_columns', 'posts_columns_attachment_count', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns_attachment_count', 5, 2);
function posts_columns_attachment_count($defaults){
    $defaults['wps_post_attachments'] = __('Attached');
    return $defaults;
}
function posts_custom_columns_attachment_count($column_name, $id){
        if($column_name === 'wps_post_attachments'){
        $attachments = get_children(array('post_parent'=>$id));
        $count = count($attachments);
        if($count !=0){echo $count;}
    }
}


/**
 * Medienbibliothek mit Spalte für die Medien-ID
 *
 * Wenn Sie dieses Snippet zur functions.php Ihres Wordpress-Themes hinzufügen, wird eine neue Spalte in der Medienbibliothek mit der Anhangs-ID hinzugefügt.
 * 
 * @link http://wpsnipp.com/index.php/functions-php/add-new-column-with-media-id-to-media-library/
 */
function column_id($columns) {
    $columns['colID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'column_id' );
function column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'column_id_row', 10, 2 );


/**
 * Post & Page ID anzeigen
 */
add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}



?>