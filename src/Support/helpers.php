<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 4/29/19
 * Time: 9:53 PM
 */
function sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks)
{
    return (new \Manuelgeek\MpesaB2C\B2C())->sendMpesaMoney($Amount,$CommandID,$PartyB, $Remarks);
}
