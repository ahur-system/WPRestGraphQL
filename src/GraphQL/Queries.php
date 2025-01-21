<?php namespace AhurSystem\Wordpress\RESTGraphQL\GraphQL;
 

class Queries
{
    private $queries = [];

    function __construct() {
        $this->boot();
    }

    public function prepare($query, $args = []) {
        
        $data = $this->importFragments($this->queries[$query]);
        
        return $data;
    }

    private function importFragments($input) {
        $fragmentsObject = new Fragments;

        // Use a regex to match words starting with three dots
        preg_match_all('/\.\.\.(\w+)/', $input, $matches);
        $extendedFragments = $matches[1];
        $out = $input;
        $imported = [];

        foreach ($extendedFragments as $key => $value) {
            if(in_array($value, $imported)) continue;
            if(!$fragmentsObject->getFragment($value)) throw new \Exception("Fragment `$value` missing, operation failed.", 1);

            $frag = $this->importFragments($fragmentsObject->getFragment($value));
            $out =  $out     . ' ' . $frag;
            $imported[] = $value;
            
        }
        return $out;
    }


    private function boot() {
        
        foreach(glob(dirname(__FILE__).'/Queries/*') as $query)   
        {  
            $this->queries[explode(".",basename($query))[0]] = file_get_contents($query);
        }
    }

}
