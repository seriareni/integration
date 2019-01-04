<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    protected $fillable = ['name', 'email', 'password','admin','role_id'];

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function getUserMenus(){
        return $this->hasMany('App\Models\UserMenuModel', 'user_id', 'user_id'); //Diarahkan ke child tablenya
    }

    public function roles(){
        return $this->hasOne('App\Models\RoleModel', 'role_id', 'role_id'); //Diarahkan ke child tablenya
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=sha1($value);

    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $model){
            $model->role_id=2;

        });

        self::created(function (self $model){
            $data = [
                ["menu_id"=>1, 'user_id' => $model->user_id],
                ["menu_id"=>4, 'user_id' => $model->user_id],
                ["menu_id"=>7, 'user_id' => $model->user_id]
            ];

            foreach ($data as $datum)
                UserMenuModel::create($datum);
        });
    }
}
