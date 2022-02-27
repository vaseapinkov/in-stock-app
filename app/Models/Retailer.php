<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
//    use HasFactory;

    public function addStock(Product $product, Stock $stock): void
    {

        $stock->product_id = $product->id;
        $this->stock()->save($stock);

    }

    public function stock(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
