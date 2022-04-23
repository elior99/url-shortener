<?php

include("config.php");


function pull($query,$id,$s,$mysql) {

$result = $mysql->prepare($query);

if(is_array($id))  {
  //  array_unshift($id, $result);
    call_user_func_array(array($result, 'bind_param'), $id);
}
else
    $result->bind_param($s, $id);

$result->execute();
$output = $result->get_result();

return $output;

}

$queries = array("log" => "SELECT count(*) as counter from `clicks_log` where `clicked_id` LIKE ?");


if(isset($_GET['id'])) {


$get_url = $_GET['id'];

$pull_log = pull($queries['log'],$get_url,"s",$conn);
echo $pull_log->fetch_object()->counter;


}
?>