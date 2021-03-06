<?php

namespace App\Traits;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait HasCrud
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexAction(Request $request)
    {
        if ($request->has('query')) {
            $items = $this->getModel()
                ->limit($request->get('limit', 10))
                ->get();
        }
        $items = $this->getModel()->paginate($this->perPage);
        return view("{$this->viewPath}.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAction()
    {
        $entity = $this->getModel();
        $action = route($this->storeAction);
        return view("{$this->viewPath}.form", compact('entity', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAction()
    {
        $entity = $this->getModel()->create(
            $this->getRequest('store')->all()
        );
        if (isset($this->append) && $this->relations()["{$this->append}"] && $this->getRequest('store')["{$this->append}"]){
            foreach ($this->getRequest('store')["{$this->append}"] as $item){
                $entity->{"$this->append"}()->create($item);
            }
        }
        if ($this->getRequest('store')->hasFile('image')){
            $file = Helpers::upload("{$this->viewPath}/",\request()->file('image'));
            $entity->image = $file;
            $entity->save();
        }
        if ($this->isUserIdRequired){
            $entity->user_id = Auth::user()->id;
            $entity->save();
        }
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        toast(Constants::SUCCESS_OPERATION_MESSAGE, 'success');
        return redirect()->route("{$this->getRoutePrefix()}.index");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showAction($id)
    {
        $action = route($this->updateAction, $id);
        $method = $this->updateMethod;
        $entity = $this->getEntity($id);
        if (request()->wantsJson()) {
            return $entity;
        }

        return view("{$this->viewPath}.form", compact('entity', 'action', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateAction($id)
    {

        $entity = $this->getEntity($id);
        $this->disableSearchSyncing();

        $entity->update(
            $this->getRequest('update')->all()
        );
        if (isset($this->append) && $this->relations()["{$this->append}"] && $this->getRequest('store')["{$this->append}"]){
            foreach ($this->getRequest('store')["{$this->append}"] as $item){
                $entity->{"$this->append"}()->update($item);
            }
        }
        if ($this->getRequest('store')->hasFile('image')){
            $file = Helpers::upload("{$this->viewPath}/",\request()->file('image'));
            $entity->image = $file;
            $entity->save();
        }
        if ($this->isUserIdRequired){
            $entity->user_id = Auth::user()->id;
            $entity->save();
        }
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity)
                ->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
        }
        toast(Constants::SUCCESS_OPERATION_MESSAGE, 'success');
        return redirect()->route("{$this->getRoutePrefix()}.index");
    }

    /**
     * Destroy resources by given ids.
     *
     * @param string $ids
     * @return void
     */
    public function destroyAction($ids)
    {
        $delete = $this->getModel()
            ->withoutGlobalScope('active')
            ->whereIn('id', explode(',', $ids))
            ->delete();
        if ($delete) {
            toast(Constants::SUCCESS_OPERATION_MESSAGE, 'success');
            return response()->json(['redirect'=>route($this->getRoutePrefix().".index")]);
        }
    }

    /**
     * Get an entity by the given id.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getEntity($id)
    {
        return $this->getModel()
            ->with($this->relations())
            ->withoutGlobalScope('active')
            ->findOrFail($id);
    }

    /**
     * Get the relations that should be eager loaded.
     *
     * @return array
     */
    private function relations()
    {
        return collect($this->with ?? [])->mapWithKeys(function ($relation) {
            return [$relation => function ($query) {
                return $query->withoutGlobalScope('active');
            }];
        })->all();
    }

    /**
     * Get form data for the given action.
     *
     * @param string $action
     * @param mixed ...$args
     * @return array
     */
    protected function getFormData($action, ...$args)
    {
        if (method_exists($this, 'formData')) {
            return $this->formData(...$args);
        }

        if ($action === 'create' && method_exists($this, 'createFormData')) {
            return $this->createFormData();
        }

        if ($action === 'edit' && method_exists($this, 'editFormData')) {
            return $this->editFormData(...$args);
        }

        return [];
    }

    /**
     * Get name of the resource.
     *
     * @return string
     */
    protected function getResourceName()
    {
        if (isset($this->resourceName)) {
            return $this->resourceName;
        }

        return lcfirst(class_basename($this->model));
    }

    /**
     * Get label of the resource.
     *
     * @return void
     */
    protected function getLabel()
    {
        return $this->label;
    }

    /**
     * Get route prefix of the resource.
     *
     * @return string
     */
    protected function getRoutePrefix()
    {
        if (isset($this->routePrefix)) {
            return $this->routePrefix;
        }

        return "{$this->getModel()->getTable()}";
    }

    /**
     * Get a new instance of the model.
     *
     * @return Model
     */
    protected function getModel()
    {
        return new $this->model;
    }

    /**
     * Get request object
     *
     * @param string $action
     * @return \Illuminate\Http\Request
     */
    protected function getRequest($action)
    {
        if (!isset($this->validation)) {
            return request();
        }

//        if (isset($this->validation[$action])) {
//            return resolve($this->validation[$action]);
//        }

        return resolve($this->validation);
    }

    /**
     * Disable search syncing for the entity.
     *
     * @return void
     */
    protected function disableSearchSyncing()
    {
        if ($this->isSearchable()) {
            $this->getModel()->disableSearchSyncing();
        }
    }

    /**
     * Determine if the entity is searchable.
     *
     * @return bool
     */
    protected function isSearchable()
    {
        return in_array(Searchable::class, class_uses_recursive($this->getModel()));
    }

    /**
     * Make the given model instance searchable.
     *
     * @return void
     */
    protected function searchable($entity)
    {
        if ($this->isSearchable($entity)) {
            $entity->searchable();
        }
    }
}
