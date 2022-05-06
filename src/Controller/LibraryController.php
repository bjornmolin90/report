<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\Request;

class LibraryController extends AbstractController
{
    /**
    * @Route("/library", name="library")
    */
    public function index(BooksRepository $booksRepository): Response
    {
        $books = $booksRepository
            ->findAll();
        $title = "Library";
        $data = [
            'title' => $title,
            'books' => $books,
            'link_to_add' => $this->generateUrl('add'),
        ];
        return $this->render('library/index.html.twig', $data);
    }


    /**
    * @Route("/library/add", name="add", methods={"GET","HEAD"})
    */
    public function addBook()
    {

        return $this->render('library/add.html.twig', ['title' => "Add book"]);
    }


    /**
    * @Route("/library/add", name="add-process", methods={"POST"})
    */
    public function addBookProcess(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
            $entityManager = $doctrine->getManager();

            $title = $request->request->get('title');
            $author = $request->request->get('author');
            $isbn = $request->request->get('isbn');
            $image = $request->request->get('image');
            $book = new Books();
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setIsbn($isbn);
            $book->setImage($image);


            // tell Doctrine you want to (eventually) save the Product
            // (no queries yet)
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('library');
    }


    /**
        * @Route("/library/book/{id}", name="book")
        */
    public function showBook($id, BooksRepository $booksRepository): Response
    {
        $book = $booksRepository
            ->find($id);
        return $this->render('library/book.html.twig', ['title' => "Book", 'book' => $book]);
    }

    /**
    * @Route("/library/update/{id}", name="update", methods={"GET","HEAD"})
    */
    public function updateBook(
        int $id = null,
        BooksRepository $booksRepository
    ): Response {
            $book = $booksRepository
                ->find($id);


                return $this->render('library/update.html.twig', ['title' => "Update", 'book' => $book]);
    }

    /**
    * @Route("/library/update/{id}", name="uppdate-process", methods={"POST"})
    */
    public function updateBookProcess(
        ManagerRegistry $doctrine,
        Request $request,
        BooksRepository $booksRepository,
        $id
    ): Response {
            $entityManager = $doctrine->getManager();
            $book = $booksRepository
                ->find($id);

            $title = $request->request->get('title');
            $author = $request->request->get('author');
            $isbn = $request->request->get('isbn');
            $image = $request->request->get('image');

            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setIsbn($isbn);
            $book->setImage($image);

            $entityManager->persist($book);

            $entityManager->flush();

            return $this->redirectToRoute('library');
    }

    /**
    * @Route("/library/delete/{id}", name="delete", methods={"GET","HEAD"})
    */
    public function deleteBook(
        int $id = null,
        BooksRepository $booksRepository
    ): Response {
            $book = $booksRepository
                ->find($id);


                return $this->render('library/delete.html.twig', ['title' => "Delete", 'book' => $book]);
    }

    /**
    * @Route("/library/delete/{id}", name="delete-process", methods={"POST"})
    */
    public function deleteBookProcess(
        int $id = null,
        ManagerRegistry $doctrine,
        Request $request,
        BooksRepository $booksRepository
    ): Response {
            $entityManager = $doctrine->getManager();
            $book = $booksRepository
                ->find($id);


            $entityManager->remove($book);

            $entityManager->flush();

            return $this->redirectToRoute('library');
    }
}
