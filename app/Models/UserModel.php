<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function getUserMenus(){
        return $this->hasMany('App\Models\UserMenuModel', 'user_id', 'user_id'); //Diarahkan ke child tablenya
    }

    public function roles(){
        return $this->hasOne('App\Models\RoleModel', 'role_id', 'role_id'); //Diarahkan ke child tablenya
    }
}
