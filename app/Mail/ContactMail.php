<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Contact;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string the address to send the email */
    protected $name;
    /** @var string the address to send the email */
    protected $email;
    /** @var string the address to send the email */
    protected $phone;
    /** @var string the address to send the email */
    protected $message;



    /**
     * Create a new message instance.
     *
     * @param string $to_address the address to send the email
     * @param float $winnings   the winnings they won
     * 
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->name = $contact->name;
        $this->email = $contact->email;
        $this->phone = $contact->phone;
        $this->message = $contact->message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$data = [
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'message' => $this->message
		];
        return $this
            ->to(env('MAIL_TO_ADDRESS'))
            ->subject('Contato')
            ->view('emails.contact')
            ->with(['data' => $data]);
    }
}
