<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Requests\SliderRequest;
use App\Traits\HasCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Models\Image;
use Models\Project;

class ProjectController extends Controller
{


    use HasCrud;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = \Models\Project::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'project.index';

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'project';


    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'project';

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
    protected $updateAction = 'project.update';

    /**
     * method of CRUD.
     *
     * @var string
     */
    protected $storeAction = 'project.store';


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



    public function image_uploadAction(Project $project,Request $request){
        if ($request->hasFile('image')){
            foreach ($request->image as $item) {
                $image = Helpers::upload("project/",$item);
                if ($image){
                    $project->images()->create([
                        'address'=>  $image,
                        'alt'=>$project->title,
                    ]);
                    return response()->json(['status'=>'success','data'=>Constants::SUCCESS_OPERATION_MESSAGE]);
                }
                return response()->json(['status'=>'error','data'=>Constants::ERROR_OPERATION_MESSAGE]);
           }
        }
    }


    public function image_deleteAction(Image $image){
            $delete_file = Storage::disk('public')->delete('project/'.$image->address);
            if ($delete_file){
                $image->delete();
                return response()->json(['status'=>'success','data'=>Constants::SUCCESS_OPERATION_MESSAGE]);
            }
            return response()->json(['status'=>'error','data'=>Constants::ERROR_OPERATION_MESSAGE]);

        }

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

