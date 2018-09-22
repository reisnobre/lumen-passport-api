<?php

namespace App\Http\Controllers;

use App\Element;
use App\Mail\Winnings as WinningsMail;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;

class ElementController extends Controller
{
	use HasApiTokens;
    public function __invoke()
    {
        return Element::all();
    }

	public function index()
	{
		// return 'a';
		$to_email = 'eduardo.reisnobre@gmail.com'; $winnings = 130.00;
		try {
			Mail::send(
				new WinningsMail($to_email, $winnings)
			);
		} catch(\Exception $e){
			return $e;
		}
	}
}
