<?php


namespace aparat;


class tools
{

    function getApi($url)
    {
        $options = array(
            CURLOPT_CUSTOMREQUEST => "GET", //set request type post or get
            CURLOPT_POST => false, //set to GET
            CURLOPT_RETURNTRANSFER => true, // return web page as string
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "utf-8", // handle all encodings
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $header['content'] = curl_exec($ch);
        $header['err_no'] = curl_errno($ch);
        $header['err_msg'] = curl_error($ch);
        $header['info'] = curl_getinfo($ch);
        curl_close($ch);
        return $header;
    }

    function getVideoLinks(string $hash){
        $ch = curl_init();
        $url='https://www.aparat.com/v/' . $hash;
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER=> true
        ]);
        $output = curl_exec($ch);
        curl_close($ch);
        $re = "/(?<=onclick=\"setVideoVisit\(\)\">
                                                    <a href=\").*?(?=\")/im";
        preg_match_all($re,$output,$match);

        return $match;

    }
}