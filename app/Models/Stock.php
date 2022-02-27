<?php

namespace App\Models;

use App\Clients\ClientException;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{

    protected $table = 'stock';

    protected $casts = [
        'in_stock' => 'boolean'
    ];


    /**
     * @throws ClientException
     */
    public function track(): void
    {

        $status = $this->retailer->client()->checkAvailability($this);

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price,
        ]);


    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }


}

