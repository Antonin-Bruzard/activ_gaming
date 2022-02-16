<?php

namespace App\Http\Controllers\api;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('Authorization:news-create', ['only' => ['create']]);
        $this->middleware('Authorization:news-edit', ['only' => ['update']]);
        $this->middleware('Authorization:news-delete', ['only' => ['destroy']]);
        $this->middleware('Authorization:news-unpublish', ['only' => ['unpublished']]);
    }

    /**
     * Return validation rules.
     * @return array
     */
    public function formRules()
    {
        return [
            'title' => 'required|min:6|max:50',
            'description' => 'required|min:6|max:300',
            'content' => 'required|min:350',
            'img_id' => 'required',
            'img_large_id' => 'required',
            'category_id' => 'required',
            'published' => 'sometimes'
        ];
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function unpublished(Request $req) {
        /**
         * JOIN TABLES
         */
        $unpublished = Article::with('author.avatar', 'banner', 'thumbnail');

        /**
         * CONDITIONS
         */

        /* has category ? */
        if (!empty($req->category)) {
            $unpublished = $unpublished->whereIn('category_id', $req->category);
        }

        /* Only unpublished article */
        $unpublished = $unpublished->whereNull('published')->orWhere('published', '>', Carbon::now());


        /**
         * FILTERS
         */
        $unpublished = $unpublished->orderBy('articles.published', 'DESC');

        /* Limit results ? */
        if (!empty($req->limit) && empty($req->paginate)) {
            $unpublished = $unpublished->take($req->limit);
        }

        /* Paginate results */
        if (!empty($req->paginate) && empty($req->limit)) {
            $unpublished = $unpublished->paginate($req->paginate);
        }
        else {
            $unpublished = $unpublished->get();
        }

        /* Send response */
        return response($unpublished);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        /**
         * JOIN TABLES
         */
        $articles = Article::with('author.avatar', 'banner', 'thumbnail');

        /**
         * CONDITIONS
         */

        /* has category ? */
        if (!empty($req->category)) {
            $articles = $articles->whereIn('category_id', $req->category);
        }

        /* Only published article */
        $articles = $articles->where('published', '<=',  Carbon::now());


        /**
         * FILTERS
         */
        $articles = $articles->orderBy('articles.published', 'desc');

        /* Limit results ? */
        if (!empty($req->limit) && empty($req->paginate)) {
            $articles = $articles->take($req->limit);
        }

        /* Paginate results */
        if (!empty($req->paginate) && empty($req->limit)) {
            $articles = $articles->paginate($req->paginate);
        }
        else {
            $articles = $articles->get();
        }

        /* Send response */
        return response($articles);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $formValidator = Validator::make($request->toArray(), $this->formRules());

        if ($formValidator->fails()) {
            return response([
                'success' => false,
                'formErrors' => $formValidator->errors()
            ]);
        } else {
            $article = Article::create($request->all());

            return response([
                'success' => true,
                'article' => $article
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show single news article.
     * @param int $slug News article slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('articles.slug', $slug)
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->join('files', 'files.id', '=', 'articles.img_large_id')
            ->join('files as avatars', 'avatars.id', '=', 'users.avatar_id')
            ->select('articles.*', 'users.name as author', 'files.path as img_large_path', 'avatars.path as author_avatar_path')
            ->first();

        // $this->authorize('update', $article);

        return response($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
            $article = Article::findOrFail($id);

            /* Set a slug from title if not exist */
            if (empty($req->slug)) {
                $req->merge(['slug' => Str::slug($req->title)]);
            }

            $article->update($req->all());

            return response([
                'success' => true,
                'article' => $article
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->first()->delete();
        if ($article) {
            return response('Article supprim�');
        } else {
            return response();
        }

    }
}
