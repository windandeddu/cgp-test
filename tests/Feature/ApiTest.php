<?php

namespace Tests\Feature;


use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Tests\TestCase;

class ApiTest extends TestCase
{
    protected User $user;
    protected NewAccessToken $token;
    protected Company $company;
    protected Client $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->user=User::factory()->create();
        $this->token=$this->user->createToken('test_token');
        $this->company=Company::first();
        $this->client=Client::first();
    }

    public function tearDown(): void
    {
        $this->user->tokens()->delete();
        $this->user->delete();
        parent::tearDown();
    }


    public function test_api_auth_with_valid_token()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token->plainTextToken)
            ->json('get', '/api/companies');
        $response->assertStatus(200);
    }

    public function test_api_auth_with_invalid_token()
    {
        $response = $this->withHeader('Authorization', 'Bearer invalid_token')
            ->json('get', '/api/companies');
        $response->assertStatus(401);
    }

    public function test_companies_not_empty(){
        $this->actingAs($this->user);
        $response=$this->json('get', '/api/companies');
        $response->assertStatus(200);
        $data=$response->decodeResponseJson();
        $this->assertNotEmpty($data['data']);
    }

    public function test_clients_not_empty(){
        $this->actingAs($this->user);
        $response=$this->json('get', '/api/clients/'.$this->company->id);
        $response->assertStatus(200);
        $data=$response->decodeResponseJson();
        $this->assertNotEmpty($data['data']);
    }

    public function test_client_companies_not_empty(){
        $this->actingAs($this->user);
        $response=$this->json('get', '/api/client_companies/'.$this->client->id);
        $response->assertStatus(200);
        $data=$response->decodeResponseJson();
        $this->assertNotEmpty($data['data']);
    }
}
