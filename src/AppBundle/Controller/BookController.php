<?php

namespace AppBundle\Controller;

use AdminBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/livro/favoritar")
     * @Method("POST")
     */
    public function favoriteAction(Request $request)
    {
        $user = $this->get('app.user.service')->findOneById($request->get('user'));
        $book = $this->get('app.book.service')->findOneById($request->get('book'));

        $this->get('app.user_book.service')->favorite($user, $book);

        return new Response();
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

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $favorite = $this->get('app.user_book.service')->findOneByUserAndBook($this->getUser()->getId(), $id);
        }

        return $this->render('Book/show.html.twig', [
            'authors' => [$author],
            'book' => $book,
            'favorite' => isset($favorite) ? $favorite : null,
            'read' => isset($read) ? $read : null,
            'wantToRead' => isset($wantToRead) ? $wantToRead : null,
        ]);
    }
}
