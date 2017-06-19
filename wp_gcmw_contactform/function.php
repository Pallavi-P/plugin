<?php
/**
 * Plugin Name: GCMW Plugin for Contact Form 7
 * Plugin URI: http://elementdesignllc.com/2011/11/contact-form-7-get-parameter-from-url-into-form-plugin/
 * Description: GCMW Plugin for Contact Form 7
 * Version: 0.1
 * Author: Chad Huntley, Praful Ghadge
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: GPL2
 */

/*  Copyright 2013  Chad Huntley  (email : chad@elementdesignllc.com)

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
/*
add_action('wpcf7_mail_sent', 'save_cf7_data');
add_action( 'wpcf7_before_send_mail', wpcf7_disablEmailAndRedirect );

function wpcf7_disablEmailAndRedirect( $cf7 ) {
    // get the contact form object
    $wpcf7 = WPCF7_ContactForm::get_current();
    // do not send the email
    $wpcf7->skip_mail = true;

}*/


add_action( 'wpcf7_init', 'wpcf7_add_shortcode_gcmwplugin' );
function wpcf7_add_shortcode_gcmwplugin() {
    if ( function_exists( 'wpcf7_add_shortcode' ) ) {
        wpcf7_add_shortcode( 'gethiddentag', 'wpcf7_gethiddentag_shortcode_handler', true );
        wpcf7_add_shortcode( 'getqueryparam', 'wpcf7_getqueryparam_shortcode_handler', true );
        wpcf7_add_shortcode( 'getpostmeta', 'wpcf7_getpostmeta_shortcode_handler', true );
    }
}


/* Add input hidden form tag by fetching values from page URL*/
function wpcf7_gethiddentag_shortcode_handler($tag) {
 
   if (!is_array($tag)) return '';
    $name = $tag['name'];
    if (empty($name)) return '';
    $html = '<input type="hidden" name="' . $name . '" value="'. esc_attr( $_GET[$name] ) . '" />';
    return $html;
}


/* pass value to the form by fetching values from page URL*/
function wpcf7_getqueryparam_shortcode_handler($tag) {
    if (!is_array($tag)) return '';

    $name = $tag['name'];
    if (empty($name)) return '';

    $html = esc_html( $_GET[$name] );
    return $html;
}


/* pass value to the form by fetching values from page URL*/
function wpcf7_getpostmeta_shortcode_handler($tag) {
    
    global $post;
    if (!is_array($tag)) return '';

    $name = $tag['name'];
    if (empty($name)) return '';
    write_log("Contact Form Tag Name" .$name );
    $customValues= getCustomValues($post->ID);
    $html = esc_html( strtolower($customValues[$name]));
    return $html;
}

remove_all_filters ('wpcf7_before_send _mail');
add_action('wpcf7_before_send_mail', 'contactform7_before_send_mail');

function contactform7_before_send_mail() {
    global $wpdb;
    $form_to_DB = WPCF7_Submission::get_instance();
    if ( $form_to_DB ) {
        $formData = $form_to_DB->get_posted_data();
    }
  
    //write_log($wpdb->last_query);
     if(session_id() == '') {
       session_start();
    }

    storeDonationData($formData);
    storeDonationEvent($formData);
   // $current_submission = WPCF7_Submission::get_instance();
   // $_SESSION['cf7_submission'] = $formData;
    //write_log('yyyyyy$_SESSION First name'.$_SESSION['donation']['first_name']);
    $wpcf7 = WPCF7_ContactForm::get_current();
    $wpcf7->skip_mail = true;
}


function storeDonationData($formData){
    global $wpdb;
    global $_SESSION;
    write_log ("inside ".storeDonationData);

    $donationData=array(
      'id' => '',
      'date'=>date('m/d/y'),
      'time'=>date('h:i:s'),
      'first_name'=>$formData['first_name'],  
      'last_name'=>$formData['last_name'],
      'email'=>$formData['your-email'],
      'pan_num'=>$formData['pan_card'],
      'contact'=>$formData['phone_number'],
      'address1'=>$formData['address_line1'],
      'address2'=>$formData['address_line2'],
      'city'=>$formData['city'],
      'state'=>$formData['state'],
      'country'=>$formData['country'],
      'pincode'=>$formData['pincode'],
      'total_amount'=>$formData['donation_amt'],
      'payment_method'=>$formData['payment_method']);
       $_SESSION['donation'] = $donationData;
       //write_log('xxxxxxy$_SESSION First name'.$_SESSION['donation']['first_name']);

    $wpdb->insert( 'wp_donation',$donationData, array( '%s' ));
}

function storeDonationEvent($formData){
    global $wpdb;
    $donationEventData= array(
        'id' => '',
        'donation_id'=>$wpdb->insert_id,
        'event_id'=>$formData['event_id'],
        'donation_type'=>$formData['donation_type'],
        'amount' =>$formData['donation_amt'],
        'currency' =>$formData['currency'],
        'payment_method' =>$formData['payment_method'],
        'option_field1' =>$formData['textfield1'],
        'option_field2' =>$formData['textfield2'],
        'option_field3' =>$formData['textfield3'],
        'option_field4' =>$formData['textfield4'],
        'purpose' =>$formData['purpose'],
        'status'=>'NOT_PAID'
    );
    $_SESSION['donationEvent'] = $donationEventData;
    $wpdb->insert( 'wp_donation_event',$donationEventData, array( '%s' ));
}




function updateDonationPaymentStatus($result){
    global $wpdb;
    $data= array(
        'status'=> $result ["status"],
        'receipt_no' => $result["receiptNo"],
        'bank_authorization_id'=> $result["authorizeID"],
        'batch_no'=> $result["batchNo"],
        'transaction_no'=> $result["merchTxnRef"],
        'txn_response_code' =>$result["txnResponseCode"],
        'txn_response_desc'=>$result ["txnResponseCodeDesc"],
        'acq_response_code'=>$result["merchTxnRef"],
        'pymt_gw_message'=> $result ["message"]
    );
    $wpdb->update('wp_donation_event', 
    $data , array('donation_id'=>$result["merchTxnRef"]));
}


