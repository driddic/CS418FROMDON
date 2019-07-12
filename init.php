<?php

function goToAuthUrl()
{
    if (!isset($_SESSION)) {
      session_start();
    }
    $_SESSION['githubUser'] = true;
    $client_id = "1538eb404c91cdf586ba";
    $redirect_url = "https://driddic.cs518.cs.odu.edu/callback.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $url = 'https://github.com/login/oauth/authorize?client_id='. $client_id. "&redirect_url=".$redirect_url."&scope=user";
        header("location: $url");
    }
}

function fetchData()
{
    $client_id = "d3d2e6483b9bb947af87";
    $redirect_url = "https://driddic.cs518.cs.odu.edu/callback.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $post = http_build_query(array(
                    'client_id' => $client_id,
                    'redirect_url' => $redirect_url,
                    'client_secret' => '199580542352ba420aa2bf7ccb96027b6baa62e2',
                    'code' => $code,

                ));
        }

        $access_data = file_get_contents("https://github.com/login/oauth/access_token?". $post);

        $exploded1 = explode('access_token=', $access_data);
        $exploded2 = explode('&scope=user', $exploded1[1]);

        $access_token = $exploded2[0];


        $opts = [ 'http' => [
                        'method' => 'GET',
                        'header' => [ 'User-Agent: PHP']
                    ]
        ];

        //fetching user data
        $url = "https://api.github.com/user?access_token=$access_token";
        $context = stream_context_create($opts);
        $data = file_get_contents($url, false, $context);


        $user_data = json_decode($data, true);
        $username = $user_data['login'];


        //fetching email data
        $url1 = "https://api.github.com/user/emails?access_token=$access_token";
        $emails = file_get_contents($url1, false, $context);
        $emails = json_decode($emails, true);

        $email = $emails[0];

        $userPayload = [
            'username' => $username,
            'email' => $email,
            'fetched from' => "github"
        ];
        $_SESSION['payload'] = $userPayload;
        $_SESSION['user'] = $username;
        $_SESSION['githubUser'] = "true";
        $_SESSION['email'] = $email;
        return $userPayload;

    }
    else {
        die('error');
    }
}
