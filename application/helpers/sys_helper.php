<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pass_compare($sys, $cli)
{
    return $sys == md5($cli);
}   

?>