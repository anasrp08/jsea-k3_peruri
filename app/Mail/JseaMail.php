<?php

namespace App\Mail;
use App\DataMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JseaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $order;
    public function __construct($dataTender,$dataRecipient,$action)
    {
        //
        $this->dataTender = $dataTender;
        $this->dataRecipient = $dataRecipient;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if($this->action == 'k3'){
            return $this->from('jsea@peruri.co.id')
            ->view('formulir.mailjsea')
            ->subject("Permintaan Review JSEA")
            ->with(
             [
                 'dataRecipient' => $this->dataRecipient,
                 'dataTender' => $this->dataTender[0],  
             ]);
        }else{
            return $this->from('jsea@peruri.co.id')
                   ->view('formulir.done_review')
                   ->subject("Permintaan Review JSEA")
                   ->with(
                    [
                        'dataRecipient' => $this->dataRecipient,
                        'dataTender' => $this->dataTender[0],  
                    ]);
        }
        
    }
}
