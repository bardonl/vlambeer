<?php


class Giantbombresource
{
    public $api_key;
    public $base_url;
    public $format;
    public $resources;
    public $query;
    public $id;

    function __construct($id, $resources) {
        $this->id = $id;
        $this->resources = $resources;
        $this->api_key = "add81bdfab4b705d9d96a2fab29394a440b919b7";
       
        //$this->search_url = "https://www.giantbomb.com/api/game/$this->id/?api_key=$this->api_key";
        $this->search_url = "https://www.giantbomb.com/api/$this->resources/$this->id/?api_key=$this->api_key";
        
    }
    
    public function searchall(){
        $url = $this->search_url;
        return $this->request( $url );
    }

    public function request( $url ) {
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' );

        $output = curl_exec($ch);

        // handle error; error output
        if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

            var_dump(curl_error( $ch ));
        }

        curl_close($ch);
    
        $output = simplexml_load_string($output, 'SimpleXMLElement', LIBXML_NOCDATA);
        
        return($output);
    }
}


