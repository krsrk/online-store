<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Product extends Model
{
    //
    protected $fillable = ['product_name','product_guid','id_user_maker','id_user_publisher','description','price','image','status'];

    public function user()
    {
     # code...
         return $this->belongsTo(User::class);
    }
}
