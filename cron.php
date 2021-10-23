<?
session_start();
$mysqli = mysqli_connect('localhost','minerand_bd','','minerand_bd');
require_once ('TwitterAPIExchange.php');

/** Defina os tokens de acesso aqui - consulte: https://dev.twitter.com/apps/ **/
$settings = array (
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "",
    'consumer_secret' => ""
);

#$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$url = "https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";

    $sql = 'SELECT * FROM pesquisa order by id desc';
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $string = utf8_encode($row['string']);
            $getfield = '?q='.$string.'&count=100';
            
            $twitter = new TwitterAPIExchange($settings);
            $string = json_decode($twitter->setGetfield($getfield)
                        ->buildOauth($url, $requestMethod)
                        ->performRequest(),$assoc = TRUE);

            // echo '<pre>';
            // print_r($string);
            // echo '</pre>'; 
            foreach($string['statuses'] as $items){
                echo $items['id']."<br />";
                $mysqli->query("insert into tuite (tuite, id_tuite, id_pesquisa) values ('".utf8_decode($items['text'])."', '".utf8_decode($items['id'])."', '".$row['id']."')");    
            }


           
            echo '<hr>';
        
            //$mysqli->query("insert into pesquisa (string, uid) values ('".utf8_decode($_POST['q'])."', '".($_SESSION['id'])."')");    

        }
    }

?>
