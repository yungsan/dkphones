<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'Order_details';
    protected $primaryKey = null;
    public $incrementing = false;
    // const CREATED_AT = 'CreatedAt';
    // const UPDATED_AT = 'UpdatedAt';
    public $timestamps = false;
    protected $fillable = [
        'OrderID',
        'ProductID',
        'Quantity',
    ];
}
