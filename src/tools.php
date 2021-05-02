<?php


namespace aparat;


class tools
{

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