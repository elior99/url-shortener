<?php

include("config.php");
include("hclass.php");

$ip =  getRealIpAddr();


$host = "https://google.com";

$queries = array(
    "store" => "SELECT * from affiliate_urls where `store_name` LIKE ?",
    "get_link" => "SELECT * from short_links where `short_id` = ?",
);



$time = gmdate('Y-m-d H:i:s', strtotime('+2 hours'));

$get_url = "";
$aff_link = "https://website.com/";

if (isset($_GET['id'])) {


    $get_url = $_GET['id'];

    /* Get link by id */
    $pull_link = pull($queries['get_link'], $get_url, "s", $conn);

    if ($pull_link->num_rows > 0) {


        while ($row = $pull_link->fetch_assoc()) {

            $original_link = $row['url'];
            $aff_link = $original_link;
        }


        $parse = parse_url($original_link);
        $host = str_replace("www.", "", $parse['host']);
        $like_host = "%" . $host . "%";
        $sign = "";

        /* If link is exist in store list */
        $pull_store = pull($queries['store'], $like_host, "s", $conn);
        if ($pull_store->num_rows > 0) {


            while ($row = $pull_store->fetch_assoc()) {

                $link = $row['url'];
                $type = $row['type'];
            }


            if ($type == "add") {

                $sign = "?";
                if (strpos($original_link, "?") !== FALSE) {

                    $sign = "&";
                }
            }


            $aff_link = str_replace('$myURL$', $original_link . $sign, $link);
        } else {
            $aff_link = $original_link;
        }
    } else
        $aff_link = "https://website.com/";
}

$result = $conn->prepare("INSERT INTO `clicks_log` (`ip`,`clicked_id`,`time`) 
                                                        VALUES ('$ip','$get_url','$time') ");

$result->execute();


header("Location:" . $aff_link);
