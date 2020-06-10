<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "navbar_id", "sort", "link", "is_list", "is_open",
    ];
}
