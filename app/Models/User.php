<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version June 8, 2021, 1:27 am UTC
 *
 * @property string name
 * @property integer roles_id
 * @property string email
 * @property string password
 * @property string remember_token
 */
class User extends Model
{
    use SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'roles_id',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'roles_id' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',        
        'email' => 'required'        
    ];

    //Relasi dengan transaksi
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function qrcodes()
    {
        return $this->hasMany('App\Models\Qrcode');
    }

    //relasi dengan role
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function account()
    {
        return $this->hasMany('App\Models\Account');
    }

    public function account_histories()
    {
        return $this->hasMany('App\Models\AccountHistory');
    }
}
