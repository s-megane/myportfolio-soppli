<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public function Cevent()
    {
        return $this->belongsTo(Event::class);
    }
}
