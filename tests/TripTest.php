<?php

use Trip\Tools\DistanceCalculator;
use Trip\Trip;

class TripTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->data =  [
            'cities' => [
                'Paris',
                'Moscow',
                'Amsterdam',
            ],
            'transport' => ['bus', 'train'],
            'ports' => ['bus-station', 'train-station'],
            'baggage' => [true, false],
            'limit' => 3,
        ];
    }
        
    /**
     * @test
     */
    public function distanceCalculatorHasNoCardboards()
    {
        $dc = new DistanceCalculator([]);
        $this->assertEquals(0, count($dc->cardboards));
    }
    /**
     * @test
     */
    public function distanceCalculatorHasCardboards()
    {
        $dc = new DistanceCalculator($this->data);
        $this->assertEquals(5, count($dc->cardboards));
    }
        
}
