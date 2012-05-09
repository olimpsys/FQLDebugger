<?php
$app_id = '379310348787863';
$app_secret = '09c1f9d6f08a71dbbe1928c24e5745d4';
$my_url = 'https://fqldebugger.herokuapp.com/';

$code = $_REQUEST["code"];

//auth user
if (empty($code)) {
    $dialog_url = 'https://www.facebook.com/dialog/oauth?client_id='
            . $app_id . '&scope=email,user_about_me,user_activities,user_birthday,user_education_history,user_groups,user_hometown,user_interests,user_likes,user_location,user_questions,user_relationships,user_relationship_details,user_religion_politics,user_subscriptions,user_website,user_work_history,user_checkins,user_events,user_games_activity,user_notes,user_photos,user_status,user_videos,friends_about_me,friends_activities,friends_birthday,friends_education_history,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_questions,friends_relationships,friends_relationship_details,friends_religion_politics,friends_subscriptions,friends_website,friends_work_history,friends_checkins,friends_events,friends_games_activity,friends_notes,friends_photos,friends_status,friends_videos,publish_actions,user_online_presence,friends_online_presence,publish_stream,read_mailbox,read_stream,export_stream,offline_access,status_update,photo_upload,video_upload,create_note,share_item,create_event,rsvp_event,read_friendlists,read_requests,read_insights&redirect_uri=' . urlencode($my_url);
    echo("<script>top.location.href='" . $dialog_url . "'</script>");
}
?>

<form action="fqlquery.php" method="post">
    FQL Query:
    <br/>
    <textarea name="q" rows="10" cols="100"></textarea>
    <br/>
    <input type="submit" value="query" />
    <input type="checkbox" name="json_output" value="yes" />JSON output
    <input type="hidden" name="code" value="<?= $code ?>" />
</form>
<a href="http://developers.facebook.com/docs/reference/fql/" target="_blank">Docs</a>
<br/>
<b>Query:</b> SELECT uid2 FROM friend WHERE uid1=me()
<br/>
<b>Multi-query: </b>{"all friends":"SELECT uid2 FROM friend WHERE uid1=me()", "my name":"SELECT name FROM user WHERE uid=me()"}
