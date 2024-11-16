<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductWebTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testWebCanViewAllProducts()
{
    Product::factory()->count(10)->create();

    $response = $this->get('/products');

    $response->assertStatus(200)
             ->assertViewIs('products.index')
             ->assertViewHas('products');
}
public function testWebCanViewSingleProduct()
{
    $product = Product::factory()->create();

    $response = $this->get("/products/{$product->id}");

    $response->assertStatus(200)
             ->assertViewIs('products.show')
             ->assertViewHas('product', $product);
}
public function testWebCanStoreProduct()
{
    Storage::fake('public');

    $file = UploadedFile::fake()->image('product.jpg');

    $response = $this->post('/products', [
        'title' => 'Web Test Product',
        'description' => 'Description for the web test',
        'price' => 100,
        'quantity' => 20,
        'image' => $file,
    ]);

    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', ['title' => 'Web Test Product']);

    Storage::disk('public')->assertExists('/products' . $file->hashName());
}
public function testWebCanUpdateProduct()
{
    $product = Product::factory()->create();

    $response = $this->put("/products/{$product->id}", [
        'title' => 'Updated Title for Web',
    ]);

    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', ['title' => 'Updated Title for Web']);
}
public function testWebCanDeleteProduct()
{
    $product = Product::factory()->create();

    $response = $this->delete("/products/{$product->id}");

    $response->assertRedirect('/products');
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
}

}
