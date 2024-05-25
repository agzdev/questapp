<?php

namespace Tests\Feature;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends TestCase
{
    public function test_register_new_user()
    {
        $userData = [
            'full_name' => 'Agustin Taverna',
            'username' => 'aguzzok',
            'email' => 'aguzz.info@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'avatar' => 'cargaravatar'
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'full_name',
                'username',
                'email',
                'status'
            ]
        ])->assertJson([
            'message' => 'User registered successfully.',
            'data' => [
                'id' => 1,
                'full_name' => 'Agustin Taverna',
                'username' => 'aguzzok',
                'email' => 'aguzz.info@gmail.com',
            ]
        ]);
    }
}
