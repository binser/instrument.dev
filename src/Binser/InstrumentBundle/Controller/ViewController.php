<?php

namespace Binser\InstrumentBundle\Controller;

use Intervention\Image\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends Controller
{
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Product')->getThreeLastAddProducts();
        return $this->render('BinserInstrumentBundle:Pages:index.html.twig', array(
            'products' => $products
        ));
    }

    public function blogAction(Request $request)
    {
        $posts = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Post')->getEnabledPosts();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('BinserInstrumentBundle:Pages:blog.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function blogPostAction($link)
    {
        $post = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Post')->find($link);
        if (!$post) {
            return new NotFoundException();
        }
        return $this->render('BinserInstrumentBundle:Pages:blog_post.html.twig', array(
            'post' => $post
        ));
    }

    public function aboutAction()
    {
        return $this->render('BinserInstrumentBundle:Pages:about.html.twig', array());
    }

    public function contactsAction()
    {
        return $this->render('BinserInstrumentBundle:Pages:contacts.html.twig', array());
    }

    public function educationAction()
    {
        return $this->render('BinserInstrumentBundle:Pages:education.html.twig', array());
    }

    public function examplesAction()
    {
        return $this->render('BinserInstrumentBundle:Pages:examples.html.twig', array());
    }

    public function servicesAction()
    {
        $services = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Service')->getEnabledServices();
        return $this->render('BinserInstrumentBundle:Pages:services.html.twig', array(
            'services' => $services
        ));
    }

    public function servicePostAction($link)
    {
        $service = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Service')->getPostByUrl($link);
        if ($service) {
            return new NotFoundException();
        }

        return $this->render('BinserInstrumentBundle:Pages:service_post.html.twig', array(
            'service' => $service
        ));
    }
}
