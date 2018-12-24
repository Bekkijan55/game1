<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Detail;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function detail() {
        return $this->belongsTo(Detail::class);
    }
}
