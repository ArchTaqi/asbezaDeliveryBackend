<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/24/2019
 * Time: 4:25 PM
 */

namespace App\Socket;


class SelectorService
{

    public function onOpen() {

        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $msg =json_encode("Welcome");

        $conn->send($msg);


        echo "New connection! ({$conn->resourceId})\n";
    }
}