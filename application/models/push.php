<?php
$AndroidDeviceToken[0] = 'APA91bFPtt9v36eGUEqlqoy77cYJmaCPfoyzmqI0aH3yOnqgIHlcJNriUaOsM7wClcCZzniYTvNJr0v9_yDE0X2Gn3eBWjoy60ZedLT-lq9H3zebWAnpMP4SLP9sPXrMFYd5DhzLDDyy';
$message = 'hello testing';
$key = 'AIzaSyALLxnrhdo7QLsGg9UNbWwoaXqluFxNLRs';

$url = 'https://android.googleapis.com/gcm/send';
					$fields = array(
				                'registration_ids'  => $AndroidDeviceToken,
				                'data'              => array( "message" => $message ),
				                );
				 
					$headers = array( 
				                    'Authorization: key=' . $key,
				                    'Content-Type: application/json'
				                );

					//echo $message.'----'.$registrationIDs[0].'----------'.$headers[0];
					 
					// Open connection
					$ch = curl_init();
					 
					// Set the url, number of POST vars, POST data
					curl_setopt( $ch, CURLOPT_URL, $url );
					 
					curl_setopt( $ch, CURLOPT_POST, true );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					 
					curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
					 
					// Execute post
					$result = curl_exec($ch);
					 
					// Close connection
					curl_close($ch);
					if($result) {
						echo "success";
					}else {
						echo "fail";
					}