<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 * @package App\Models
 * @version June 13, 2021, 10:01 am UTC
 *
 * @property integer user_id
 * @property number balance
 * @property number total_credit
 * @property number total_debit
 * @property string withdrawal_method
 * @property string bank_name
 * @property string bank_branch
 * @property string bank_account
 * @property integer applied_for_payout
 * @property integer paid
 * @property string last_date_applied
 * @property string last_date_paid
 * @property string country
 * @property string other_details
 */
class Account extends Model
{
    use SoftDeletes;

    public $table = 'accounts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'balance',
        'total_credit',
        'total_debit',
        'withdrawal_method',
        'bank_name',
        'bank_branch',
        'bank_account',
        'applied_for_payout',
        'paid',
        'last_date_applied',
        'last_date_paid',
        'country',
        'other_details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'balance' => 'float',
        'total_credit' => 'float',
        'total_debit' => 'float',
        'withdrawal_method' => 'string',
        'bank_name' => 'string',
        'bank_branch' => 'string',
        'bank_account' => 'string',
        'applied_for_payout' => 'integer',
        'paid' => 'integer',
        'last_date_applied' => 'date',
        'last_date_paid' => 'date',
        'country' => 'string',
        'other_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'balance' => 'required',
        'total_credit' => 'required',
        'total_debit' => 'required',
        'withdrawl_method' => 'required',
        'bank_name' => 'required',
        'bank_branch' => 'required',
        'bank_account' => 'required',        
        'paid' => 'required',        
        'country' => 'required',
        'other_details' => 'required'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function account_histories()
    {
        return $this->hasMany('App\Models\AccountHistory');
    }

    
}
