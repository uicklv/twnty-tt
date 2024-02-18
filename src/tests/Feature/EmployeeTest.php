<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use WithFaker;
//    use RefreshDatabase;

    /**
     * Test get all employees
     * @return void
     */
    public function testGetEmployeesEndpoint()
    {
        // Auth user for call protected route (or get random)
        Sanctum::actingAs(User::all()->random());

        // Call endpoint
        $response = $this->get('/api/employees');

        // Assert
        $response->assertStatus(200);
    }

    /**
     * Test get one employee
     * @return void
     */
    public function testGetEmployeeEndpoint()
    {
        // Auth user for call protected route (or get random)
        Sanctum::actingAs(User::all()->random());

        // Create employee (or get random)
        $employee = Employee::factory()->create();

        // Call endpoint
        $response = $this->get('/api/employees/' . $employee->id);

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['data' =>
                ['id', 'name', 'age', 'email', 'salary', 'position', 'country', 'created_at', 'updated_at']]);
    }

    /**
     * Test storing an API employee.
     *
     * @return void
     */
    public function testStoreApiEmployee()
    {
        // Auth user for call protected route (or get random)
        Sanctum::actingAs(User::all()->random());

        // Generate new data for creating the employee
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make('secret'),
            'country_id' => Country::all()->random()->id,
            'position_id' => Position::all()->random()->id,
            'salary' => $this->faker->numberBetween(1000, 5000),
            'age' => $this->faker->numberBetween(18, 65)
        ];

        // Send a POST request to store the employee
        $response = $this->post('/api/employees', $userData);

        // Assert that the request was successful (status code 201)
        $response->assertStatus(201);

        // Assert that the user was stored in the database with the provided data
        $this->assertDatabaseHas('employees', [
            'email' => $userData['email']
        ]);
    }

    /**
     * Test updating an API employee.
     *
     * @return void
     */
    public function testUpdateApiUser()
    {
        // Auth user for call protected route (or get random)
        Sanctum::actingAs(User::all()->random());

        // Create employee
        $employee = Employee::factory()->create();

        // Generate new data for updating the user
        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'country_id' => Country::all()->random()->id,
            'position_id' => Position::all()->random()->id,
             'salary' => $this->faker->numberBetween(1000, 5000),
            'age' => $this->faker->numberBetween(18, 65)
        ];

        // Send a PUT request to update the employee
        $response = $this->put('/api/employees/' . $employee->id, $newData);

        // Assert that the request was successful (status code 200)
        $response->assertStatus(200);

        // Assert that the employee was updated with the new data
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'email' => $newData['email'],
            'name' => $newData['name'],
            'country_id' => $newData['country_id'],
            'position_id' => $newData['position_id'],
            'salary' => $newData['salary'],
            'age' => $newData['age'],
        ]);
    }

    /**
     * Test deleting an API employee.
     *
     * @return void
     */
    public function testDeleteApiUser()
    {
        // Auth user for call protected route (or get random)
        Sanctum::actingAs(User::all()->random());

        // Create employee
        $employee = Employee::factory()->create();

        // Send a DELETE request to delete the employee
        $response = $this->delete('/api/employees/' . $employee->id);

        // Assert that the request was successful (status code 204)
        $response->assertStatus(204);
    }
}
