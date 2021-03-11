<?php
if (!isset($_GET['zip'])) {
    echo 'zipが設定されていません。';
    exit;
}
$rtn = preg_match('/\A\d{7}\z/u' , $_GET['zip']);
if (!$rtn) {
    echo "郵便番号は数字７桁で入力してくだいさい。";
    exit;
} 
$url = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" . (int) $_GET['zip'] ;
$response = file_get_contents($url);
$response = json_decode($response, true);
if (!isset($response['results'])) {
    echo "正しい郵便番号を入力してください";
    exit;
}
echo  "入力された郵便番号は";
echo htmlspecialchars($response['results'][0]['address1'] , ENT_QUOTES , 'UTF-8');
echo htmlspecialchars($response['results'][0]['address2'] , ENT_QUOTES , 'UTF-8');
echo htmlspecialchars($response['results'][0]['address3'] , ENT_QUOTES , 'UTF-8');
echo "の郵便番号です。" . "<br>";
echo $response['message'];
echo htmlspecialchars($response['results'][0]['address1'] , ENT_QUOTES , 'UTF-8') . "はいいところですね";