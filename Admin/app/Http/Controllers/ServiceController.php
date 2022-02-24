<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Traits\HasCrud;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HasCrud;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = \Models\Service::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'service.index';

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'service';


    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'service';

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
    protected $updateAction = 'service.update';

    /**
     * method of CRUD.
     *
     * @var string
     */
    protected $storeAction = 'service.store';


    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
//    protected $validation = SliderRequest::class;

    /**
     * Pagination count per page.
     *
     * @var array|string
     */
    protected $perPage = 20;



    protected $isUserIdRequired = false;


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

