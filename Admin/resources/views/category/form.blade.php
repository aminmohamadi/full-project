@extends('layouts.master')
@section('title', 'دسته بندی ها')
@push('css')
@endpush()
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>ایجاد دسته بندی ها</h3>
        @endslot
        <li class="breadcrumb-item">
            <a href="{{route('category.index')}}">دسته بندی ها</a>
        </li>/
        <li class="breadcrumb-item active">ایجاد دسته بندی ها</li>
    @endcomponent
    <div class="row">
        <form action="{{$action}}" method="post">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <div class="card">
                <div class="card-header pb-0">
                    <h5>ایجاد دسته بندی </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="control-label">دسته بندی </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$entity->title}}" />

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label">والد</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option>انتخاب کنید</option>
                                    <option value="0" {{$entity->parent_id == 0 ? "selected" : ""}}>والد</option>
                                @foreach(\Models\Category::where('id','!=',$entity->id)->get() as $item)
                                        <option value="{{$item->id}}" {{$entity->parent_id == $item->id ? "selected" : ""}}>{{$item->title}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">ثبت</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
