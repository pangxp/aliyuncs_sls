<?php
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

require __DIR__ . '/../vendor/autoload.php';

use SLS\Client;
use SLS\Models\LogItem;
use SLS\Models\Request\PutLogsRequest;
use SLS\Models\Request\ListShardsRequest;
use SLS\Models\Request\ListTopicsRequest;
use SLS\Models\Request\MergeShardsRequest;
use SLS\Models\Request\DeleteShardRequest;
use SLS\Models\Request\SplitShardRequest;
use SLS\Models\Request\GetCursorRequest;
use SLS\Models\Request\BatchGetLogsRequest;
use SLS\Models\Request\ListLogstoresRequest;
use SLS\Models\Request\GetHistogramsRequest;
use SLS\Models\Request\GetLogsRequest;

function putLogs(Client $client, $project, $logstore) {
    $topic = 'TestTopic';
    
    $contents = array( // key-value pair
        'TestKey'=>'TestContent'
    );
    $logItem = new LogItem();
    $logItem->setTime(time());
    $logItem->setContents($contents);
    $logitems = array($logItem);
    $request = new PutLogsRequest($project, $logstore, 
            $topic, null, $logitems);
    
    try {
        $response = $client->putLogs($request);
        var_dump($response);
    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}

function listLogstores(Client $client, $project) {
    try{
        $request = new ListLogstoresRequest($project);
        $response = $client->listLogstores($request);
        var_dump($response);
    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}


function listTopics(Client $client, $project, $logstore) {
    $request = new ListTopicsRequest($project, $logstore);
    
    try {
        $response = $client->listTopics($request);
        var_dump($response);
    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}

function getLogs(Client $client, $project, $logstore) {
    $topic = 'TestTopic';
    $from = time()-3600;
    $to = time();
    $request = new GetLogsRequest($project, $logstore, $from, $to, $topic, '', 100, 0, False);
    
    try {
        $response = $client->getLogs($request);
        foreach($response -> getLogs() as $log)
        {
            print $log -> getTime()."\t";
            foreach($log -> getContents() as $key => $value){
                print $key.":".$value."\t";
            }
            print "\n";
        }

    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}

function getHistograms(Client $client, $project, $logstore) {
    $topic = 'TestTopic';
    $from = time()-3600;
    $to = time();
    $request = new GetHistogramsRequest($project, $logstore, $from, $to, $topic, '');
    
    try {
        $response = $client->getHistograms($request);
        var_dump($response);
    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
function listShard(Client $client,$project,$logstore){
    $request = new ListShardsRequest($project,$logstore);
    try
    {
        $response = $client -> listShards($request);
        var_dump($response);
    } catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
function batchGetLogs(Client $client,$project,$logstore)
{
    $listShardRequest = new ListShardsRequest($project,$logstore);
    $listShardResponse = $client -> listShards($listShardRequest);
    foreach($listShardResponse-> getShardIds()  as $shardId)
    {
        $getCursorRequest = new GetCursorRequest($project,$logstore,$shardId,null, time() - 60);
        $response = $client -> getCursor($getCursorRequest);
        $cursor = $response-> getCursor();
        $count = 100;
        while(true)
        {
            $batchGetDataRequest = new BatchGetLogsRequest($project,$logstore,$shardId,$count,$cursor);
            var_dump($batchGetDataRequest);
            $response = $client -> batchGetLogs($batchGetDataRequest);
            if($cursor == $response -> getNextCursor())
            {
                break;
            }
            $logGroupList = $response -> getLogGroupList();
            foreach($logGroupList as $logGroup)
            {
                print ($logGroup->getCategory());

                foreach($logGroup -> getLogsArray() as $log)
                {
                    foreach($log -> getContentsArray() as $content)
                    {
                        print($content-> getKey().":".$content->getValue()."\t");
                    }
                    print("\n");
                }
            }
            $cursor = $response -> getNextCursor();
        }
    }
}
function deleteShard(Client $client,$project,$logstore,$shardId)
{
    $request = new DeleteShardRequest($project,$logstore,$shardId);
    try
    {
        $response = $client -> deleteShard($request);
        var_dump($response);
    }catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
function mergeShard(Client $client,$project,$logstore,$shardId)
{
    $request = new MergeShardsRequest($project,$logstore,$shardId);
    try
    {
        $response = $client -> mergeShards($request);
        var_dump($response);
    }catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
function splitShard(Client $client,$project,$logstore,$shardId,$midHash)
{
    $request = new SplitShardRequest($project,$logstore,$shardId,$midHash);
    try
    {
        $response = $client -> splitShard($request);
        var_dump($response);
    }catch (SlsException $ex) {
        var_dump($ex);
    } catch (Exception $ex) {
        var_dump($ex);
    }
}

$endpoint = 'http://cn-hangzhou-yunlei-intranet.log.aliyuncs.com';
$accessKeyId = '';
$accessKey = '';
$project = 'ali-cn-yunlei-sls-admin';
$logstore = 'sls_operation_log';
$token = "";


$client = new Client($endpoint, $accessKeyId, $accessKey,$token);

// listShard($client,$project,$logstore);
// mergeShard($client,$project,$logstore,82);
// deleteShard($client,$project,$logstore,21);
// splitShard($client,$project,$logstore,84,"0e000000000000000000000000000000");
// putLogs($client, $project, $logstore);
// batchGetLogs($client,$project,$logstore);
listLogstores($client, $project);
// listTopics($client, $project, $logstore);
// getHistograms($client, $project, $logstore);
// getLogs($client, $project, $logstore);
