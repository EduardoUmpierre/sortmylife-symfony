<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * @Route("/livros", name="book_homepage")
     */
    public function indexAction(Request $request)
    {
        $books = $this->get('app.book.service')->findAll();

        return $this->render('Book/index.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/livro/{id}", name="book_detail")
     */
    public function showAction(Request $request, $id)
    {
        $book = $this->get('app.book.service')->findOneById($id);

        if (!($book instanceof Book) || empty($book)) {
            return $this->redirectToRoute('book_homepage');
        }

        $author = $this->get('app.author.service')->findOneById($book->getAuthor()->getId());

        return $this->render('Book/show.html.twig', [
            'authors' => [$author],
            'book' => $book,
        ]);
    }
}
