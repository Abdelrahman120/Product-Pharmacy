<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testApiCanRetrieveAllProducts()
{
    // Seed database with test products
    Product::factory()->count(10)->create();

    // Send GET request to API endpoint
    $response = $this->getJson('/api/products');

    // Assert response structure and success
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'success',
                 'message',
                 'data' => [
                     'data' => [
                         '*' => [
                             'id',
                             'title',
                             'description',
                             'price',
                             'quantity',
                             'image',
                         ],
                     ],
                 ],
             ]);
}
public function testApiCanCreateProduct()
{
    Storage::fake('public');

    $file = UploadedFile::fake()->image('product.jpg');

    $response = $this->postJson('/api/products', [
        'title' => 'Test Product',
        'description' => 'A great product',
        'price' => 50,
        'quantity' => 5,
        'image' => $file,
    ]);

    $response->assertStatus(201)
             ->assertJson([
                 'success' => true,
                 'message' => 'Product created successfully',
             ]);

    // Check if the file exists in storage
    Storage::disk('public')->assertExists('products/' . $file->hashName());
}
public function testApiCanUpdateProduct()
{
    $product = Product::factory()->create();

    $response = $this->putJson("/api/products/{$product->id}", [
        'title' => 'Updated Product Title',
        'price' => 75,
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'success' => true,
                 'message' => 'Product updated successfully',
             ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'title' => 'Updated Product Title',
        'price' => 75,
    ]);
}
public function testApiCanDeleteProduct()
{
    $product = Product::factory()->create();

    $response = $this->deleteJson("/api/products/{$product->id}");

    $response->assertStatus(200)
             ->assertJson([
                 'success' => true,
                 'message' => 'Product deleted successfully',
             ]);

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
}


}
