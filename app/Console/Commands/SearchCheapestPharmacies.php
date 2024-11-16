<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SearchCheapestPharmacies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the cheapest 5 pharmacies for a given product ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productId = $this->argument('product_id');

        $product = Product::find($productId);
        if (!$product) {
            $this->error("Product with ID $productId not found.");
            return 1;
        }

        $cheapestPharmacies = DB::table('pharmacy_product')
            ->join('pharmacies', 'pharmacy_product.pharmacy_id', '=', 'pharmacies.id')
            ->where('pharmacy_product.product_id', $productId)
            ->orderBy('pharmacy_product.price', 'asc')
            ->select('pharmacies.id', 'pharmacies.name', 'pharmacy_product.price')
            ->take(5)
            ->get();

        if ($cheapestPharmacies->isEmpty()) {
            $this->info("No pharmacies found for product with ID $productId.");
            return 0;
        }

        $this->info($cheapestPharmacies->toJson(JSON_PRETTY_PRINT));

        return 0;
    }
}
