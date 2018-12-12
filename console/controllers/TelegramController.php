<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05/12/2018
 * Time: 21:55
 */

namespace console\controllers;


use common\models\TelegramOffset;
use common\models\TelegramSubscribe;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var Component */
   private $bot;
   private $offset = 0;

   public function init()
   {
       parent::init();
       $this->bot = \Yii::$app->bot;
   }

    public function actionIndex() {
       $updates = $this->bot->getUpdates($this->getOffset() + 1);
       $updateCount = count($updates);
       if($updateCount > 0) {
           echo "Count of new messages: " . $updateCount . PHP_EOL;
           foreach ($updates as $update) {
               $this->updateOffset($update);
               if($message = $update->getMessage()) {
                   $this->processCommand($message);
               }
           }
       } else {
           echo "No new messages" . PHP_EOL;
       }
   }

   private function getOffset() {
       $max = TelegramOffset::find()
           ->select('id')
           ->max('id');

       if($max > 0) {
           $this->offset = $max;
       }
       return $this->offset;
   }

   private function updateOffset(Update $update) {
       $model = new TelegramOffset([
           'id' => $update->getUpdateId(),
           'timestamp_offset' => date('Y-m-d H:i:s')
       ]);
       $model->save();
   }

   private function processCommand(Message $message) {
//       var_dump($message->getText());
       $param = explode(" ", $message->getText());

       $response = "Unknown command";
       $command = $param[0];
       switch($command) {
           case "/help":
               $response = "Commands: \n";
               $response .= "/help - commands list \n";
               $response .= "/subsc_project_create - subscribe on create project \n";
               break;
           case "/subsc_project_create":
               $model = new TelegramSubscribe([
                   'chat_id' => $message->getFrom()->getId(),
                   'channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE
               ]);
               $model->save();

               $response = "You subscribed";
       };

       $this->bot->sendMessage($message->getFrom()->getId(), $response);
   }

}