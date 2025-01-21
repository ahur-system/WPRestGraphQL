<?php namespace AhurSystem\Wordpress\RESTGraphQL\GraphQL;

class Fragments
{
    public $fragments = [];
     
    function __construct() {
        
        $this->boot();
    }

    public function getFragment($fragment) {
        return @$this->fragments[$fragment];
    }

    private function boot() {


        foreach(glob(dirname(__FILE__).'/Fragments/*') as $fragment)   
        {  
            $this->fragments[explode(".",basename($fragment))[0]] = file_get_contents($fragment);
        }
    }
}