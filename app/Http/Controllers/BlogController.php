<?php

namespace App\Http\Controllers;
/**
 * Class BlogController.php
 * @package     App\Http\Controllers
 * @version     1.0.0
 * @copyright   Copyright (c) 2015-2016 forehalo <http://www.forehalo.top>
 * @author      forehalo <forehalo@gmail.com>
 * @license     http://www.gnu.org/licenses/lgpl.html   LGPL
 */

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * BlogRepository object.
     *
     * @var PostRepository $blog
     */
    protected $blog;

    /**
     * BlogController constructor.
     *
     * @param PostRepository $blog
     */
    public function __construct(PostRepository $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Display posts list order by created_at
     * This controller return posts shown in collapsible view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function frontIndex()
    {
        return view('front.posts.index', $this->index());
    }

    /**
     * Unlike 'frontIndex', this action used to show normal list of posts
     * and post clicked will be shown in a single page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function normalIndex()
    {
        return view('front.posts.normalIndex', $this->index());
    }

    /**
     * Get all posts and make pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->blog->all(config('blog.pagination'));
        $links = $posts->links();

        return compact('posts', 'links');
    }


    /**
     * Get post body through ajax or redirect to 404.
     *
     * @param Request $request
     * @param string $id  format: post-{id}
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function body(Request $request, $id)
    {
        if($request->ajax()){
            return response()->json(['body' => $this->blog->body($id)]);
        }else{
            return view('errors.404');
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
     * @param  string $slug post url slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->blog->getByColumn($slug, 'slug');

        return view('front.posts.post', compact('post'));
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
        //
    }
}