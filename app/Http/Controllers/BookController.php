<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\{Request, Response};

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->get();

        if (!$books || isset($books['errors'])) {
            
            $errors = null;

            if( isset($books['errors']) ) {
                $errors = $books['errors'];
            }

            return response()->json([
                'payload' => null,
                'message' => 'COULD_NOT_RETURN_BOOKS_LIST',
                'errors'  => $errors

            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'payload' => $books,
            'message' => 'BOOKS_LIST_RETURNED_SUCESSFULLY'
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $book = $this->bookService->create($request->all());

        if (!$book || isset($book['errors'])) {
            
            $errors = null;

            if( isset($book['errors']) ) {
                $errors = $book['errors'];
            }

            return response()->json([
                'payload' => null,
                'message' => 'COULD_NOT_CREATE_BOOK',
                'errors'  => $errors

            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'payload' => $book,
            'message' => 'BOOK_CREATED_SUCCESSFULLY'
        ], Response::HTTP_CREATED);
    }
}
