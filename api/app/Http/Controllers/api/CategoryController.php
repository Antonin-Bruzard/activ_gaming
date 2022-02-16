<?php

namespace App\Http\Controllers\api;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('Authorization:category-create', ['only' => ['create']]);
        $this->middleware('Authorization:category-edit', ['only' => ['update']]);
        $this->middleware('Authorization:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Return validation rules.
     * @return array
     */
    public function formRules()
    {
        return [
            'title' => 'required|max:50',
            'description' => 'sometimes|min:6|max:300',
            'image_id' => 'sometimes'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('thumbnail')
            ->get();

        return response($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $formValidator = Validator::make($req->toArray(), $this->formRules());

        if ($formValidator->fails()) {
            return response([
                'success' => false,
                'formErrors' => $formValidator->errors()
            ]);
        } else {

        /* Set a slug from title if not exist */
            if (empty($req->slug)) {
                $req->merge(['slug' => Str::slug($req->title)]);
            }
            $category = Category::create($req->all());

            return response([
                'success' => true,
                'article' => $category
            ]);
        }
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
     * Display the specified category.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::with('thumbnail')
            ->where('category.slug', $slug)
            ->first();

        return response($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $formValidator = Validator::make($req->all(), $this->formRules());

        if ($formValidator->fails()) {
            return response([
                'success' => false,
                'formErrors' => $formValidator->errors()
            ]);
        } else {
            $category = Category::findOrFail($id);

            /* Se a slug from title if not exist */
            if (empty($req->slug)) {
                $req->merge(['slug' => Str::slug($req->title)]);
            }

            $category->update($req->all());

            return response([
                'success' => true,
                'category' => $category
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first()->delete();
        if ($category) {
            return response('Categorie supprimée');
        } else {
            return response();
        }
    }

    /**
     * Display the specified category with its published articles.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function showCategoryArticles(Request $req, $slug)
    {
        $category = Category::with('thumbnail', 'articles')
            ->where('slug', $slug)
            ->first();

        return response($category);
    }

    /**
     * Display the specified category with its published articles.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function showCategoryArticlesPublished(Request $req, $slug)
    {
        $category = Category::with('thumbnail', 'articlesPublished')
            ->where('slug', $slug)
            ->first();

        $articles = Article::where('category_id', $category->id);

        dd($category->articlesPublished);

        return response($category);
    }

    /**
     * Display the specified category with its unpublished articles.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function showCategoryArticlesUnpublished(Request $req, $slug)
    {
        $category = Category::with('thumbnail', 'articlesUnpublished')
            ->where('slug', $slug)
            ->first();

        return response($category);
    }


    /**
     * Display the specified category with its deleted articles.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function showCategoryArticlesDeleted(Request $req, $slug)
    {
        $category = Category::with('thumbnail', 'articlesDeleted')
            ->where('slug', $slug)
            ->first();

        return response($category);
    }
}
