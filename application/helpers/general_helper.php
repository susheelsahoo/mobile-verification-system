<?php

function readableDateIST($date)
{
    $date = new DateTime($date, new DateTimeZone('UTC'));
    $date->setTimezone(new DateTimeZone('IST'));
    return $date->format('j-m-Y, g:i A');
    // return $date->format('Y-m-d H:i:s');
}

function readableDateUTC($date)
{
    $date = new DateTime($date, new DateTimeZone('IST'));
    $date->setTimezone(new DateTimeZone('UTC'));
    return $date->format('Y-m-d H:i:s');
    // return $date->format('Y-m-d H:i:s');
}



function formatDate($date, $type)
{
    $strDate = strtotime($date);
    return date($type, $strDate);
}
