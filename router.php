<?php
session_start();
$isForm = false;
$isUpload = false;
$rawData = file_get_contents("php://input");
header('Content-Type: text/javascript');
if(!empty($rawData)) {
    $data = json_decode($rawData);
}else{
    $data = json_decode($_POST['param']);
}
require('config.php');
class Action {
    public $action;
    public $method;
    public $data;
}
function doRpc($cdata){
    global $API;
    try {
        if(!isset($API[$cdata->action])){
            throw new Exception('Call to undefined action: ' . $cdata->action);
        }

        $action = $cdata->action;
        $action = str_replace([ "?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", '"', "&", "$", "#", "*", "(", ")", "|", "~", "." ], "", $action);
        $action=str_replace(chr(0), '', $action);
        $a = $API[$action];

        doAroundCalls($a['before'], $cdata);

        $method = $cdata->method;
        $method = str_replace([ "?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", '"', "&", "$", "#", "*", "(", ")", "|", "~", "." ], "", $method);
        $method=str_replace(chr(0), '', $method);
        $mdef = $a['methods'][$method];
        if(!$mdef){
            throw new Exception("Call to undefined method: $method on action $action");
        }
        doAroundCalls($mdef['before'], $cdata);

        $r = array(
            'action'=>$action,
            'method'=>$method
        );
        require_once("classes/".$action.".php");
        $o = new $action();
        if (isset($mdef['len'])) {
            $params = isset($cdata->data) && is_array($cdata->data) ? $cdata->data : array();
        } else {
            $params = json_decode($cdata->data);
        }
        if(!empty($params)){
            $r['result'] = call_user_func_array(array($o, $method), $params);
            doAroundCalls($mdef['after'], $cdata, $r);
            doAroundCalls($a['after'], $cdata, $r);
        }
    }
    catch(Exception $e){
        $r['type'] = 'exception';
        $r['message'] = $e->getMessage();
        $r['where'] = "everywhere";
    }
    return $r;
}

function doAroundCalls(&$fns, &$cdata, &$returnData=null){
    if(!$fns){
        return;
    }
    if(is_array($fns)){
        foreach($fns as $f){
            $f($cdata, $returnData);
        }
    }else{
        $fns($cdata, $returnData);
    }
}

$response = null;
if (is_array($data)) {
    $response = array();
    foreach($data as $d){
        $response[] = doRpc($d);
    }
} else {
    $response = doRpc($data);
}
if (!empty($response)){
    echo json_encode($response);
}
?>
