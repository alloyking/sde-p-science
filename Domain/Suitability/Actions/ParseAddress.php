<?php


namespace Domain\Suitability\Actions;

use \Domain\Suitability\Exceptions\InvalidGeoapifyStructure;
use \Domain\Suitability\Exceptions\InvalidGeoapifyResponse;
use \Domain\Suitability\Response\GeoapifyResponseTransformer;

class ParseAddress
{

    const API_TOKEN = "39d5d71be8e2432f874d01ad4991ee76";
    const API_ADDRESS = 'https://api.geoapify.com/v1/geocode/search';

    private $response;

    public function __construct($address)
    {

        $results = $this->makeRequest($address);

        $hasValidAddress = false;
        //an address search may result in multiple address, we take the first address that returns a valid street name
        $feature = current($results['features']);

        if($this->hasStreetName($feature)){
            $this->response = $this->buildResponse($feature['properties']);
            $hasValidAddress = true;
        }


        if(!$hasValidAddress){
            //for the sake of this test example we will always give you a parsed address
            //even if the address is "not real".  This will have side effects; mainly:
            //1. 123 fake street
            //2. 123 fake st.
            //Both will return but the results for SS score will vary as we have st or street (destination street name is even/odd rules)
            $this->response = $this->buildResponse($results['query']['parsed']);

        }

       return $this;
    }

    public function getParsed() : array
    {
        return $this->response;
    }

    private function makeRequest(string $address) : array
    {
        $url = self::API_ADDRESS.'?text='.urlencode($address).'&apiKey='.self::API_TOKEN;
        $content = file_get_contents($url);

        if ($content === FALSE) {
            //in an absolute perfect implementation I would catch all the possible api errors and throw nice error messages
            //file_get_contents is not recommended for this.  I should really use guzzle or something along those lines and would kick myself later for not doing so
            throw new InvalidGeoapifyResponse();
        }

        $content =  json_decode($content,1);

        if (!array_key_exists('features', $content)) {
            throw new InvalidGeoapifyStructure();
        }

        if (!array_key_exists('query', $content)) {
            throw new InvalidGeoapifyStructure();
        }

        if (!array_key_exists('parsed', $content['query'])) {
            throw new InvalidGeoapifyStructure();
        }

        return $content;
    }

    private function hasStreetName(array $feature) : bool
    {
        if(array_key_exists('properties', $feature)){
            if(array_key_exists('street', $feature['properties'])) {
                return true;
            }
        }
        return false;
    }

    private function buildResponse(array $addressProps) : array
    {
        $response = new GeoapifyResponseTransformer($addressProps);
        return $response->toArray();
    }
}