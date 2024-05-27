<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';
    protected $primaryKey = 'ProductID';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'SKU',
        'ProductName',
        'Priority',
        'Price',
        'ImageURL',
        'BrandID',
        'Color',
        'Dimension',
        'Weight',
        'ScreenSize',
        'ScreenResolution',
        'FrontCamera',
        'RearCamera',
        'CPU',
        'RAM',
        'Power',
        'ChargingPort',
        'SIM',
        'Bluetooth',
        'HeadphoneJack',
        'Storage',
        'Status',
        'Priority'
    ];
}
