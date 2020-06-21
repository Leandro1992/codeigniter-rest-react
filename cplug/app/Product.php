<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'color', 'size', 'image'
    ];

    public function stock(){
        $stocks = $this->hasMany('App\stock', 'product_id');
        $total = 0;

        foreach ($stocks->get() as $stock) {
            if($stock->type == 'out'){
                $total = $total - $stock->quantity;
            }else{
                $total = $total + $stock->quantity;
            }
        }

        return $total;
    }

}
