<?php

$result = $_GET['url'];

$url = $result;

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url);
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_VERBOSE, 1);
curl_setopt($ch1, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
curl_setopt($ch1, CURLOPT_REFERER, 'http://www.google.com');  //just a fake referer
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_POST, 0);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 20);

$htmlContent = curl_exec($ch1);
curl_close($ch1);

// $urlHost = parse_url($result, PHP_URL_HOST);

if (substr_count($htmlContent, 'data-src')) {
  preg_match_all('@data-src="([^"]+)"@', $htmlContent, $images);
  foreach ($images[0] as $image) {
    $secureImg = str_replace('data-src', 'src', $image);
    $htmlContent = str_replace($image, $secureImg, $htmlContent);
  }
};


echo $htmlContent;
