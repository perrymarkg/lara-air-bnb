<?php

namespace Tests\Unit;

use PHPUnit\Framework\Constraint\IsType;

use Tests\TestCase;
use App\Models\Property;
use App\Models\Country;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PropertyTest extends TestCase
{
    public function testPropertiesShouldHaveCountry()
    {
        $properties = Property::where('country_id', 0)->get();
        $this->assertEquals(0, $properties->count());
    }
}
