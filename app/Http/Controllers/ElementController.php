<?php

namespace App\Http\Controllers;

use App\Element;
use App\Mail\Winnings as WinningsMail;
use Illuminate\Support\Facades\Mail;

class ElementController extends Controller
{
    public function __invoke()
    {
        return Element::all();
    }

	public function index()
	{
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
