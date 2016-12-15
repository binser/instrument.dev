<?php

namespace Binser\InstrumentBundle\Controller;

use Intervention\Image\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends Controller
{
    public function indexAction()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Станок 34 95С',
                'price' => 1580,
                'image' => 'tmp/product.jpg'
            ],
            [
                'id' => 1,
                'name' => 'Станок 34 95С',
                'price' => 1580,
                'image' => 'tmp/product.jpg'
            ],
            [
                'id' => 1,
                'name' => 'Станок 34 95С',
                'price' => 1580,
                'image' => 'tmp/product.jpg'
            ]
        ];
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
}
