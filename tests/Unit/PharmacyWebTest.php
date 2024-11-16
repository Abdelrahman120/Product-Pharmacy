<?php

namespace Tests\Unit;

use App\Models\Pharmacy;
use PHPUnit\Framework\TestCase;

class PharmacyWebTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_web_can_view_all_pharmacies()
    {
        Pharmacy::factory()->count(10)->create();

        $response = $this->get('/pharmacies');

        $response->assertStatus(200)
            ->assertViewIs('pharmacies.index')
            ->assertViewHas('pharmacies');
    }
    public function test_web_can_view_a_single_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->get("/pharmacies/{$pharmacy->id}");

        $response->assertStatus(200)
            ->assertViewIs('pharmacies.show')
            ->assertViewHas('pharmacy', $pharmacy);
    }
    public function test_web_can_update_a_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $data = ['name' => 'Updated Pharmacy'];

        $response = $this->put("/pharmacies/{$pharmacy->id}", $data);

        $response->assertRedirect("/pharmacies/{$pharmacy->id}");
        $this->assertDatabaseHas('pharmacies', $data);
    }
    public function test_web_can_delete_a_pharmacy()
    {
        $pharmacy = Pharmacy::factory()->create();

        $response = $this->delete("/pharmacies/{$pharmacy->id}");

        $response->assertRedirect('/pharmacies');
        $this->assertDatabaseMissing('pharmacies', ['id' => $pharmacy->id]);
    }
}
