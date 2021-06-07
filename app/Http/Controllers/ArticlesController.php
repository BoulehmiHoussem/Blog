<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use App\Articles;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $articles = Articles::all();
        return response()->json($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:100',
        'body' => 'required|string|max:250',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        


        $articles = Articles::create([
            'title' => $request->title,
            'body' => $request->body,
            'created_by' => $request->user()->id
        ]);

        return response(['success'=> "Article ajouté avec succes"], 200);
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:100',
        'body' => 'required|string|max:250',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $article = Articles::find($id);
        if(!empty($article))
        {
            $article->title = $request->title;
            $article->body = $request->body;
            $article->save();
            return response(['success'=> "Article modifié avec succes"], 200);


        }
        else{
            return response(['errors'=> "Article non trouvé"], 422);

        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $articles = Articles::find($id);
        if(!empty($articles))
        {
            $articles->delete();
            return response(['success'=> "Article supprimé avec succes"], 200);
        }
        else{
            return response(['errors'=> "Article non trouvé"], 422);
        }
    }
}
