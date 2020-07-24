<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    protected $fillable = [
        'worker_name','departaments_id'
    ];

    public function items()
    {
        return $this->hasMany('App\Departaments', 'departaments_id');
    }
}
