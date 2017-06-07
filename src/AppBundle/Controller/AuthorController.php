<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends Controller
{
    /**
     * @Route("/autores", name="author_homepage")
     */
    public function indexAction(Request $request)
    {
        $authors = $this->get('app.author.service')->findAll();

        return $this->render('Author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/autor/{id}", name="author_detail")
     */
    public function showAction(Request $request, $id)
    {
        $author = $this->get('app.author.service')->findOneById($id);

        if (!($author instanceof Author) || empty($author)) {
            return $this->redirectToRoute('author_homepage');
        }

        $books = $this->get('app.book.service')->findAllByAuthorId($id);

        return $this->render('Author/show.html.twig', [
            'author' => $author,
            'books' => $books,
        ]);
    }
}
