<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class MalasngodingEmail extends Mailable
{
    use Queueable, SerializesModels;
 
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->blog = $data;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->from('melekaplikasi.id@gmail.com')
                   ->view('web.fo.pages.emailku')
                   ->with(
                    [
                        'nama' => $this->blog['data'],
                        'website' => '',
                    ]);
    }
}