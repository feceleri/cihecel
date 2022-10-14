<?php

namespace App\Libraries;

class Resource {

    function dates($oldData)
    {
        // $oldData = $value->entrada;
        $orgDate = $oldData;
        $date = str_replace('-', '/', $orgDate);
        $newDate = date("d/m/Y", strtotime($date));
        return $newDate;
    } 
}