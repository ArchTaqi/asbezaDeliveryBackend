<?php
namespace App\Socket;
use App\Controller\StatusController;
use App\Entity\Status;

use PDO;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use WebSocket\BadOpcodeException;
use Doctrine\ORM\EntityManagerInterface;

class Socket implements MessageComponentInterface {

    protected $clients;
    protected $database;
    protected $db;



    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->db = new Database();

        $this->database =$this->db->connect();
        $this->database->beginTransaction();
        $query = 'DELETE FROM socket';

        $stmt = $this->database->prepare($query);

        if($stmt->execute()) {
            $this->database->commit();

            echo("deleted from db \n");
        }else{
            echo("failed to insert to db");
        }

    }

    public function onOpen(ConnectionInterface $conn) {

        // Store the new connection to send messages to later

        $querystring = $conn->httpRequest->getUri();
        $url_components = parse_url($querystring);

// Use parse_str() function to parse the
// string passed via URL
        parse_str($url_components['query'], $params);


        $this->clients->attach($conn);
//        echo("Clients ".$this->clients);


        $this->database =$this->db->connect();
        $this->database->beginTransaction();
        $query = 'INSERT INTO socket SET resId = :resId, companyId = :companyId, userId =:userId';


        $stmt = $this->database->prepare($query);

        $resId=$conn->resourceId;
        $companyId =(int)$params['companyId'];
        $userId=(int)$params['userId'];

        $stmt->bindParam(':resId', $resId);
        $stmt->bindParam(':companyId', $companyId);
        $stmt->bindParam(':userId', $userId);


        if($stmt->execute()) {
            $this->database->commit();

           echo("inserted to db \n");
        }else{
            echo("failed to insert to db \n");
        }




      $request_url=  'http://localhost/et-stock-manager-socket/public/rest/report/companyTodayReport?companyId='.$params['companyId'];



        $msg = $this->requestEndpoint($request_url);

        $conn->send($msg);



        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {


        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');


        $message= json_decode($msg, true);
        echo $message['companyId'];


        $this->database =$this->db->connect();

        $query = 'SELECT * FROM socket WHERE companyId = :companyId';
        $stmt = $this->database->prepare($query);
        $companyId=$message['companyId'];

        $stmt->bindParam(':companyId', $companyId);
       $stmt->execute();
       $num = $stmt ->rowCount();

        echo(">>>>>>>>>>>>>>>>>>>>>> count == ".$num."\n");
       if($num>0){
           try{
               $request_url=  'http://localhost/et-stock-manager-socket/public/rest/report/companyTodayReport?companyId='.$message['companyId'];

               $msg = $this->requestEndpoint($request_url);

               while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   extract($row);
                   $result=$row['resId'];
                   echo (">>>>>>>>>>>>>>>>>>>> Res id =  ".$result);
                   foreach ($this->clients as $client) {
                       if ($from !== $client && $client->resourceId==$result) {
                           // The sender is not the receiver, send to each client connected
                           $client->send($msg);
                       }
                   }

               }


           }catch (\PDOException $ex){
               echo ("XXXXXXXXXXXXXXXX ERROR ".$ex->getMessage());
           }


        }else{
            echo("failed to insert to db");
        }






    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        $this->database =$this->db->connect();
        $this->database->beginTransaction();
        $query = 'DELETE FROM socket WHERE resId = :resId';


        $stmt = $this->database->prepare($query);

        $resId=$conn->resourceId;


        $stmt->bindParam(':resId', $resId);

        // Execute query
        // try{
        if($stmt->execute()) {
            $this->database->commit();

            echo("deleted from db \n");
        }else{
            echo("failed to insert to db");
        }



        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }


    /**
     * @return \SplObjectStorage
     */
    public function getClients(): \SplObjectStorage
    {
        return $this->clients;
    }

    /**
     * @param \SplObjectStorage $clients
     */
    public function setClients(\SplObjectStorage $clients): void
    {
        $this->clients = $clients;
    }


    private function requestEndpoint($request_url){
        $ch = curl_init($request_url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);

        return $response_json;
    }

}