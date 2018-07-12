<?php

namespace Trip\Tools;


/**
 * Class Randomizer
 * @package Trip\Tools
 */
class Randomizer
{
    /**
     * @var array
     */
    public $cities = [];

    /**
     * @var array
     */
    public $choosen = [];
    /**
     * @var array
     */
    public $names = [];
    /**
     * @var
     */
    public $seat;
    /**
     * @var
     */
    public $transport;
    /**
     * @var
     */
    public $ports;
    /**
     * @var
     */
    public $gates;
    /**
     * @var
     */
    public $baggage;
    /**
     * @var
     */
    public $limit;

    public function __construct($data)
    {
        $this->cities = $data['cities'];
        $this->seat = $data['seat'];
        $this->ports = $data['ports'];
        $this->gates = $data['gates'];
        $this->baggage = $data['baggage'];
        $this->transport = $data['transport'];
        $this->limit = $data['limit'];
        $this->overseas = $data['overseas'];
    }

    /**
     * @return $this
     */
    public function cities()
    {
        $ids = array_rand($this->cities, $this->limit);
        foreach ($ids as $id) {
            $this->choosen[] = [
                'city' => $this->cities[$id],
                'transport' => "",
                'port' => "",
                'gate' => "",
                'baggage' => ""
            ];
        };
        return $this;
    }

    /**
     * @return array
     */
    public function names()
    {
        foreach ($this->choosen as $key => $val) {
            $this->names[] = $val['city'];
        }
        return $this->names;
    }

    /**
     * @return $this
     */
    public function notOverseas()
    {
        foreach ($this->choosen as $key => $val) {
            if (!in_array($val['city'], $this->overseas)) {
                $tr = $this->transport[rand(0, count($this->transport) - 1)];
                $this->choosen[$key]['transport'] = $tr;
                $this->choosen[$key]['gate'] = "//";
                $this->choosen[$key]['port'] = $tr . '-station';
            }
        };
        return $this;
    }

    /**
     * @return $this
     */
    public function overseas()
    {
        foreach ($this->choosen as $key => $val) {
            if ($val['transport'] == "") {
                $this->choosen[$key]['transport'] = 'flight';
                $this->choosen[$key]['port'] = 'airport';
            }
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function gate()
    {
        $gate = rand(0, count($this->gates) - 1);
        foreach ($this->choosen as $key => $val) {
            if ($val['transport'] == "flight") {
                $this->choosen[$key]['gate'] = $this->gates[$gate];
                $this->choosen[$key]['port'] = 'airport';
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function baggage()
    {
        foreach ($this->choosen as $key => $val) {
            $this->choosen[$key]['baggage'] = rand(true, false);
        }
        return $this->choosen;
    }
}
