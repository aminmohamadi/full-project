<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Traits\HasCrud;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use HasCrud;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = \Models\Slider::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'slider.index';

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'slider';


    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'slider';

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
    protected $updateAction = 'slider.update';

    /**
     * method of CRUD.
     *
     * @var string
     */
    protected $storeAction = 'slider.store';


    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SliderRequest::class;

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

