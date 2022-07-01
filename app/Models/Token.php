<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    /**
     * List of attributes for which mass assignment is forbidden.
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
    * Get the user that owns the token.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
