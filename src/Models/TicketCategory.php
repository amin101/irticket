<?php

namespace Amin101\Irticket\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{

    public function tickets(){
        return $this->hasMany('Amin101\Irticket\Models\TicketQuestion');
    }
}
