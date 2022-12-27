<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorsRequest;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AuthorResource::collection(Author::all());
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
    //    return 'test'
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorsRequest $request)
    {
        $newAuthor = Author::create([
            'name'=>$request->input('name')
        ]);

        return response()->json([
            'message'=> 'Successful',
            'data'=> new AuthorResource($newAuthor)
        ],201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show( $author)
    {


        $data = Author::find($author);
try{
        if($data == null){
            return response()->json(
                ['message'=>'Not Found with '.$author],404
            );
        }
        else{
return response()->json([
            'message'=> 'Successful',
            'data'=> new AuthorResource($data)
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
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorsRequest $request, Author $author)
    {
        $author->update(
            [
                'name'=> $request->input('name')
                // 'name' => 'DDDDDDDD'
            ]
        );

        return response()->json([
            'message'=> 'Successful',
            'data'=> new AuthorResource($author)
        ],
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author ->delete();
        return response()->json(['message'=>'Successful']);
    }
}
