<?php
/**
 * @package ny_jokes
 * @version 1
 */
/*
Plugin Name: Random Jokes
Description: This Puggin show random jokes to keep developers entertained.
Author: Ironman
Version: 1.1
*/

// Fetching joke through the API
function jokes_plugin() {

    $jokesApi = wp_remote_get( 'https://dad-jokes.p.rapidapi.com/random/joke' ,
             array( 'timeout' => 10,
            'headers' => array( 'x-rapidapi-host' => 'dad-jokes.p.rapidapi.com',
                               'x-rapidapi-key'=> '3d33ad47a7msh494be10a46155d4p156975jsnaee792cea952' ) 
             ));

    $bodyJokes = wp_remote_retrieve_body( $jokesApi );

    $dataJokes = json_decode($bodyJokes);
    

    if( ! empty( $dataJokes ) ) {

                echo '<div class="jokes-container">';
                echo '<h2 class="">Joke Of The Day</h2>';
                echo '<p class="wrap jokes">'.$dataJokes->body[0]->setup. '</p>';
                echo '<p class="wrap jokes">'.$dataJokes->body[0]->punchline. '</p>';
                echo '</div>';

    }

}

//intializing the jokes fonction to be displayed on admin dashboard.
add_action('admin_notices', 'jokes_plugin');

//styling for the jokes plugin
function jokes_style() {
    wp_register_style('jokes_style', plugins_url('jokes.css',__FILE__ ));
    wp_enqueue_style('jokes_style');
}

//intializing the styling for jokes plugin
add_action( 'admin_init','jokes_style');


