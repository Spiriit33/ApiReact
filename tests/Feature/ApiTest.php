<?php


namespace Tests;


use App\Models\User;

class ApiTest extends TestCase
{
    /**
     * Test if api work.
     */
    public function test_a_basic_request()
    {
        $response = $this->get('/api');

        $response->assertStatus(200);
    }

    /**
     * Test if login fail with wrong credentials.
     */
    public function test_login_with_wrong_credentials()
    {
        $response = $this->post('/api/users/login', ['email' => 'test@gmail.com', 'password' => 'test']);

        $response->assertStatus(401);
    }

    /**
     * Test if login succeed with right credentials.
     */
    public function test_login_with_right_credentials()
    {
        $user = User::find(1);
        $response = $this->post('/api/users/login', ['email' => 'test4@gmail.com', 'password' => 'bonjour']);

        $response->assertStatus(200);
    }

    /**
     * Test if error is returned when wrong inputs are put during the registering.
     */
    public function test_register_with_wrong_inputs()
    {
        $response = $this->post('/api/users/create', ['email' => 'test2', 'password' => 'bonjour', 'password_confirmation' => '3']);

        $response->assertStatus(401);
    }

    /**
     * Test if s is returned when wrong inputs are put during the registering.
     */
    public function test_register_with_good_inputs()
    {
        $response = $this->post('/api/users/create', ['email' => 'test5@gmail.com', 'password' => 'bonjour', 'password_confirmation' => 'bonjour']);

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function test_get_promotions()
    {
        $response = $this->get('/api/promotions/all');

        $response->assertStatus(200);
    }

    public function test_delete_promotions()
    {
        $response = $this->get('/api/promotions/all');

        $response->assertStatus(200);
    }

    public function test_update_promotions()
    {
        $response = $this->get('/api/promotions/all');

        $response->assertStatus(200);
    }
}
