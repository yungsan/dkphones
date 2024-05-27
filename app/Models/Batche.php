<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batche extends Model
{
    use HasFactory;
    protected $table = 'Batches';
    protected $primaryKey = 'BatcheID';
    public $incrementing = false;
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'BatcheID',
        'SKU',
        'Price',
        'Quantity',
        'Remain',
    ];
}
