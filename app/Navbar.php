<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbars';

    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "sort", "link", "type", "is_open",
    ];
}
