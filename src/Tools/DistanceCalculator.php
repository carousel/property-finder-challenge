<?php

namespace Trip\Tools;

use GuzzleHttp\Client;

class DistanceCalculator
{
    /**
     * @var
     */
    public $cardboards;
    /**
     * @var array
     */
    public $pairs;
    /**
     * @var
     */
    public $names;

    public function __construct($cardboards)
    {
        $this->cardboards = $cardboards;
        $this->client = new Client;
        $this->pairs = [];
    }
        

    /**
     * @return mixed
     */
    public function names()
    {
        foreach ($this->cardboards as $key => $val) {
            $this->names[] = $val['city'];
        }
        return $this->names;
    }

    /**
     * @return array
     */
    public function unique()
    {
        $unique = [];
        foreach ($this->names() as $key => $val) {
            if ($key != $val) {
                $unique[$key] = $val;
            }
        }
        return $unique;
    }

    /**
     * @return array
     */
    function permute()
    {
        $combinations = array();
        $arr = $this->names();
        $words = count($arr);
        $combos = 1;
        for ($i = $words; $i > 0; $i--) {
            $combos *= $i;
        }
        while (count($combinations) < $combos) {
            shuffle($arr);
            $combo = implode(" ", $arr);
            if (!in_array($combo, $combinations)) {
                $combinations[] = $combo;
            }
        }
        return $combinations;

    }

    /**
     *
     */
    public function build()
    {

        $permuted = $this->permute();

        $temp = [];
        foreach ($permuted as $key => $val) {
            $temp[] = (explode(' ', $val));
        }
        foreach ($temp as $key => $val) {

            for ($i = 0; $i < count($val); $i++) {

                if ($i == count($val) - 1) {
                    echo ' END OF JOURNEY ' . "\n";
                }
                $a = $i;
                $b = $i + 1;
                if ($b < count($val)) {

                    //if needed distance can be calculated by using external api
//                    $response = $this->client->get('https://www.distance24.org/route.json?stops=' . $val[$a] . '|' . $val[$b]);
//                    $distance = json_decode($response->getBody()->getContents());

//                    if ($distance->distance != 0) {
                        foreach ($this->cardboards as $card) {
                            if ($card['city'] == $val[$a]) {
                                if ($card['transport'] == 'flight') {
                                    if ($card['baggage'] == true) {
                                        echo ' go to ' . $card['city'] . "  " . $card['port'] . " gate no. " . $card['gate'] . " leave your baggage, take  " . $card['transport'] . " to " . $val[$b];
                                    } else {
                                        echo ' go to ' . $card['city'] . "  " . $card['port'] . " gate no. " . $card['gate'] . " take  " . $card['transport'] . " to " . $val[$b];
                                    }
                                } else {
                                    echo ' go to ' . $card['city'] . " " . $card['port'] . "  " . " take  " . $card['transport'] . " to " . $val[$b];
                                }
//                            echo $val[$a] . " -> " . $distance->distance . " -> " . $val[$b] . " | ";

                            }

                        }

//                    }
                }
            }
        }
    }
}
