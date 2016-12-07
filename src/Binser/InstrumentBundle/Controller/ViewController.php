<?php

namespace Binser\InstrumentBundle\Controller;

use Intervention\Image\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function blogAction()
    {
        $posts = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Post')->getEnabledPosts();
        return $this->render('BinserInstrumentBundle:Pages:blog.html.twig', array(
            'posts' => $posts
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
