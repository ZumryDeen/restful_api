<?php

namespace Tests\Unit;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Assert;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AddVehiclesTest
 * @package Tests\Unit
 */
class AddVehiclesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

use DatabaseTransactions;



    /**
     * Test Add vehicle
     */
   public function testaddVehicles(){

       // Adding the record and rollback after test using  DatabaseTransactions Triat

        factory(Vehicle::class)->create([
           'license_Plate' => "CAN333", // Creates Random license_Plate
           'make' => "Suzuki", // Creates make
           'model' => "Celerio",
           'year'=>'2015'

       ]);

       // Check Vehicle Exsit with  'license_Plate', 'CAN333'
       $allVehicleFromDb = Vehicle::where('license_Plate', 'CAN333')->first();

       $this->assertEquals('CAN333',$allVehicleFromDb->license_Plate);


    }

}
