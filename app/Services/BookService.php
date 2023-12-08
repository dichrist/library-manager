<?php 

namespace App\Services;

use App\Models\Book;
use App\Validators\BookValidator;
use Illuminate\Support\Facades\Validator;

class BookService 
{
    public function get()
    {
        try {

            $books = Book::all();

            return $books;

        } catch(\Exception $e){
            return ['errors' => $e->getMessage()];
        }

    }

    public function create(array $params)
    {
        try {

            $bookValidator = Validator::make(
                $params, 
                BookValidator::rules(), 
                BookValidator::messages()
            );

            if ($bookValidator->fails()) {
                return ['errors' => $bookValidator->errors()];
            }

            $book = Book::create($params);

            if (!$book) {
                return ['errors' => 'ERROR_CREATION_BOOK'];
            }

            return $book;

        } catch(\Exception $e) {
            return ['errors' => $e->getMessage()];
        }
    }
}