<?php


namespace Amin101\Irticket\Repositories;


use Amin101\Irticket\Models\Ticket;
use Amin101\Irticket\Models\TicketAnswer;
use Amin101\Irticket\Models\TicketCategory;
use Amin101\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Session;

class TicketRepository extends BaseRepository
{

    protected $userId;
    protected $category;
    protected $ticketAnswer;

    private $ansTable;
    private $tckTable;
    private $catTable;
    private $userTable = 'users';
    private $num = 5;

    /**
     * TicketRepository constructor.
     */
    public function __construct(Ticket $ticket,
                                TicketAnswer $ticketAnswer,
                                TicketCategory $category)
    {
        $this->model = $ticket;
        $this->ticketAnswer = $ticketAnswer;
        $this->category = $category;
        $this->userId = \Auth::id();
        $this->ansTable = $ticketAnswer->getTable();
        $this->tckTable = $ticket->getTable();
        $this->catTable = $category->getTable();

    }

    public function index()
    {
        $root_tickets = $this->getRootTickets(null, $this->userId);
        return $root_tickets;
    }

    private function save($request)
    {

        $this->model->title = $request->input('title');
        $this->model->content = $request->input('content');
        $this->model->user_id = $this->userId;
        $this->model->cat_id = $request->input('cat_id');
        $this->model->resolved = $request->input('resolved');

        $this->model->save();

    }

    private function saveReply($request, $ticket_id)
    {

        $this->ticketAnswer->content = $request->input('content');
        $this->ticketAnswer->user_id = $this->userId;
        $this->ticketAnswer->ticket_id = $ticket_id;

        $this->ticketAnswer->save();
    }


    private function closeIssue($ticket_id)
    {

        $ticket = Ticket::findOrFail($ticket_id);

        if ($ticket->user_id == $this->userId) {
            $ticket->resolved = 1;
            $ticket->save();
            return true;
        } else return false;
    }

    public function store($request)
    {
        $this->save($request);
    }

    public function update($request, $ticket_id)
    {
        if ($request->has('close_issue')) {
            $this->closeIssue($ticket_id);
        } else {
            $this->saveReply($request, $ticket_id);
        }

    }

    public function show($ticket_id)
    {
        //whereId finds the node and orwhere finds its children
        $root = $this->getRootTickets($ticket_id);
        $children = $this->getChildrenTickets($ticket_id);
        // dd($children);
        return compact('root', 'children');
    }

    public function adminShow($ticket_id)
    {
        $root = $this->getRootTickets($ticket_id);
        $children = $this->getChildrenTickets($ticket_id);
        // dd($children);
        return compact('root', 'children');
    }

    private function getRootTickets($ticket_id = null, $user_id = null)
    {

        $roots = $this->queryRootTickets();
        if ($user_id) {
            $roots->where('user_id', $user_id);
        }

        if ($ticket_id) {
            $roots->whereId($ticket_id);
            return $roots->first();
        }
        return $roots->paginate($this->num);
    }


    private function queryRootTickets()
    {
        $roots = $this->model
            ->with(['category', 'user']);
        return $roots;
    }

    private function getChildrenTickets($parent_id)
    {
        $children = $this->ticketAnswer
            ->with('user')
            ->where('ticket_id', $parent_id)
            ->oldest()
            ->get();
        return $children;
    }

    private function queryOpenAndNotAnswared()
    {

        $not_answered = \DB::table("$this->tckTable AS tck")
            ->select("tck.id", "tck.title", "tck.user_id", "tck.created_at", 'usr.name')
            ->join("ticket_answers AS ans", "tck.id", '=', 'ans.ticket_id', 'left')
            ->join("$this->userTable AS usr", 'usr.id', '=', 'tck.user_id')
            ->whereNull("tck.resolved")
            ->where(function ($q) {

                $q->whereNull("ans.ticket_id")
                    ->orWhere(function ($q) {
                        $q->where("ans.created_at", function ($q) {
                            $q->select(\DB::raw("max(created_at)"))
                                ->from("$this->ansTable")
                                ->whereRaw('ans.ticket_id = tck.id');

                        })->whereNull('ans.agent_id');
                    });

            });

        return $not_answered;

    }

    public function notAnswered()
    {
        return $this->queryOpenAndNotAnswared()->get();
    }

    public function notAnswaredByUserId($user_id)
    {
        return $this->queryOpenAndNotAnswared()
            ->where("$this->tckTable.user_id", $user_id)
            ->get();
    }

    public function countAnsweredTicketByUserId($user_id)
    {

        $tickets_count = $this->queryAnswerdTicketByUserId($user_id)
            ->select(\DB::raw("count(*) AS count"))
            ->first();

        return $tickets_count;
    }

    public function answeredTicketByUserId($user_id)
    {

        $tickets = $this->queryAnswerdTicketByUserId($user_id)
            ->select('tck.id, tck.title, tck.slug')
            ->get();
        return $tickets;
    }

    private function queryAnswerdTicketByUserId($user_id)
    {

        $query = \DB::table("$this->tckTable AS tck")
            ->join("$this->ansTable AS ans", "tck.id", '=', "ans.ticket_id")
            ->whereNotNull('ans.agent_id')
            ->whereNull('tck.resolved')
            ->where('ans.created_at', function ($q) use ($user_id) {

                $q->select(\DB::raw('max(created_at)'))
                    ->from("$this->ansTable")
                    ->whereRaw('ticket_id = tck.id');

            });

        return $query;
    }

    public function adminDestroy($id)
    {
        $ticket = Ticket::with('ticketAnswers')->findOrFail($id);
        $answers_id = $ticket->ticketAnswers->lists('id')->toArray();
        TicketAnswer::destroy($answers_id);
        $ticket->delete();

    }
}

