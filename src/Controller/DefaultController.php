<?php

namespace App\Controller;

use App\Service\AllegroClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/default", name="default")
     */
    public function index(AllegroClient $allegroClient)
    {
        $auctions = $allegroClient->getAuctions();

        var_dump($auctions);
    }

    /**
     * @Route("/default2", name="default2")
     */
    public function index2()
    {
        echo phpinfo();
    }
}
