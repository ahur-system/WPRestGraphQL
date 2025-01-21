<?php namespace AhurSystem\Wordpress\Rest;
 
 
use AliKhaleghi\RestWP\Requirements\Gql\Queries;
class REST 
{
    public function getTest() {
        return new \WP_REST_Response('Howdy!!');
    }
    public function postTest() {
        return new \WP_REST_Response('Howdy!!');
    }
    /**
     * Get Posts may be paginated
     */
    public function getPosts() {

        // default location
        $location = 'primary_top_menu';

        switch (@$_GET['location']) {
            case 'sub_header_menu':
                    
                break; 
        }

        // Get the menu locations registered in the theme
        $locations = get_nav_menu_locations();

        // Check if the location exists
        if (!isset($locations[$location])) {
            return [];
        }

        // Get the menu ID for the given location
        $menu_id = $locations[$location];

        // Get the menu items for the menu
        $menu_items = wp_get_nav_menu_items($menu_id);
 

        return new \WP_REST_Response([
            'status' => 'success',
            'data' => $menu_items
        ], 200);
    }
    
    public function getPost() {

        // default location
        $location = 'primary_top_menu';

        switch (@$_GET['location']) {
            case 'sub_header_menu':
                    
                break; 
        }

        // Get the menu locations registered in the theme
        $locations = get_nav_menu_locations();

        // Check if the location exists
        if (!isset($locations[$location])) {
            return [];
        }

        // Get the menu ID for the given location
        $menu_id = $locations[$location];

        // Get the menu items for the menu
        $menu_items = wp_get_nav_menu_items($menu_id);
 

        return new \WP_REST_Response([
            'status' => 'success',
            'data' => $menu_items
        ], 200);
    }

    public function getMenu() {

        // default location
        $location = 'primary_top_menu';

        switch (@$_GET['location']) {
            case 'sub_header_menu':
                    
                break; 
        }

        $query = (new Queries)->request('PostBySlug');

        $data = do_graphql_request( $query ,'PostBySlug', [
            'slug'  => 'گزارش-محرمانه-وزارت-خارجه-آمریکا-به-کن'
        ]);

        return new \WP_REST_Response([
            'status' => 'success',
            // 'data' => $menu_items,
            'extra' => $data
        ], 200);
    }

    public function getFrontPage() {
        return new \WP_REST_Response('Howdy!!');
    }

    public function putFrontpage() {

    }

}
