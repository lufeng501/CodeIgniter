<?php
/**
 * Describe: 通用的方法
 * User: lufeng501206@gmail.com
 * Date: 2016-08-30 21:34
 */

/**
 * 返回json格式
 */
function echoJson($returnData)
{
    if(!isset($returnData['status'])){
        $returnData['status'] = 1;
    }
    echo json_encode($returnData);

}

/**
 * 成功返回
 */
function echoSuccess($msg,$status=1)
{
    $returnData['msg'] = $msg;
    $returnData['status'] = $status;
    echo json_encode($returnData);
}

/**
 * 错误返回
 */
function echoError($msg,$status=0)
{
    $returnData['msg'] = $msg;
    $returnData['status'] = $status;
    echo json_encode($returnData);
}

function _debug($data,$note = "debug_log")
{
    log_message("debug",$note.":\r\n".print_r($data,true));
}

/**
 * 过滤变量
 * @param $value
 * @return null
 */
function ff($value){
    return !isset($value) ? null : $value;
}