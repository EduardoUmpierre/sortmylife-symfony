<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $books = $this->get('app.book.service')->findAll();
        $authors = $this->get('app.author.service')->findAll();

        return $this->render('Default/index.html.twig', [
            'books' => $books,
            'authors' => $authors,
        ]);
    }
}
