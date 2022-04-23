<?php

include("config.php");
include("hclass.php");

$ip =  getRealIpAddr();

$c = $_GET['c'];

if($c == 1) $offset = 0; else $offset = $c * 20 - 20;
$limit = 20;

$host = "https://google.com";

$queries = array(
                   "get_link" => "SELECT * from short_links order by `id` desc limit $offset,$limit",
                    "get_clicks" => "SELECT count(*) as total from clicks_log where `clicked_id` = ?"
                );

$time = gmdate('Y-m-d H:i:s',strtotime('+2 hours'));


$aff_link = "https://website.com";

$short_prefix = "website.com/";
$json = [];

/* Get link by id */
$pull_link = pull($queries['get_link'],"","s",$conn);

if($pull_link->num_rows > 0) {

    while ($row = $pull_link->fetch_assoc()) {

        $id = $row['id'];
        $url = urldecode ($row['url']);
        $short_id = $row['short_id'];
        $short_link = $short_prefix.$short_id;
        $pull_clicks = pull($queries['get_clicks'],$short_id,"s",$conn);
        $clicks = $pull_clicks->fetch_object()->total;

        $json['log'][] = array(
            "id" => $id,
            "url" => $url,
            "short_link" => $short_link,   
            "clicks" => $clicks
        );
     
    }

    
    echo json_encode($json);
}



?>

