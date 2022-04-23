<?php

include("config.php");
include("hclass.php");


if(isset($_GET['url'])) {

    $rec_data = json_decode(file_get_contents('php://input'),true);
    $get_url = $rec_data['url'];

    $result = $conn->prepare("INSERT INTO `short_links` (`url`,`short_id`) 
                                                        VALUES (?,null) ");
               
                $result->bind_param('s', $get_url);
                $result->execute();
               

                $last_id = $conn->insert_id;
                $convert = convert_base62($last_id);
                $result = $conn->prepare("UPDATE `short_links` SET `short_id` = '$convert' WHERE `id` = ?");
        
                $result->bind_param('i', $last_id);
                $result->execute();

$json['link'] = $convert;

echo json_encode($json);
}