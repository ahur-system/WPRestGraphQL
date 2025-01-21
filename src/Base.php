<?php namespace AhurSystem\Wordpress\RESTGraphQL;

require_once "GraphQL/Fragments.php";
require_once "GraphQL/Queries.php";
require_once "Rest/REST.php";

use \AhurSystem\Wordpress\RESTGraphQL\GraphQL\Fragments;
use \AhurSystem\Wordpress\RESTGraphQL\GraphQL\Queries;

class Base {
    private $fragments = [];

    function __construct() {
        
    }
    public function request($query, $args = []) {
        
        $data = (new Queries)->prepare($query);
        
        return do_graphql_request($data, $query, $args );
    }
    
}