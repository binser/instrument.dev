<?php

namespace Binser\InstrumentBundle\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ViewController extends Controller
{
    public function indexAction()
    {
        return $this->render('BinserInstrumentBundle:Pages/Shop:index.html.twig', array());
    }

    public function categoryProductsAction($categoryUrl)
    {
        $category = $this->getDoctrine()
            ->getRepository('BinserInstrumentBundle:Category')
            ->getCategoryByUrl($categoryUrl);
        if (!$category) {
            return new NotFoundHttpException();
        }

        $products = $category->getProducts();
        return $this->render('BinserInstrumentBundle:Pages/Shop:products.html.twig', array(
            'products' => $products
        ));
    }

    public function subcategoryProductsAction($categoryUrl, $subcategoryUrl)
    {
        $category = $this->getDoctrine()
            ->getRepository('BinserInstrumentBundle:Category')
            ->getCategoryByUrl($categoryUrl);
        $subcategory = $this->getDoctrine()
            ->getRepository('BinserInstrumentBundle:SubCategory')
            ->getCategoryByCategoryAndUrl($category, $subcategoryUrl);
        if (!$subcategory) {
            return new NotFoundHttpException();
        }

        $products = $subcategory->getProducts();
        return $this->render('BinserInstrumentBundle:Pages/Shop:products.html.twig', array(
            'products' => $products
        ));
    }

    public function productAction($productId)
    {
        $product = $this->getDoctrine()->getRepository('BinserInstrumentBundle:Product')->find($productId);
        if (!$product) {
            return new NotFoundHttpException();
        }

        return $this->render('BinserInstrumentBundle:Pages/Shop:product.html.twig', array(
            'product' => $product
        ));


    }

    public function searchProductsAction($searchString)
    {
        $decodeSearchString = urldecode($searchString);
        $products = $this->getDoctrine()
            ->getRepository('BinserInstrumentBundle:Product')
            ->findProductsByString($decodeSearchString);

        return $this->render('BinserInstrumentBundle:Pages/Shop:products.html.twig', array(
            'products' => $products
        ));
    }
}
