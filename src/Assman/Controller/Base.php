<?php
/**
 * Project: assman
 * Created: 08/06/2017
 * Copyright 2017 Andrew O'Rourke
 */

namespace Assman\Controller;

abstract class Base
{
    public static function route($pattern, $function) {
        \Flight::route($pattern, [get_called_class(), $function]);
    }
    public abstract static function hookIn();
}