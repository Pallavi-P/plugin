<?php
include('VPCPaymentConnection.php');

 function axisBankPaymentRequest($gateway_data){
    // $secureSecret = "5A60BFA4A9D3822C1B6E863BC1D4A5CF"; // Testing
    $secureSecret = "422F153FB2B63F895469EE44E4E6BF49"; //Production
    write_log("Inside vpc_paymentRequest");
    $vpcURL = "https://migs.mastercard.com.au/vpcpay";
    $conn = new VPCPaymentConnect();
    $conn->setSecureSecret($secureSecret);
    $gateway_data['vpc_Version']    = 1;
    $gateway_data['vpc_Command']    = "pay";
    $gateway_data['vpc_Locale']     = "en";
    $gateway_data['vpc_Currency']   = "INR";
    $gateway_data['vpc_Amount']     = $gateway_data['vpc_Amount'] *100 ;
    ksort ($gateway_data);
    foreach($gateway_data as $key => $value) {
      if (strlen($value) > 0) {
      $conn->addDigitalOrderField($key, $value);
      }
    }
    $secureHash = $conn->hashAllFields();
    $conn->addDigitalOrderField("vpc_OrderInfo",  $gateway_data['vpc_OrderInfo']);
    $conn->addDigitalOrderField("vpc_SecureHash", $secureHash);
    $conn->addDigitalOrderField("vpc_SecureHashType", "SHA256");
    $vpcURL = $conn->getDigitalOrder($vpcURL);
    write_log($gateway_data['vpc_MerchTxnRef']. '- Payment Processing VPC URL :'. $vpcURL);
    header("Location: $vpcURL");
    exit();
}


 function axisBankPaymentResponse (){
 	  // $secureSecret = "5A60BFA4A9D3822C1B6E863BC1D4A5CF"; // Testing
    $secureSecret = "422F153FB2B63F895469EE44E4E6BF49"; //Production
    $result= getPaymentResponse($secureSecret);
    return $result;
  }

 function getPaymentResponse($secureSecret){
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $conn = new VPCPaymentConnect();
      $conn->setSecureSecret($secureSecret);
      // Set the error flag to false
      $errorExists = false;
      // *******************************************
      // START OF MAIN PROGRAM
      // *******************************************
      // This is the title for display
        
      $title              = array_key_exists("Title", $_GET)                      ? $_GET["Title"]                : "";
      $againLink          = array_key_exists("AgainLink", $_GET)                  ? $_GET["AgainLink"]            : "";
      $amount             = array_key_exists("vpc_Amount", $_GET)                 ? $_GET["vpc_Amount"]           : "";
      $locale             = array_key_exists("vpc_Locale", $_GET)                 ? $_GET["vpc_Locale"]           : "";
      $batchNo            = array_key_exists("vpc_BatchNo", $_GET)                ? $_GET["vpc_BatchNo"]          : "";
      $command            = array_key_exists("vpc_Command", $_GET)                ? $_GET["vpc_Command"]          : "";
      $message            = array_key_exists("vpc_Message", $_GET)                ? $_GET["vpc_Message"]          : "";
      $version            = array_key_exists("vpc_Version", $_GET)                ? $_GET["vpc_Version"]          : "";
      $cardType           = array_key_exists("vpc_Card", $_GET)                   ? $_GET["vpc_Card"]             : "";
      $orderInfo          = array_key_exists("vpc_OrderInfo", $_GET)              ? $_GET["vpc_OrderInfo"]        : "";
      $receiptNo          = array_key_exists("vpc_ReceiptNo", $_GET)              ? $_GET["vpc_ReceiptNo"]        : "";
      $merchantID         = array_key_exists("vpc_Merchant", $_GET)               ? $_GET["vpc_Merchant"]         : "";
      $merchTxnRef        = array_key_exists("vpc_MerchTxnRef", $_GET)            ? $_GET["vpc_MerchTxnRef"]      : "";
      $authorizeID        = array_key_exists("vpc_AuthorizeId", $_GET)            ? $_GET["vpc_AuthorizeId"]      : "";
      $transactionNo      = array_key_exists("vpc_TransactionNo", $_GET)          ? $_GET["vpc_TransactionNo"]    : "";
      $acqResponseCode    = array_key_exists("vpc_AcqResponseCode", $_GET)        ? $_GET["vpc_AcqResponseCode"]  : "";
      $txnResponseCode    = array_key_exists("vpc_TxnResponseCode", $_GET)        ? $_GET["vpc_TxnResponseCode"]  : "";
      $riskOverallResult  = array_key_exists("vpc_RiskOverallResult", $_GET)      ? $_GET["vpc_RiskOverallResult"]: "";
      // Obtain the 3DS response
      $vpc_3DSECI             = array_key_exists("vpc_3DSECI", $_GET)             ? $_GET["vpc_3DSECI"] : "";
      $vpc_3DSXID             = array_key_exists("vpc_3DSXID", $_GET)             ? $_GET["vpc_3DSXID"] : "";
      $vpc_3DSenrolled        = array_key_exists("vpc_3DSenrolled", $_GET)        ? $_GET["vpc_3DSenrolled"] : "";
      $vpc_3DSstatus          = array_key_exists("vpc_3DSstatus", $_GET)          ? $_GET["vpc_3DSstatus"] : "";
      $vpc_VerToken           = array_key_exists("vpc_VerToken", $_GET)           ? $_GET["vpc_VerToken"] : "";
      $vpc_VerType            = array_key_exists("vpc_VerType", $_GET)            ? $_GET["vpc_VerType"] : "";
      $vpc_VerStatus          = array_key_exists("vpc_VerStatus", $_GET)          ? $_GET["vpc_VerStatus"] : "";
      $vpc_VerSecurityLevel   = array_key_exists("vpc_VerSecurityLevel", $_GET)   ? $_GET["vpc_VerSecurityLevel"] : "";
      // CSC Receipt Data
      write_log("Start Genrating the Receipt Data" );
      $cscResultCode  = array_key_exists("vpc_CSCResultCode", $_GET)              ? $_GET["vpc_CSCResultCode"] : "";
      $ACQCSCRespCode = array_key_exists("vpc_AcqCSCRespCode", $_GET)             ? $_GET["vpc_AcqCSCRespCode"] : "";
      // Add VPC post data to the Digital Order
      foreach($_GET as $key => $value) {
          if (($key!="vpc_SecureHash") && ($key != "vpc_SecureHashType") && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
          $conn->addDigitalOrderField($key, $value);
          }
      }
      // Obtain a one-way hash of the Digital Order data and
      // check this against what was received.
      $serverSecureHash   = array_key_exists("vpc_SecureHash", $_GET) ? $_GET["vpc_SecureHash"] : "";
      $secureHash = $conn->hashAllFields();
      if ($secureHash==$serverSecureHash) {
          $hashValidated = "<font color='#00AA00'><strong>CORRECT</strong></font>";
      } 
      else {
          $hashValidated = "<font color='#FF0066'><strong>INVALID HASH</strong></font>";
          $errorsExist = true;
          $message = "Invaid Hash Recieved, check with the bank";
      }

      
      $order_id =$merchTxnRef ;   
      // Get the descriptions behind the QSI, CSC and AVS Response Codes
      // Only get the descriptions if the string returned is not equal to "No Value Returned".
      $txnResponseCodeDesc = "";
      $cscResultCodeDesc = "";
      $avsResultCodeDesc = "";
      if ($txnResponseCode != "No Value Returned") {
          $txnResponseCodeDesc = getResultDesc($txnResponseCode);
      }
      if ($cscResultCode != "No Value Returned") {
          $cscResultCodeDesc = getCSCResultDesc($cscResultCode);
      }
      $error = false;
      // Show this page as an error page if error condition
      if ($txnResponseCode=="7" || $txnResponseCode=="No Value Returned" || $errorExists) {
          $error = true;
      }
  
  $result ["txnResponseCode"] =$txnResponseCode;
  $result ["txnResponseCodeDesc"] =$txnResponseCodeDesc;
  $result ["message"]=$message;
  $result["txnstatus"] =$txnstatus;
  $result["receiptNo"]= $receiptNo ;
  $result["authorizeID"] = $authorizeID;
  $result["batchNo"] = $batchNo;
  $result["merchTxnRef"] = $merchTxnRef;
  $result["acqResponseCode"]= $acqResponseCode;
  if($error )
    $result ["status"]='FAILED';
  else
    $result ["status"]='SUCCESS';

  return $result;
}
}


?>