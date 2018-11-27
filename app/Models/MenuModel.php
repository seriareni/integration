<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    public $timestamps = false;

    public function user_menus(){
        return $this->hasMany('App\Models\UserMenuModel','menu_id', 'menu_id'); //Diarahkan ke child tablenya
    }
}
