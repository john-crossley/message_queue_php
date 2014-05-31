<?php

namespace Banshee;

class Message {

    private $key = '';
    private $data = [];

    public function __construct($key, array $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function dump()
    {
        return $this->data;
    }

}