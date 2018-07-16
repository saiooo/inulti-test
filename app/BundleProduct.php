<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BundleProduct extends Model
{
    public function bundle() {
        return $this->hasOne('App\Bundle');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}
