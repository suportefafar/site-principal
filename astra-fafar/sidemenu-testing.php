
<!--
    TÍTULO DO MENU NA SIDEBAR
-->

<div class="d-flex justify-content-between align-items-center mb-4 container-title-sidemenu">
    <h5 class="title-sidemenu">ACESSO RÁPIDO</h5>
    <img
        src="https://www.farmacia.ufmg.br/wp-content/uploads/2023/12/icon.png"
        alt="Ícone Acesso Rápido"
    />
</div>

<?php

$cat = get_the_category();

$menu = get_field('menu_cat', $cat[0]);

print_r($cat[0]);

if( !isset($menu) ) {
    print_r("Tentando outro jeito... <br/>");

    $post_data = get_queried_object();

    $author_id = $post_data->post_author;

    $author_nickname = get_the_author_meta("nickname", $author_id);
    $author_meta = get_the_author_meta("user_nicename", $author_id);

    //$categorias = get_categories($author_nickname);

    print_r("author_nickname: $author_nickname <br/>");
    print_r("author_meta: $author_meta <br/>");
    print_r("<br/>");

    $menu = wp_get_nav_menu_object($author_nickname);
}
print_r("<br/>--------------------<br/>");
print_r(get_nav_menu_locations());
$menuu = get_registered_nav_menus();
print_r("<br/>--------------------<br/>");


// Get all registered menu locations and their associated menu IDs.
$menu_locations = get_nav_menu_locations();

// Replace 'secondary' with the name or slug of your secondary menu location.
$secondary_menu_location = 'secondary_menu';

// Check if the secondary menu location is set.
if (isset($menu_locations[$secondary_menu_location])) {
    // Retrieve the menu ID for the secondary menu.
    $secondary_menu_id = $menu_locations[$secondary_menu_location];
    print_r($menu_locations[$secondary_menu_location]);

    // Output or use the secondary menu ID as needed.
    echo 'Secondary Menu ID: ' . $secondary_menu_id;

    $menu = wp_get_nav_menu_object($secondary_menu_id);
} else {
    echo 'Secondary Menu not found.';
}



// Renderizando o sidemenu com Walker próprio
wp_nav_menu(array(
    'menu'            => $menu,
    'depth'           => 2,
    'menu_class'      => 'm-0 list-group rounded-0',
    'item_classes'    => array( 'list-group-item','list-group-item-action','rounded-0','fafar-side-menu-item', 'd-flex', 'align-items-center' ),
    'walker'          => new FAFAR_Menu_Walker(),
));

