<?php
/**
 * Plugin Name: GCMW Plugin for Payments
 * Plugin URI: http://www.chinmayamission.com/wp-content/plugin/wp_gcmw_payments
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
include('axis_bank_payment_gateway/VPCPaymentProcess.php');
include('paypal/paypal-confirmation.php');
    
function redirectToAxisBankCCMT4PGW($trans_id,$amount,$returnUrl,$orderInfo){
      $gateway_data['vpc_AccessCode'] = "20F612D0";  //Production
      $gateway_data['vpc_MerchTxnRef']= $trans_id;   //Production
      $gateway_data['vpc_Merchant']   = "CCMT4";     //Production

      // $gateway_data['vpc_AccessCode'] = "D880EDE9";       //Testing
      // $gateway_data['vpc_MerchTxnRef']= $trans_id;        //Testing
      // $gateway_data['vpc_Merchant']   = "TESTCCMTBOOKS";  //Testing
      $gateway_data['vpc_OrderInfo']  = $orderInfo;
      $gateway_data['vpc_Amount']     = $amount;
      $gateway_data['vpc_ReturnURL']  = $returnUrl;
      axisBankPaymentRequest($gateway_data);
} 

function axisBankCCMT4PGWResponse(){
        return axisBankPaymentResponse();
}

function paypalResponse($ccmtTrxId){
    return paypalPaymentResponse($ccmtTrxId);
}

?>