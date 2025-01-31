<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Invoice;

class Customer extends Model
{

    use HasFactory;
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
