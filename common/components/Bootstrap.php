<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/12/2018
 * Time: 21:44
 */

namespace common\components;


use common\models\Project;
use common\models\TelegramSubscribe;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class Bootstrap extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Event::on(Project::className(), Project::EVENT_AFTER_INSERT, function(Event $e) {
            $name = $e->sender->name;
            $message = "Created project \"{$name}\"";
            $subscribers = TelegramSubscribe::find()
                ->select('chat_id')
                ->where(['channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE])
                ->column();

            foreach($subscribers as $subscriber) {
                /** @var \SonkoDmitry\Yii\TelegramBot\Component $bot */
                $bot = \Yii::$app->bot;
                $bot->sendMessage($subscriber, $message);
            }
        });

    }
}