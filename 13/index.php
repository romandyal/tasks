<?php

function getRemoteFileSize($url){
    $parse = parse_url($url);
    $host = $parse['host'];
    $fp = @fsockopen ($host, 80, $errno, $errstr, 20);
    if(!$fp){
        $ret = 0;
    }else{
        $host = $parse['host'];
        fputs($fp, "HEAD ".$url." HTTP/1.1\r\n");
        fputs($fp, "HOST: ".$host."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        $headers = "";
        while (!feof($fp)){
            $headers .= fgets ($fp, 128);
        }
        fclose ($fp);
        $headers = strtolower($headers);
        $array = preg_split("|[\s,]+|",$headers);
        $key = array_search('content-length:',$array);
        $ret = $array[$key+1];
    }
    if($array[1]==200) return $ret;
    else return -1*$array[1];
}

$url = 'http://www.softtime.ru/files/whois.zip';
$size = getRemoteFileSize($url);
if($size==0) echo "Не могу соединиться";
elseif($size<0) echo "Ошибка. Код ответа HTTP: ".(-1*$size);
else echo "Размер удалённого файла (bytes): ".$size;
?>