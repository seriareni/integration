<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuModel extends Model
{
    protected $table = 'user_menus';
    protected $primaryKey = 'user_menu_id';
    public $timestamps = false;

    public function getMenu(){
        return $this->hasOne('App\Models\MenuModel', 'menu_id', 'menu_id'); //Diarahkan ke child tablenya
    }
}
