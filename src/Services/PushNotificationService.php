<?php


namespace App\Services;

use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;
use Symfony\Component\HttpFoundation\Response;

class PushNotificationService
{


    /**
     * PushNotificationService constructor.
     */
    public function __construct()
    {
    }


    public function testNotifications(String $body, string $noToken, int $actionType, int $actionValue){

        $serverKey = 'AAAAff1Uxu4:APA91bF4wgkRUGoPHTO56KeFB2MEOzAQJBRM0TEEmHU6dQKZaSsqSjlWeDbL-YPl1qMyJDJMHE-w08uTHkcL7xQWC2e5O8pEmiPcYBVf6g93HE7CC-XoGb8FWX3ecv0zJnwbDG-8lSfe';
        $senderId = "541121103598";
        $token = $noToken;


        $client = new Client();
        $client->setApiKey($serverKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $note = new Notification('test title', 'testing body');
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = new Message();
        $message->addRecipient(new Device($token));
        $message->setNotification($note)
            ->setData(array('actionType'=>$actionType, 'actionValue'=>$actionValue, 'body' => $body));

        $response = $client->send($message);
    }

    public function pushSilentNotifications(Response $passedData, int $actionType, int $actionValue, String $noToken)
    {

        /*
         * Action Types
         *
         *   1 - Categories
         *   2 - Items
         *   3 - Orders
         */

        /*
        * Action Values
        *
        *   1 - Create
        *   2 - Update
        *   3 - Delete
        */



        $serverKey = 'AAAAff1Uxu4:APA91bF4wgkRUGoPHTO56KeFB2MEOzAQJBRM0TEEmHU6dQKZaSsqSjlWeDbL-YPl1qMyJDJMHE-w08uTHkcL7xQWC2e5O8pEmiPcYBVf6g93HE7CC-XoGb8FWX3ecv0zJnwbDG-8lSfe';
        $senderId = "541121103598";
        $token = $noToken;

        $body = $passedData->getContent();



        $client = new Client();
        $client->setApiKey($serverKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $note = new Notification('test title', 'testing body');
//        $note->setIcon('notification_icon_resource_name')
//            ->setColor('#ffffff')
//            ->setBadge(1);

        $message = new Message();
        $message->addRecipient(new Device($token));
        $message->setNotification($note)
            ->setData(array('actionType'=>$actionType, 'actionValue'=>$actionValue, 'body' => $body));

        $response = $client->send($message);


    }
}