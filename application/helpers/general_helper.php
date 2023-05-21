<?php

function readableDateIST($date)
{
    $date = new DateTime($date, new DateTimeZone('GMT'));
    $date->setTimezone(new DateTimeZone('IST'));
    return $date->format('j-m-Y, g:i a');
    // return $date->format('Y-m-d H:i:s');
}
