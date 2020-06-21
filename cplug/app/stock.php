<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'quantity', 'user_id', 'product_id'
    ];

    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function products(){
        return $this->hasOne('App\Product');
    }
}
