<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{
  use RefreshDatabase;


  function test_in_tracks_product_stock(){

      $switch = Product::create(['name' => 'Nintendo switch']);

      $bestBuy = Retailer::create(['name' => 'Best Buy']);

      $this->assertFalse($switch->inStock());

      $stock = new Stock([
          'price'=>10000,
          'url' => 'https://foo.com',
          'sku' => '12345',
          'in_stock' => false
      ]);

      $bestBuy->addStock($switch, $stock);
      $this->assertFalse($stock->fresh()->in_stock);

      Http::fake(function (){
          return[
              'available'=>true,
              'price'=>29900,
          ];
      });

      // When Trigger the php artisan track command
      //And assuming the stock is available now
      $this->artisan('track');

      //Then the stock details should be refreshed
      $this->assertTrue($stock->fresh()->in_stock);

  }

}
