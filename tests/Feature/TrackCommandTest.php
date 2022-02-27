<?php

namespace Tests\Feature;

use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;
use Http;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;


    function test_in_tracks_product_stock()
    {

        $this->seed(RetailerWithProductSeeder::class);

        $this->assertFalse(Product::first()->inStock());


        Http::fake(fn() => ['available' => true, 'price' => 29900]);

        // When Trigger the php artisan track command
        //And assuming the stock is available now
        $this->artisan('track')->expectsOutput('All done!');

        //Then the stock details should be refreshed
        $this->assertTrue(Product::first()->inStock());

    }

}
