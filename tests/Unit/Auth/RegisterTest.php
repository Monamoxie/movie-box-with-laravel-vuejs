<?php

namespace Tests\Unit;
use Tests\TestCase;   
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{  
    protected function setUp(): void
    {
        parent::setup(); 
    }
 
    /**
     * @test
    */
    public function fail_if_missing_required_details()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('POST', '/api/v1/register', [ 
            'middle_name' => $this->faker->firstName(),
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
    */
    public function fail_if_one_of_inputs_not_correct_type()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('POST', '/api/v1/register', [ 
            'name' => $this->faker->numberBetween(1, 344), 
            'email' => $this->faker->bankAccountNumber, 
            'password' => $this->faker->creditCardExpirationDateString,
        ]);
        $response->assertStatus(422); 
    }
    
 

    /**
     * @test
    */
    public function pass_if_required_inputs_are_provided_and_correct()
    { 
        $email = $this->faker->email; 
        $password = Hash::make($this->faker->password);
 
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->json('POST', '/api/v1/register', [
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName,
            'password' => $password,
            'password_confirmation' => $password,
            'email' => $email  
        ]);
       
        $response
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);

    }

}
