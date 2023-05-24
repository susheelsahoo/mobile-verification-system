<?php

function readableDateIST($date)
{
    $date = new DateTime($date, new DateTimeZone('GMT'));
    $date->setTimezone(new DateTimeZone('IST'));
    return $date->format('j-m-Y, g:i a');
    // return $date->format('Y-m-d H:i:s');
}

function readableDateUTC($date)
{
    $date = new DateTime($date, new DateTimeZone('IST'));
    $date->setTimezone(new DateTimeZone('GMT'));
    return $date->format('Y-m-d H:i:s');
    // return $date->format('Y-m-d H:i:s');
}



function formatDate($date, $type)
{
    $strDate = strtotime($date);
    return date($type, $strDate);
}
