<?php

namespace App\Http\Controllers;
use App\Mail\ContactMail;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;

class ContactsController extends Controller
{
	use HasApiTokens;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{

		try {
			$this->validate($request, [
				'name' => 'required',
				'email' => 'nullable|unique:contacts',
				'phone' => 'required',
			]);
		} catch(\Exception $e){
			return response($e, 400);
		}
		$contact = new Contact();
		$contact->name = $request->input('name');
		$contact->email= $request->input('email');
		$contact->phone = $request->input('phone');
		$contact->message = $request->input('message');
		try {
			Mail::send(new ContactMail($contact));
			$contact->save();
			return $contact;
		} catch(\Exception $e){
			return response($e, 400);
			return $e;
		}
	}
}
