<?php

namespace BCash\ServiceImpl;

use BCash\Config\Config;

final class AuthenticationHelper {
	
	public function generateAuthenticationOAuth(){
	
		$time = time()*1000;
		$microtime = microtime();
        $rand = mt_rand();

        $config = Config::getInstance();
	
		$signature = array(
				"oauth_consumer_key"=>$config->oAuthConsumerKey,
				"oauth_nonce"=>md5( $microtime . $rand ),
				"oauth_signature_method"=>$config->oAuthSignatureMethod,
				"oauth_timestamp"=>$time,
				"oauth_version"=>$config->oAuthVersion,
		);
	
		$signature = base64_encode(http_build_query($signature, '', '&'));
	
		$oAuth = array("Authorization: OAuth realm=".$config->oAuthRealm.
				",oauth_consumer_key=".$config->oAuthConsumerKey.
				",oauth_nonce=".md5( $microtime. $rand ).
				",oauth_signature=".$signature.
				",oauth_signature_method=".$config->oAuthSignatureMethod.
				",oauth_timestamp=".$time.
				",oauth_version=".$config->oAuthVersion,
				"Content-Type:application/x-www-form-urlencoded; charset=".$config->transactionCharset,
		);
		return $oAuth;
	}
	
	public function generateAuthenticationBasic(){
        $config = Config::getInstance();
		return array(
				'Authorization: Basic '.base64_encode($config->credentialsEmail.':'.$config->credentialsToken),
				"Content-Type: application/x-www-form-urlencoded; charset=".$config->accountCharset);
	}
}
?>
