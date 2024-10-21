<?php

class GoogleTranslate {

    function translate($text,  $targetLang, $apiKey) {

        $url = 'https://translation.googleapis.com/language/translate/v2?key=' . $apiKey;

        $data = array(
            'q' => $text,
            'target' => $targetLang,
            'format' => 'text',
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            return 'Error: Не вдалося підключитися до Google Translate API';
        }

        $response = json_decode($result, true);

        return isset($response['data']['translations'][0]['translatedText'])
            ? $response['data']['translations'][0]['translatedText']
            : 'Error: Не вдалося виконати переклад';
    }

}