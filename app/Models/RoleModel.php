<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    public function user(){
        return $this->hasMany('App\Models\UserModel','role_id', 'role_id'); //Diarahkan ke child tablenya
    }
}
