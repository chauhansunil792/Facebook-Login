<?php
if(!session_id()) {
    session_start();
}

require_once __DIR__ . '/autoload.php';
// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookRedirectLoginHelper;
class FbLogin extends Facebook{
	public $accessToken = 0;
	
	function __FbLogin($array = array()){
		
		parent::__construct($array);

	}



	function getUser($redirectURL,$fbPermissions = array()){
	// Get redirect login helper
	// echo "<pre>";
	// print_r($redirectURL);die;
		$helper = parent::getRedirectLoginHelper();

			
		// Try to get access token
		try {
		    if(isset($_SESSION['facebook_access_token'])){
		       $accessToken = $_SESSION['facebook_access_token'];
		    }else{
		          $accessToken = $helper->getAccessToken($redirectURL);

		    }
		} catch(FacebookResponseException $e) {
		     echo 'Graph returned an error: ' . $e->getMessage();
		      exit;
		} catch(FacebookSDKException $e) {
			
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		      exit;
		}
		if(!empty($accessToken)){
		         try {
		        $profileRequest = parent::get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture,friends',$accessToken);
		        $fbUserProfile = $profileRequest->getGraphNode()->asArray();
		    } catch(FacebookResponseException $e) {
		        echo 'Graph returned an error: ' . $e->getMessage();
		        session_destroy();

		        header("Location: ./");
		        exit;
		    } catch(FacebookSDKException $e) {
		    
		        echo 'Facebook SDK returned an error: ' . $e->getMessage();
		        exit;
		    }
		    	return $fbUserProfile;
		    }else{
		        $loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
		   		return $loginURL;
		    }
	}

	function isAnyUser(){
		$helper = parent::getRedirectLoginHelper();
		if(isset($accessToken))
       		return true;
    	else
       		return false;
	}
}

?>