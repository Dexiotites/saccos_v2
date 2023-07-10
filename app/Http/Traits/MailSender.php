<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

trait MailSender {

    // =============== [ Email ] ===================
   /* public function email() {
        return view("email");
    }*/


    // ========== [ Compose Email ] ================
    public function composeEmail($receiver, $body) {
		//dd($receiver.' '.$body);
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

			  //Server settings
       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	   $mail->SMTPDebug = 0;
        $mail->isSMTP();      //Send using SMTP
        //$mail->Host       = 'smtp.localhost';
		//$mail->Port       = 465;
		$mail->Host       = 'ubx-co-tz.mail.protection.outlook.com';
        $mail->SMTPAuth   = false;
		$mail->Port       = 25;
		$mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
					)
				);

        $mail->setFrom('noreply@ubx.co.tz', 'UBX');
		$mail->addAddress($receiver);
        $mail->addReplyTo('noreply@ubx.co.tz', 'Information');

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'CYBERPOINT PRO';
        $mail->Body    = $body;
        $mail->AltBody = 'Cyberpoint Support';

        $mail->send();

        } catch (Exception $e) {

            try {
                $details = [
                    'title' => 'CYBERPOINT PRO',
                    'body' => $body,
                ];

                Mail::to($receiver)->send(new \App\Mail\sendMail($details));

                //return "email sent!";
            } catch (\Exception $e) {
                Log::error('An error occurred while sending the email: ' . $e->getMessage());

            }

        }
    }
}