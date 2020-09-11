<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\frontOffice
 * @Route("/", name="home")
 */
class HomeController extends AbstractController
{


    public function __invoke(): Response {
        return $this->render("frontOffice/home.html.twig");
    }
}
