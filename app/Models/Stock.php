<?php

namespace App\Models;

use Http;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
//    use HasFactory;

    protected $table = 'stock';

    protected $casts = [
        'in_stock'=>'boolean'
    ];

    public function track()
    {

        // Hit an API endpoint for the associated retailer for this item
        if ($this->retailer->name === 'Best Buy'){
            $result = Http::get('http://foo.test')->json();

            $this->update([
                'in_stock' => $result['available'],
                'price' => $result['price'],
            ]);
        }

        //Fetch the up-to-date details for the item
        //And then refresh the current stock record


    }

    public function retailer(){
        return $this->belongsTo(Retailer::class);
    }

}

