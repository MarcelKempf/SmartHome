<?php

$data = json_decode($_POST["DATA"]);
$systemCode = $data->{'systemcode'};
$unitCode = $data->{'unitcode'};
$status = $data->{'status'};
echo "WirelessSocket: ".$data->{'socket'}." || ".$systemCode." ".$unitCode." ".$status;

exec("sudo /var/www/html/send ".$systemCode." ".$unitCode." ".$status);

?>
