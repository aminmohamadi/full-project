@extends('layouts.master')
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>مدیریت نقش ها</h3>
        @endslot
        <li class="breadcrumb-item">
            <a href="{{route('role.index')}}">مدیریت نقش ها</a>
        </li>/
        <li class="breadcrumb-item active">مدیریت نقش ها</li>
    @endcomponent
<div class="row">
    <div class="card">
        <form action="{{$action}}" method="post" id="formRole"
              enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-title">افزودن نقش</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" placeholder="عنوان"
                                   name="title" id="title" value="{{$entity->name}}" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">توضیح</label>
                            <input type="text" class="form-control" placeholder="توضیح"
                                   name="description" id="description"  value="{{$entity->description}}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary modal-confirm">ذخیره</button>
                        <button class="btn btn-default modal-dismiss">انصراف</button>
                    </div>
                </div>
            </footer>
        </form>
    </div>
</div>
@endsection
