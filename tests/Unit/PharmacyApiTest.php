<?php

namespace Tests\Unit;

use App\Models\Pharmacy;
use PHPUnit\Framework\TestCase;

class PharmacyApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_api_can_retrieve_all_pharmacies()
    {
        Pharmacy::factory()->count(10)->create();

        $response = $this->getJson('/api/pharmacies');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'data' => [
                        '*' => ['id', 'name', 'address', 'created_at', 'updated_at']
                    ]
                ],
                'message',
            ]);
    }
    public function test_api_can_retrieve_a_single_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->getJson("/api/pharmacies/{$pharmacy->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => ['id', 'name', 'address', 'created_at', 'updated_at'],
                'message',
            ]);
    }
    public function test_api_can_create_a_pharmacy()
    {
        $data = [
            'name' => 'Test Pharmacy',
            'address' => '123 Main Street',
        ];

        $response = $this->postJson('/api/pharmacies', $data);

        $response->assertStatus(201)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('pharmacies', $data);
    }
    public function test_api_can_update_a_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $data = ['name' => 'Updated Pharmacy'];

        $response = $this->putJson("/api/pharmacies/{$pharmacy->id}", $data);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('pharmacies', $data);
    }
    public function test_api_can_delete_a_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->deleteJson("/api/pharmacies/{$pharmacy->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('pharmacies', ['id' => $pharmacy->id]);
    }
}
