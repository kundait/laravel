<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //If table name is not model name, the name is assigned as follows
    #protected $table = 'posts';
    #################################################
    ///Change Primary key
    #public $primaryKey = 'item_id';
    public function user(){
        return $this->belongsTo('App\User');
    }
}
