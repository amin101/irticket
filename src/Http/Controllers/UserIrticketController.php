<?php

namespace Amin101\Irticket\Http\Controllers;

use Amin101\Irticket\Models\TicketCategory;
use Amin101\Irticket\Repositories\TicketRepository;
use Amin101\Irticket\Models\Ticket;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserIrticketController extends Controller
{

    protected $ticketRepo;
    protected $request;
    protected $user_id;
    /**
     * TicketController constructor.
     * @param $ticketRepo
     * @param $request
     */
    public function __construct(TicketRepository $ticketRepo, Request $request)
    {
        $this->ticketRepo = $ticketRepo;
        $this->request = $request;
        $this->user_id = \Auth::id();
    }

    public function index()
    {
        $tickets =  $this->ticketRepo->index();
        return view('irticket::index', compact('tickets'));
    }

    public function create()
    {
        $categories = TicketCategory::all();
        $categories = array_pluck($categories, 'name', 'id');
        return view('irticket::create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $this->ticketRepo->store($request);
        return redirect()->route('user.tickets.index');

    }

    public function show($id)
    {
        $tickets = $this->ticketRepo->show($id);
        $root  = $tickets['root'];

        $children = $tickets['children'];
        $categories = TicketCategory::all();
        $categories = array_pluck($categories, 'name', 'id');
        return view('irticket::show', compact('root', 'children', 'categories'));
    }


    public function update(Request $request, $ticket)
    {
        $this->ticketRepo->update($request, $ticket, false);
        return redirect()->route('user.tickets.index')->with('flash_message', 'Response added successfully');
    }

    public function destroy($id)
    {
        //
    }
}
