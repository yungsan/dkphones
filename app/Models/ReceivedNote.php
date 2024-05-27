<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedNote extends Model
{
    use HasFactory;
    protected $table = 'Received_Notes';
    protected $primaryKey = 'ReceivedNoteID';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    protected $fillable = [
        'EmployeeID',
        'SupplierID',
        'WarehouseID',
        'BatcheID',
    ];
}
