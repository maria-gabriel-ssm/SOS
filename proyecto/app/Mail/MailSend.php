<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;
    public $var, $confe, $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($var, $con, $type)
    {
        //
        $this->var = $var;
        $this->con = $con;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->type) {
            case 'SSV':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_mail')->with([
                "usuario" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;

            case 'SSVA':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_agenda')->with([
                "detalles" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;

            case 'SSVC':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_cancel')->with([
                "detalles" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;

            case 'SSVC2':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_cancel2')->with([
                "detalles" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;

            case 'SSVU':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_update')->with([
                "detalles" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;

            case 'SSVS':
            return $this->subject('Nueva notificación de videoconferencias')->view('emails.e_solicitud')->with([
                "usuario" => $this->var,
                "conferencia" => $this->con,
            ]); 
            break;
            
            default:

                break;
        }
        // if($this->type == 'SSV'){ //nueva solicitud
            
        // }elseif ($this->type == 'SSVA') { //agendado
            
        // }elseif ($this->type == 'SSVC') { //cancelacion por solicitud
            
        // }elseif ($this->type == 'SSVC2') { //cancelacion por admin
            
        // }
        // elseif ($this->type == 'SSVU') { //reagendación por admin
            
        // }
    }
}
