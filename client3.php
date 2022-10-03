<!DOCTYPE html>
<html>
<head>
    <title>Belajar XML RPC</title>
</head>
<body>
    <form action="" method="POST">
        <label for="fname">NIM</label>
        <input type="text" name="nim"><br><br>

        <label for="lname">Nama</label>
        <input type="text" name="nama"><br><br>
        <input type="submit" value="Submit">
    </form> 
</body>
</html> 

<?php
if (isset($_POST['nim'])) {
    // request dari Client ke Server
    $request = xmlrpc_encode_request("method",array("nim"=>$_POST['nim'],"nama"=>$_POST['nama']));
    $context = stream_context_create(array('http' => array(
        'method' => "POST",
        'header' => "Content-Type:text/xml;charset=UTF-8",
        'content' => $request
    )));

    // ambil data dari Server
    $file = file_get_contents("http://192.168.56.30/rpc-xml-simple/server.php?user=pengguna&password=pin",false,$context);

    // response dari Server ke Client
    $response = xmlrpc_decode($file);
    if ($response && xmlrpc_is_fault($response)) {
        trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
    } else {
        echo "<pre>";
        print_r($response);
        echo "</pre>";
        echo "----------------------------------------------------";
        echo "<br/>nim : ".$response[0]['nim'];
        echo "<br/>nama : ".$response[0]['nama'];
    }
}
?>
