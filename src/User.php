<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 * @package App\Models
 * @version September 3, 2021, 1:54 am UTC
 *
 * @property \App\Models\TCompany $company
 * @property \Illuminate\Database\Eloquent\Collection $tAnnotations
 * @property \Illuminate\Database\Eloquent\Collection $tAnnotation2ds
 * @property \Illuminate\Database\Eloquent\Collection $tAnnotationLogs
 * @property \Illuminate\Database\Eloquent\Collection $tAudits
 * @property \Illuminate\Database\Eloquent\Collection $tAuditItems
 * @property \Illuminate\Database\Eloquent\Collection $tCompanyUsers
 * @property \Illuminate\Database\Eloquent\Collection $tDatasetFiles
 * @property \Illuminate\Database\Eloquent\Collection $tErrorLogs
 * @property \Illuminate\Database\Eloquent\Collection $tMessages
 * @property \Illuminate\Database\Eloquent\Collection $tPendingDatasets
 * @property \Illuminate\Database\Eloquent\Collection $tShares
 * @property \Illuminate\Database\Eloquent\Collection $tTags
 * @property \Illuminate\Database\Eloquent\Collection $tUserAssets
 * @property \Illuminate\Database\Eloquent\Collection $tUserHardware
 * @property \Illuminate\Database\Eloquent\Collection $tUserSettings
 * @property integer $company_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $api_token
 * @property string $company
 * @property string $phone_number
 * @property boolean $is_phone_verified
 * @property string $profile_image
 * @property boolean $is_admin
 * @property boolean $is_active
 * @property boolean $is_first
 * @property string $referred_by
 * @property string $referred_by_date
 * @property string $qb_user_id
 * @property string $qb_login
 * @property string $measurement_unit
 * @property string|\Carbon\Carbon $last_login
 */
class User extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 't_user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'api_token',
        'company',
        'phone_number',
        'is_phone_verified',
        'profile_image',
        'is_admin',
        'is_active',
        'is_first',
        'referred_by',
        'referred_by_date',
        'qb_user_id',
        'qb_login',
        'measurement_unit',
        'last_login'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'api_token' => 'string',
        'company' => 'string',
        'phone_number' => 'string',
        'is_phone_verified' => 'boolean',
        'profile_image' => 'string',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'is_first' => 'boolean',
        'referred_by' => 'string',
        'referred_by_date' => 'string',
        'qb_user_id' => 'string',
        'qb_login' => 'string',
        'measurement_unit' => 'string',
        'last_login' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_id' => 'required|integer',
        'first_name' => 'required|string|max:63',
        'last_name' => 'required|string|max:63',
        'email' => 'required|string|max:63',
        'password' => 'nullable|string|max:255',
        'api_token' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:64',
        'phone_number' => 'required|string|max:15',
        'is_phone_verified' => 'required|boolean',
        'profile_image' => 'nullable|string|max:255',
        'is_admin' => 'required|boolean',
        'is_active' => 'required|boolean',
        'is_first' => 'required|boolean',
        'referred_by' => 'nullable|string|max:255',
        'referred_by_date' => 'nullable|string|max:255',
        'qb_user_id' => 'nullable|string|max:255',
        'qb_login' => 'nullable|string|max:255',
        'measurement_unit' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'last_login' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\TCompany::class, 'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tAnnotations()
    {
        return $this->hasMany(\App\Models\TAnnotation::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tAnnotation2ds()
    {
        return $this->hasMany(\App\Models\TAnnotation2d::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tAnnotationLogs()
    {
        return $this->hasMany(\App\Models\TAnnotationLog::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tAudits()
    {
        return $this->hasMany(\App\Models\TAudit::class, 'completed_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tAuditItems()
    {
        return $this->hasMany(\App\Models\TAuditItem::class, 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tCompanyUsers()
    {
        return $this->hasMany(\App\Models\TCompanyUser::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tDatasetFiles()
    {
        return $this->hasMany(\App\Models\TDatasetFile::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tErrorLogs()
    {
        return $this->hasMany(\App\Models\TErrorLog::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tMessages()
    {
        return $this->hasMany(\App\Models\TMessage::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tPendingDatasets()
    {
        return $this->hasMany(\App\Models\TPendingDataset::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tShares()
    {
        return $this->hasMany(\App\Models\TShare::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tTags()
    {
        return $this->hasMany(\App\Models\TTag::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tUserAssets()
    {
        return $this->hasMany(\App\Models\TUserAsset::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tUserHardware()
    {
        return $this->hasMany(\App\Models\TUserHardware::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tUserSettings()
    {
        return $this->hasMany(\App\Models\TUserSetting::class, 'user_id');
    }
}
