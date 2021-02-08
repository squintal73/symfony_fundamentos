<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClienteController extends AbstractController
{
    /**
     * @Route("/cliente", name="cliente")
     */
    public function index(Request $request)
    {
       var_dump(
        $request->query->all(),
        $request->query->get("teste","padrao"),
        $request->query->get("pessoa")["idade"]   
    );

       
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }
}
