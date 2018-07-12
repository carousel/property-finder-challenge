<?php

namespace Trip;

use Trip\TripId;
use Trip\Tools\Randomizer;
use Trip\Tools\DistanceCalculator;


class Trip
{
    /**
     * @var \Trip\TripId
     */
    public $id;
    /**
     * @var array
     */
    public $cardboards = [];
    public $fixedSet = [];

    /**
     *
     */
    public function __construct(array $data = null)
    {
        $this->randomizer = new Randomizer($data);

        $this->id = TripId::generate();
    }
    public function fixedSet($data)
    {
        $this->fixedSet = $data;
    }
        
    /**
     *
     */
    public function init()
    {
        if(!empty($this->fixedSet)){
            $this->distanceCalculator = new DistanceCalculator($this->fixedSet);
        }else{
            $this->cardboards = $this->randomizer->cities()
            ->notOverseas()
            ->overseas()
            ->gate()
            ->baggage();
           $this->distanceCalculator = new DistanceCalculator($this->cardboards);
        }
    }

    /**
     *
     */
    public function output()
    {
        echo 'TRIP ID' . $this->id . "\n";
        $this->distanceCalculator->build();
    }

}
