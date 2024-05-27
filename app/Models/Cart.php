<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'Carts';
    protected $primaryKey = 'CartID';
    // public $incrementing = false;
    // const CREATED_AT = 'CreatedAt';
    // const UPDATED_AT = 'UpdatedAt';
    public $timestamps = false;
    protected $fillable = [
        'CustomerID',
        'ProductID',
        'Quantity',
    ];
}
