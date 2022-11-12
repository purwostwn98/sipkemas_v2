<?php

set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno)
{
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
}

function encode_id($id = null)
{
    $return = '';
    if (@$id) {
        require_once(APPPATH . '/ThirdParty/hashids-1.0.5/lib/Hashids/HashGenerator.php');
        require_once(APPPATH . '/ThirdParty/hashids-1.0.5/lib/Hashids/Hashids.php');
        // require_once('../ThirdParty/hashids-1.0.5/lib/Hashids/HashGenerator.php');
        // require_once('../ThirdParty/hashids-1.0.5/lib/Hashids/Hashids.php');
        $hashids = new Hashids\Hashids('this is my salt', 32);
        $hash = $hashids->encode($id);
        $return = $hash;
    }
    return $return;
}



function decode_id($hash = null)
{
    $return = null;
    if (@$hash) {
        try {
            require_once(APPPATH . '/ThirdParty/hashids-1.0.5/lib/Hashids/HashGenerator.php');
            require_once(APPPATH . '/ThirdParty/hashids-1.0.5/lib/Hashids/Hashids.php');
            $hashids = new Hashids\Hashids('this is my salt', 32);
            $id = $hashids->decode($hash);
            $return = $id[0];
        } catch (Exception $e) {
            // pass
        }
    }
    return @$return;
}

function numberToRomawi($number)
{
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if ($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
