<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $primaryKey = 'OrderID';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'OrderID',
        'Total',
        'StatusID',
        'Address',
        'CustomerID',
    ];
}
