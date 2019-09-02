<?php

namespace Tests\Feature;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetVehileBysourcIdendtifierTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test Get All vehicle By Source and Identifier
     *
     * @return void
     */
    public function testGetAllVehicleBySourceandIdentifierWithJWT()
    {
        $this->withoutExceptionHandling();
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

        $response = $this->json('GET','/api/getvehicles/csv/86XLB4?token='.$jwt);
      //  $response = $this->json('GET','/api/getallVehicles?token='.$jwt);

        $response
            ->assertStatus(200);
        /*   ->assertJson([
               'created' => false,
           ]);*/

    }
}
