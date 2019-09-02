<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LoginTest
 * @package Tests\Feature
 */
class LoginTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * Auth Test
     *
     * @return void
     */
    public function test_Unauthenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');

    }


    /**
     *  Login test
     */
    public function testUserLogin()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'test'),
        ]);


        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);


    }



}
