<?php

$app_id = '379310348787863';
$app_secret = '09c1f9d6f08a71dbbe1928c24e5745d4';
$my_url = 'https://fqldebugger.herokuapp.com/';

$code = $_REQUEST["code"];
$q = $_REQUEST["q"];
$json_output = $_REQUEST["json_output"];

//auth user
if (empty($code)) {
    $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id='
            . $app_id . '&redirect_uri=' . urlencode($my_url);
    echo("<script>top.location.href='" . $dialog_url . "'</script>");
}

//get user access_token
$token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
        . $app_id . '&redirect_uri=' . urlencode($my_url)
        . '&client_secret=' . $app_secret
        . '&code=' . $code;
$access_token = file_get_contents($token_url);

// Run fql query
$fql_query_url = 'https://graph.facebook.com/'
        . '/fql?q=' . urlencode($q)
        . '&' . $access_token;
$fql_query_result = file_get_contents($fql_query_url);
$fql_query_obj = json_decode($fql_query_result, true);

//display results of fql query
echo '<pre>';
print_r("<b>$q</b><br/>");
if (isset($json_output)) {
    print_r($fql_query_result);
} else {
    print_r($fql_query_obj);
}
echo '</pre>';
?>