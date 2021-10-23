<?
session_start();
$mysqli = mysqli_connect('localhost','minerand_bd','','minerand_bd');
if ($_POST['tuite']){ 
    
    $sql = 'SELECT * FROM pesquisa where string = "'.$_POST['q'].'" and uid = "'.$_SESSION["id"].'"';
    $result = $mysqli->query($sql);
    if ($result->num_rows == 0) {
       $mysqli->query("insert into pesquisa (string, uid) values ('".utf8_decode($_POST['q'])."', '".($_SESSION['id'])."')");    
    }

    foreach ($_POST['tuite'] as $data){    
        $i = explode(";", $data);
        $mysqli->query("insert into tuite (tuite, id_tuite) values ('".utf8_decode($i[0])."', '".utf8_decode($i[1])."')");    
    }
}
header('Location: ./?q='.$_POST['q']);