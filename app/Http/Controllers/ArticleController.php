<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Article;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Image;
use File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::select(
            'id',
            'title',
            'date',
            'url'
            )
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $imageName = $request->file('image')->getClientOriginalName();        

        $newArticle = new Article;
        $newArticle->title = $request->title;
        $newArticle->description = $request->description;
        $newArticle->date = Carbon::now();
        $newArticle->image = $imageName;
        $newArticle->save();


        if ($newArticle) {

            if (!is_dir(public_path('/images/articles/'))) {
                File::makeDirectory(public_path( '/images/articles/'), 0777, true);
            };

            Image::make($request->file('image'))->save(public_path('/images/articles/'.  $imageName));
        }
        
        
        return redirect('/articles')->with('message', 'Article added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::select(
            'title',
            'description',
            'date',
            'url',
            'image_link',
            'image'
            )
            ->where('id', $id)
            ->first();

        return view('crud.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::select(
            'id',
            'title',
            'description',
            'image_link',
            'image'
            )
            ->where('id', $id)
            ->first();

        return view('crud.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'image_link' => NULL,
            'url' => NULL
        ];

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName(); 
            Image::make($request->file('image'))->save(public_path('/images/articles/'.  $imageName));
            $data['image'] = $imageName;
        }

        Article::where('id', $id)->update($data);

        return redirect('/articles')->with('message', 'Article updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();

        return redirect('/articles')->with('message', 'Article deleted!');
    }


    public function getSavedArticles () {
        $artilces = Article::select([
            'id',
            'title',
            'date',
            'url'
        ])->orderBy('id', 'desc'); 
        return Datatables::of($artilces)
            ->addColumn('DT_RowId', function ($article) {
                return $article->id;
            })
            ->addColumn('title', function ($article) {
                return $article->title;
            })
            ->addColumn('date', function ($article) {
                return $article->date;
            })
            ->addColumn('url', function ($article) {
                return  view('datatable.url_column', ['articleUrl' => $article->url]);
            })
            ->addColumn('show', function ($article) {
                return view('datatable.show_column', ['articleId' => $article->id]);
            })
            ->addColumn('update', function ($article) {
                return view('datatable.update_column', ['articleId' => $article->id]);
            })
            ->addColumn('delete', function ($article) {
                return view('datatable.delete_column', ['articleId' => $article->id]);
            })
            ->rawColumns(['url', 'show', 'update', 'delete'])
            ->make(true);
    }
}
