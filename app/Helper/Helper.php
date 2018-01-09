<?php

function userTimeToUTC($dateTime){
  return  \Carbon\Carbon::createFromFormat('Y-m-d H:i',  date('Y-m-d H:i',strtotime($dateTime)), 'Asia/Kolkata')->setTimezone('UTC');
}