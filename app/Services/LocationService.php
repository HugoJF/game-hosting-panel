<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:09 AM
 */

namespace App\Services;

use App\Node;
use App\Location;
use HCGCloud\Pterodactyl\Pterodactyl;

class LocationService
{
    /**
     * Wraps firstOrNew in order to better control which parameters are used to first the existing model.
     *
     * @param int   $id
     * @param array $data
     *
     * @return Location
     */
    public function firstOrCreate(int $id, array $data)
    {
        return Location::firstOrCreate(compact('id'), $data);
    }
}
