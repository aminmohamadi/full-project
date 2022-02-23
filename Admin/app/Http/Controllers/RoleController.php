<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Models\Role;
use App\Traits\HasCrud;

class RoleController extends Controller
{
    use HasCrud;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = \Models\Role::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'users.role.index';

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'role';


    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'roles';

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
    protected $updateAction = 'role.update';

    /**
     * method of CRUD.
     *
     * @var string
     */
    protected $storeAction = 'role.store';


    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = RoleRequest::class;

    /**
     * Pagination count per page.
     *
     * @var array|string
     */
    protected $perPage = 20;


    protected $isUserIdRequired = false;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['menu'];


//    /**
//     * The relation that must be crud with $this.
//     *
//     * @var array
//     */
//    protected $append = 'menu';

}
