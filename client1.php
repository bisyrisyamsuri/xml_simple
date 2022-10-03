<?php
// ambil data dari Server
$file = file_get_contents("http://192.168.56.30/rpc-xml-simple/server.php?user=pengguna&password=pin",false,null);

// response dari Server ke Client
$response = xmlrpc_decode($file);
if ($response && xmlrpc_is_fault($response)) {
    trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
} else {
    echo "<pre>";
    print_r($response);
    echo "</pre>";
    echo "----------------------------------------------------";
    echo "<br/>nim : ".$response['nim'];
    echo "<br/>nama : ".$response['nama'];
    echo "<br/>kota : ".$response['kota'];
}
?>
