<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryNoteDetail extends Model
{
    use HasFactory;
    protected $table = 'Delivery_Note_Details';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'DeliveryNoteID',
        'BatcheID',
        'ProductID',
        'ProductQuantity'
    ];
}
