<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RSVP extends Model
{
    protected $table = 'rsvp';

    protected $fillable = [
        'name',
        'surname',
        'status',
        'guest_count',
    ];
}
