<?php

namespace Domain\Suitability\Response;

class GeoapifyResponseTransformer
{
    public $address;

    /**
     * @param array $addressProps
     */

    //in an ideal world $addressProps would be something like a class of AddressParameters which bring clarity to house #, etc

    public function __construct(array $addressProps) {
        $this->address = $addressProps;
        return $this;
    }

    public function toArray(): array
    {
        return [
            "housenumber" => $this->address['housenumber'],
            "street" => $this->address['street'],
            "postcode" => $this->address['postcode'],
            "city" => $this->address['city'],
            "state" => $this->address['state'],
        ];
    }

}