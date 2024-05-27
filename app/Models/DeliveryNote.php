<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    use HasFactory;
    protected $table = 'Delivery_Notes';
    protected $primaryKey = 'DeliveryNoteID';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'DeliveryNoteID',
        'EmployeeID',
        'WarehourseID',
        'OrderID',
    ];
}
