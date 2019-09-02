<?php

namespace Tests\Feature;

use App\User;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JsonServerAPIStatusTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test Get All vehicle By Source and Identifier
     *
     * @return void
     */
    public function testJsonserverAPI()
    {

        $Guzzclient = new Client();
        $response = $Guzzclient->get('http://localhost:8652/vehicles');

        self::assertEquals('200',$response->getStatusCode());
    }
}
