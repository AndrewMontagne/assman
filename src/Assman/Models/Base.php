<?php
/**
 * Project: assman
 * Created: 08/06/2017
 * Copyright 2017 Andrew O'Rourke
 */

namespace Assman\Models;

abstract class Base extends \Model implements \JsonSerializable
{
    public static function db() {
        return \Model::factory(get_called_class(), null);
    }

    public function fromArray($array) {
        $this->hydrate($array);
        return $this;
    }

    public function fromJson($json) {
        $this->hydrate(json_decode($json, true));
        return $this;
    }

    public function jsonSerialize()
    {
        return self::toArray();
    }

    public function toJson() {
        return json_encode($this->orm->as_array());
    }

    public function toArray() {
        return $this->orm->as_array();
    }
}