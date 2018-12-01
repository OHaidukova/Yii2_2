<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 01/12/2018
 * Time: 17:36
 */

namespace console\controllers;


use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use yii\console\Controller;

class ServerController extends Controller
{
    public function actionWs() {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new \console\components\WsServer()
                )
            ),
            8080
        );

        $server->run();
    }
}