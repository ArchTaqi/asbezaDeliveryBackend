<?php

namespace App\Controller;

use App\Command\SocketCommand;
use App\DTO\DefaultResponseDTO;
use App\Entity\Status;
use App\Services\CalendarExchangeService;
use App\Socket\Socket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Ratchet\WebSocket\WsConnection;

require __DIR__ . '/../../vendor/autoload.php';
use WebSocket\Client;

use AfricasTalking\SDK\AfricasTalking;




/**
 * @Route("/rest/status")
 *
 */
class StatusController extends AbstractController
{
    /**
     * @Route("/listAll", name="status_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="Statuses")
     *
     */
    public function index(): Response
    {
        $statuses = $this->getDoctrine()->getRepository(Status::class)->findAll();

        $statusLIst=array();

//        $status= new Status();

        foreach ($statuses as $status){

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($status->getId());
            $defaultResponseDto->setName($status->getName());
            $defaultResponseDto->setDescription($status->getDescription());

            array_push($statusLIst,$defaultResponseDto);

    }

    return  $this->json($statusLIst);

    }

    /**
     * @Route("/sendSMS", name="status_sms", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="Statuses")
     *
     */
    public function sendSms(): Response
    {
        $username = 'coderbob'; // use 'sandbox' for development in the test environment
        $apiKey   = 'd5a4a77985c0717e4ee1a70c25e50bb33d129de773fab5c1c097d6239e7a09b8'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

// Get one of the services
        $sms      = $AT->sms();

// Use the service
        $result   = $sms->send([
            'to'      => '+251911819739',
            'message' => 'Hello World! from yene Stock ውድ ደንበኛ አማርኛ ሙከራ'
        ]);

        print_r($result);

        return  $this->json($result);

    }

    /**
     * @Route("/calendar", name="status_calendar", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     * @SWG\Tag(name="Statuses")
     *
     * @throws \WebSocket\BadOpcodeException
     */
    public function calendar()
    {


        $statusLIst=$this->socketService();



        $client = new Client("ws://localhost:1234/");
        $msg =json_encode($statusLIst);

        $client->send($msg);

        echo $client->receive(); // Will output 'Hello WebSocket.org!'
    }

    /**
     * @Route("/socket", name="status_socket", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Statuses",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="Statuses")
     * @throws \WebSocket\BadOpcodeException
     */
    public function socket()
    {
        require __DIR__ . '/../../vendor/autoload.php';


        $client = new Client("localhost:1234");
//        $client->send("Hello WebSocket.org!");

        echo $client->receive(); // Will output 'Hello WebSocket.org!'
    }


    public function socketService(): array
    {


        $statuses = $this->getDoctrine()->getRepository(Status::class)->findAll();

        $statusLIst=array();

//        $status= new Status();

        foreach ($statuses as $status){

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($status->getId());
            $defaultResponseDto->setName($status->getName());
            $defaultResponseDto->setDescription($status->getDescription());

            array_push($statusLIst, $defaultResponseDto);

        }

return $statusLIst;
    }


}
