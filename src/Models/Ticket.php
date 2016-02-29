<?php


namespace Amin101\Irticket\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title', 'content'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('Amin101\Irticket\Models\TicketCategory', 'cat_id');
    }

    public function ticketAnswers()
    {
        return $this->hasMany('Amin101\Irticket\Models\TicketAnswer');
    }
}
