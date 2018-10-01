<?php

require_once('TwitterAPIExchange.php');

///** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2859091738-I8oyl6LtKWElaNbjt9IwtpQKR2EnTIf4Qm7rfpJ",
    'oauth_access_token_secret' => "APpHbzQpHTnLwwaZMp5ALma2NtcLnihQc9sgFebZSvMym",
    'consumer_key' => "0sqH9KOA00t0fEifKDOLUBL1G",
    'consumer_secret' => "0CzRfQj8EZiXEl7hbNqdTGn6ibNxtS5ioANwKBpFuYAo4V5Y96"
);

$requestMethod = "GET";

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$getfield = 'screen_name=Vlambeer';


$twitter = new TwitterAPIExchange($settings);
$stringResponse = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest(true, [
        CURLOPT_SSL_VERIFYPEER => false
    ]);

$results = json_decode($stringResponse, true);

$i = 0;


foreach($results as $result)
{
    if (!isset($result['in_reply_to_user_id']) && !isset($result['retweeted_status'])) { //Kijkt of de tweet op de tijdlijn staat en geen reactie is
        echo '<li>';
            echo '<div class="complete_tweet flex fd-r jc-sb">';
                echo '<div class="tweet_profile_pic">';
                    echo '<img src="' . $result['user']['profile_image_url'] . '">';
                echo '</div>';
                echo '<div class="tweet_and_retweet">';
                    echo '<p>';
                    echo preg_replace('/(Vlam)/', '<span class="red">$1</span>', $result['user']['screen_name']);
                    echo '</p>';
                    echo '<p>';
                    echo substr($result['created_at'], 0, 16);
                    echo '</p>';
                    echo '<blockquote class="twitter-tweet">';
                        echo '<p>';
                        $resultTextReplace = str_replace("'", "", $result['text']);
                        $string = preg_replace('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', '<a href="$1" target="blank">$1</a>', $resultTextReplace);
                        $string = preg_replace('/(@\w+)/', '<span class="red">$1</span>', $string);
                        $string = preg_replace('/(#\w+)/', '<span class="red">$1</span>', $string);
                        echo $string;
                        echo '</p>';
                    echo '</blockquote>';
                echo '</div>';
            echo '</div>';
            echo '<br>';
        echo '</li>';
        $i++;
    }

    if ($i === 2) {
        break;
    }
}
