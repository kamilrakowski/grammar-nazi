<?php

// Grammar Nazi 1.0a by Kamil Rakowski
$text = $_GET['text']; 
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://services.gingersoftware.com/Ginger/correct/json/GingerTheTextFull?apiKey=6ae0c3a0-afdc-4532-a810-82ded0054236&lang=US&clientVersion=2.0&text=' . urlencode($text),
    CURLOPT_USERAGENT => 'GrammarChat/1.0'
));
$resp = curl_exec($curl);
curl_close($curl);
$info = array_filter(json_decode($resp, true));

if(!empty($info['Corrections'])) {
	$text = NULL;
	$this->insertChatBotMessage($this->getPrivateMessageID(),'/error GrammarIncorrect');
}

?>