<?php
/**
 * Created by PhpStorm.
 * User: yaseen
 * Date: 10/24/2017
 * Time: 7:43 AM
 */

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages as f;



class BookController extends Controller
{

    public function getBook(Request $request, Response $response)
    {

        return $this->view->render($response, 'lib/book.twig');

        Manager::schema()->create('books', function ($table){
            $table->increments('id');
            $table->string('name');
            $table->string('author');
            $table->timestamps();
        });

    }
    public function postBook()
    {


    }

    public function twa(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty(),
            'author' => v::notEmpty(),
        ]);


        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('lib.book'));
        }

        $book = Book::create([
            'name' => $request->getParam('email'),
            'author' => $request->getParam('name'),
        ]);


        $f = new f();
        $f->addMessage('info', 'add Book successful !');
        return $response->withRedirect($this->router->pathFor('lib.book'));
    }
}