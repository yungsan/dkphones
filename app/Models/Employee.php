<?php

namespace App\Models;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'Employees';
    protected $primaryKey = 'EmployeeID';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
    // protected $guard = 'employee';
    protected $fillable = [
        'EmployeeName',
        'EmployeeEmail',
        'Gender',
        'PhoneNumber',
        'Salary',
        'DepartmentID',
        'PositionID',
        'HashedPassword'
    ];

    protected $hidden = [
        'HashedPassword',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'HashedPassword' => 'hashed',
    ];

    public function getAuthPassword()
    {
        return $this->HashedPassword;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
