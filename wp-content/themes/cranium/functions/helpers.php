<?php

/**
 * Prints a preformatted display of the passed in variable for debugging purposes.
 *
 * @param mixed $var the array or object to display
 * @param boolean $exit whether or not to immediately exit the script
 * @return void
 */
function debug($var, $exit = false) {
    if (!WP_DEBUG) return;
    echo '<pre class="debug">'.print_r($var, true).'</pre>';
    if ($exit) exit;
}

/**
 * Convenience function for generating urls to a given theme file.
 *
 * @param string $path path to the file
 * @uses get_bloginfo()
 * @return string returns the generated url
 */
function url_to($path) {
    return get_template_directory_uri().'/'.ltrim($path, '/');
}

/**
 * Convert comma separated values to an array.
 *
 * @param string $str string to be converted
 * @param string $regex optional regex to split on
 * @return array
 */
function to_array($str, $reqex = ',') {
    $values = preg_split('/'.$reqex.'/', $str, -1, PREG_SPLIT_NO_EMPTY);
    $values = array_map('trim', $values);
    return $values;
}

function custom_post_type_labels($singular, $plural = null, $labels = array()) {

    if(!$plural) $plural = $singular.'s';

    return array_merge([
        'name'                       => $plural,
        'singular_name'              => $singular,
        'menu_name'                  => $plural,
        'name_admin_bar'             => $singular,
        'all_items'                  => 'All '.$plural,
        'add_new'                    => 'Add New',
        'add_new_item'               => 'Add New',
        'edit_item'                  => 'Edit '.$singular,
        'new_item'                   => 'New '.$singular,
        'view_item'                  => 'View '.$singular,
        'search_items'               => 'Search '.$plural,
        'not_found'                  => 'No '.$plural.' found',
        'not_found_in_trash'         => 'No '.$plural.' found in Trash',
        'parent_item_colon'          => 'Parent '.$plural.':'
    ], $labels);
}

function custom_taxonomy_labels($singular, $plural = null, $labels = array()) {

    if(!$plural) $plural = $singular.'s';

    return array_merge([
        'name'                       => $plural,
        'singular_name'              => $singular,
        'menu_name'                  => $plural,
        'all_items'                  => 'All '.$plural,
        'edit_item'                  => 'Edit '.$singular,
        'view_item'                  => 'View '.$singular,
        'update_item'                => 'Update '.$singular,
        'add_new_item'               => 'Add New '.$singular,
        'new_item_name'              => 'New '.$singular,
        'parent_item'                => 'Parent '.$singular,
        'parent_item_colon'          => 'Parent '.$singular.':',
        'search_items'               => 'Search '.$plural,
        'popular_items'              => 'Popular '.$plural,
        'separate_items_with_commas' => 'Separate '.strtolower($plural).' with commas',
        'add_or_remove_items'        => 'Add or remove '.strtolower($plural),
        'choose_from_most_used'      => 'Choose from the most used '.strtolower($plural),
        'not_found'                  => 'No '.$plural.' found'
    ], $labels);
}