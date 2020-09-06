<?php

namespace Tests\Environments\Factories;

use App\Location;

class LocationFactory extends Factory
{
    protected Location $location;

    public function model(): Location
    {
        return $this->location;
    }

    public function build()
    {
        return ($this->location = factory(Location::class)->create($this->parameters));
    }
}
