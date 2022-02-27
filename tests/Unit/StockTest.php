<?php

namespace Tests\Unit;

use App\Clients\ClientException;
use App\Models\Stock;
use App\Models\Retailer;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_throw_an_exception_if_a_client_is_not_found_when_tracking()
    {

        $this->seed(RetailerWithProductSeeder::class);

        Retailer::first()->update(['name' => 'Foo Retailer']);

        $this->expectException(ClientException::class);

        Stock::first()->track;


    }
}
