<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuModel extends Model
{
    protected $table = 'user_menus';

    protected $primaryKey = 'user_menu_id';

    public $incrementing = false;

    protected $fillable = ['menu_id', 'user_id'];

    public $timestamps = false;

    public function getMenu()
    {
        return $this->hasOne('App\Models\MenuModel', 'menu_id', 'menu_id'); //Diarahkan ke child tablenya
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            $latest = self::query()->orderBy('user_menu_id', 'desc')->first();
            $increment = 1;
            if ($latest !== null) {
                $increment = $latest->user_menu_id + 1;
            }

            $model->user_menu_id = $increment;
        });
    }
}
