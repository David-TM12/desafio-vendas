<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    protected $fillable = [
        'name',
        'email',
        'password'
    ];


    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
