<?php
/**
 * Plugin Name: Custom data list show
 * Plugin Uri: http://localhost/appfoster
 * Author: Anubhaw Bhardwaj
 * Author Uri:http://google.com/
 * Version:3.0.2
 * Description:This plugin is show custom data after active this plugin please use this code where you want to display " echo do_shortcode( '[custom_data_list_show]' ); ".
 */

if(!defined('ABSPATH')):
	die("Not Permit");
endif; 

function custom_data_list() {
$request = wp_remote_get( 'https://raw.githubusercontent.com/LearnWebCode/json-example/master/animals-1.json' );
    if( is_wp_error( $request ) ) {
    return false; // Bail early
    }
    $body = wp_remote_retrieve_body( $request );

    $data = json_decode( $body );
    //echo '<pre>';
    //print_r($data); die;
        if( ! empty( $data ) ) { ?>
<table align="center" border="1" width="80%">
    <tr>
        <th style="text-align: center;">Name</th>
        <th style="text-align: center;">Species</th>
        <th style="text-align: center;">Foods</th>
    </tr>
<?php
        
        foreach( $data as $datas ) {
            echo '<tr>';
            echo '<td>';
                echo  $datas->name;
            echo '</td>';
            echo '<td>';
                echo  $datas->species;
            echo '</td>';
            echo '<td>';
            echo '<strong>Likes :-</strong> <br>';
            foreach($datas->foods->likes as $like){
                echo  $like;
                echo '<br>';
            }
            echo '<strong>dislikes :-</strong> <br>';
            foreach($datas->foods->dislikes as $dislike){
                echo  $dislike;
                echo '<br>';
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

add_shortcode('custom_data_list_show', 'custom_data_list');
?>
