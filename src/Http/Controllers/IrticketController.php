<?php namespace Amin101\Irticket\Http\Controllers;
/**
 *
 * @author kora jai <kora.jayaram@gmail>
 */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
class IrticketController extends Controller
{
    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        dd(Config::get("irticket.message"));
        return view('contact::contact');
    }
}


