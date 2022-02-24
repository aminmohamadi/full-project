<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Traits\HasCrud;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use HasCrud;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = \Models\Post::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'post.index';

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'post';


    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'post';

    /**
     * method of Update.
     *
     * @var string
     */
    protected $updateMethod = 'patch';

    /**
     * Action of Update.
     *
     * @var string
     */
    protected $updateAction = 'post.update';

    /**
     * method of CRUD.
     *
     * @var string
     */
    protected $storeAction = 'post.store';


    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = PostRequest::class;

    /**
     * Pagination count per page.
     *
     * @var array|string
     */
    protected $perPage = 20;

    protected $isUserIdRequired = true;

//    /**
//     * The relations to eager load on every query.
//     *
//     * @var array
//     */
//    protected $with = ['menu'];


//    /**
//     * The relation that must be crud with $this.
//     *
//     * @var array
//     */
//    protected $append = 'menu';
}
