<?php

namespace Amin101\Irticket\Http\Controllers;

use Amin101\Irticket\Repositories\TicketRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AgentIrticketController extends Controller
{
    protected $ticketRepo;

    /**
     * AdminTicketController constructor.
     * @param $ticketRepo
     */
    public function __construct(TicketRepository $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }


    public function index()
    {
        $tickets = $this->ticketRepo->notAnswered();
       return view('irticket::backend.index', compact('tickets'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $tickets = $this->ticketRepo->show($id, null);
        $root  = $tickets['root'];
        $children = $tickets['children'];
//        dd($root);
        return view('irticket::backend.show', compact('root', 'children'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
       // dd($request);
        $this->ticketRepo->update($request, $id);
       return redirect()->route('admin.tickets.index')->with('flash_message', 'Response added successfully');
    }


    public function destroy($id)
    {
      $this->ticketRepo->adminDestroy($id);
        return redirect()->route('admin.tickets.index')->with('flash_message', 'Ticket deleted successfully');
    }

}
