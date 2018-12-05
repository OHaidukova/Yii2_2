<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04/12/2018
 * Time: 21:35
 */

namespace frontend\controllers;


use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;

class TelegramController extends Controller
{
    public function actionReceive() {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        $updates = $bot->getUpdates();
        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $username = $message->getFrom()->getFirstName();
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username,
            ];
        };

        return $this->render("receive", ["messages" => $messages]);
    }

    public function actionSend() {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->sendMessage(347224157,'Test from Yii action');
    }

}