<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Persona;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class UsersController extends Controller
{
/* le indicamos el método http, el nombre de la acción y action para decirle que esto es una acción del controlador */
    public function getUsersAction()
    {
          $em = $this->getDoctrine()->getManager();
          $personas = $em->getRepository('AppBundle:Persona')->findAll();



          $encoders = array(new JsonEncoder());
          $normalizers = array(new ObjectNormalizer());

          $serializer = new Serializer($normalizers, $encoders);


$response = new Response();
          $response->setContent($serializer->serialize($personas, 'json'));

          $response->headers->set('Content-Type', 'text/json');
$response->headers->set('Access-Control-Allow-Origin', '*');
        //  $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        return $response;
    }

}
