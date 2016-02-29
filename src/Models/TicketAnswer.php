<?php

namespace Amin101\Irticket\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAnswer extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function ticket()
    {
        return $this->belongsTo('Amin101\Irticket\Models\TicketQuestion');
    }
}
