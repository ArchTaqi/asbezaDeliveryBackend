<?php

namespace App\Controller;

use App\DTO\DefaultResponseDTO;
use App\Entity\Measuringunit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/rest/measuringunit")
 */
class MeasuringunitController extends AbstractController
{
    /**
     * @Route("/listAll", name="measuringunit_index", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns List of Item Measuring Units",
     *      @SWG\Schema(type="array",
     *     @SWG\Items(ref=@Model(type=DefaultResponseDTO::class))
     *      ))
     *
     *     )
     * @SWG\Tag(name="Measuring Unit")
     *
     */
    public function listAll(): Response
    {
        $measuringunits = $this->getDoctrine()
            ->getRepository(Measuringunit::class)
            ->findAll();

        $unitLIst=array();
        foreach ($measuringunits as $unit) {

            $defaultResponseDto = new DefaultResponseDTO();

            $defaultResponseDto->setId($unit->getId());
            $defaultResponseDto->setName($unit->getName());
            $defaultResponseDto->setDescription($unit->getDescription());

            array_push($unitLIst, $defaultResponseDto);
        }
        return $this->json($unitLIst);
    }


}
