<?php 
//saved and chage by new IP!
$ip = ip_address();
$query = db_query("select ip, couter  from data where ip = :ip limit 1", array(":ip" => $ip ))->fetchAssoc();
if (isset($query['ip'])) {
	$counter =(int) $query['couter'] + 1;
	db_update('data')->fields(array(
    'ip' => $ip,
    'couter' => $counter,
    'browser' => $_SERVER['HTTP_USER_AGENT'],
    'browser_lang' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
  ))
->condition('ip', $ip, '=')
->execute();
} else {
db_insert('data')
  ->fields(array(
    'ip' => $ip,
    'couter' => 1,
    'browser' => $_SERVER['HTTP_USER_AGENT'],
    'browser_lang' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
  ))->execute();

}
