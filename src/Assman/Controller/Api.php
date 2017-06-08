<?php
/**
 * Project: assman
 * Created: 08/06/2017
 * Copyright 2017 Andrew O'Rourke
 */

namespace Assman\Controller;

use Assman\Models\Asset;
use \Flight;

class Api extends Base
{
    public static function hookIn() {
        static::route('GET /api/assets', 'listAssets');
    }

    public static function listAssets() {
        Flight::json(Asset::db()->findMany(), 200);
    }
}