<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BooksResource;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Booksresource::collection(Book::all());
        if(!$data){

            return response()->json(
                ['message'=>'Not Found any author'],404
            );
        }else{

            return response()->json([
                'message'=> 'Successful',
                'data'=> $data
            ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newbook = Book::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'publication_year'=>$request->input('publication_year')
        ]);

        return response()->json([
            'message'=> 'Successful',
            'data'=> new BooksResource($newbook)
        ],201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(int $book)
    {
        // return new BooksResource($book);
        $data = Book::find($book);
        try{
                if($data == null){
                    return response()->json(
                        ['message'=>'Not Found with '.$book],404
                    );
                }
                else{
        return response()->json([
                    'message'=> 'Successful',
                    'data'=> new BooksResource($data)
                ]
                );
                }

            }catch(\throw $e){
                return response()->json(
                    $e
                );

            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update(
            [
                'name'=> $request->input('name'),
                'description'=> $request->input('description'),
                'publication_year'=> $request->input('publication_year')

            ]
        );

        return response()->json([
            'message'=> 'Successful',
            'data'=> new BooksResource($book)
        ],
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book ->delete();
        return response()->json(['message'=>'Successful']);
    }
}
