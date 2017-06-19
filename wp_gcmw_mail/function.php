<?php

/**
 * Plugin Name: GCMW Plugin for Email
 * Plugin URI: http://www.chinmayamission.com/wp-content/plugin/wp_gcmw_mail
 * Description: GCMW Plugin for Payments
 * Version: 0.1
 * Author: Praful Ghadge
 * Author URI: http://www.chinmayamission.com
 * License: GPL2
 */

/*  Copyright 2017  CCMT

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include('mail_template.php');

function sendMail($templateName,$templateData,$mailData){
    
    $template = new MailTemplate('templates/'.$templateName);
    $template->setTemplateData($templateData);
    $mailContent = $template->render();
    return processMail($mailData,$mailContent);
}


function processMail($mailData,$mailContent){
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional headers
    $headers .= 'From: CCMT Webmaster<webmaster@chinmayamission.com>' . "\r\n";
    $headers .= 'Reply-To: '.  $mailData['replyto_address']  . "\r\n";
    $headers .= 'Cc: '.  $mailData['cc_address']  . "\r\n";
    $headers .= 'Bcc: '. $mailData['bcc_address']  . "\r\n";
    // Send email()
    if(mail($mailData['to_address'],$mailData['subject'],$mailContent,$headers)):
        $msg = 'Email has sent successfully.';
    else:
        $msg = 'Email sending fail.';
    endif;
    return $msg ;
}


?>