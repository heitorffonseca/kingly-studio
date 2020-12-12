<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Webpatser\Uuid\Uuid;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [ 'uuid', 'name' ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        Static::creating(function($model){
            $model->uuid = Uuid::generate()->string;
        });
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'profiles_permissions', 'profiles_id', 'permissions_id');
    }

    /**
     * @param String $uuid
     * @param array $with
     * @return Profile|Builder|Model|object|null
     */
    public static function findByUuid(String $uuid, Array $with = [])
    {
        return self::with($with)->where('uuid', $uuid)->first();
    }

    /**
     * @param String $name
     * @param array $with
     * @return Profile|Builder|Model|object|null
     */
    public static function findByName(String $name, Array $with = [])
    {
        return self::with($with)->where('name', $name)->first();
    }
}
