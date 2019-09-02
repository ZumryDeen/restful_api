<?php

namespace Tests\Unit;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ApiTest
 * @package Tests\Unit
 */
class ApiTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Test JWT Auth from on Access GetAllVehicle
     *
     * @return void
     */
    public function testJWTAuthGetAllVehicle()
    {
        $response = $this->json('GET','/api/getallVehicles');
        $response
            ->assertStatus(401);
         /*   ->assertJson([
                'created' => false,
            ]);*/

    }


    /**
     * Test Get All vehicle with
     *
     * @return void
     */
    public function testGetAllVehicleWithJWT()
    {

        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'test'),
        ]);

        $token = array(
            "iss" => "http://fixico.com",
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        );



        $jwt = JWT::encode($token,env('JWT_SECRET'));
        $response = $this->json('GET','/api/getallVehicles?token='.$jwt);
        $response
            ->assertStatus(200);
        /*   ->assertJson([
               'created' => false,
           ]);*/

    }




}
