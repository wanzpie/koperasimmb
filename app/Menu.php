<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['title', 'uri', 'parent_id', 'is_parent'];

    //
}
