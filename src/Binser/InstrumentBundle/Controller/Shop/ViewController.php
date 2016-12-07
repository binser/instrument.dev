<?php

namespace Binser\InstrumentBundle\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewController extends Controller
{
    public function indexAction()
    {
        return $this->render('BinserInstrumentBundle:Pages/Shop:index.html.twig', array());
    }
}
