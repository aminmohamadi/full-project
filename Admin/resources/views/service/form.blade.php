@extends('layouts.master')
@section('title', 'مدیریت اسلایدر ها')
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>ایجاد سرویس</h3>
        @endslot
        <li class="breadcrumb-item">
            <a href="{{route('slider.index')}}">مدیریت سرویس ها</a>
        </li>/
        <li class="breadcrumb-item active">ایجاد سرویس</li>
    @endcomponent
    <div class="row">
        <form action="{{$action}}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <div class="card">
                <div class="card-header pb-0">
                    <h5>ایجاد سرویس</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title"
                                       class="control-label">عنوان</label>
                                <input type="text" class="form-control" id="title"
                                       value="{{$entity->title}}"
                                       placeholder="عنوان" name="title">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid">
                                        <p class="text-muted">تصویر سرویس خود را در اینجا آپلود کنید، لطفا روی دکمه "آپلود تصویر" کلیک کنید.</p>
                                        <div class="preview-box d-block justify-content-center rounded shadow overflow-hidden bg-light p-1" style="height: 150px!important;">
                                            @if($entity->image)<img class="preview-content" height="150" src="{{asset('storage/service\\').$entity->image}}">@endif
                                        </div>
                                        <input type="file" id="input-file" name="image" accept="image/*" onchange={handleChange()} hidden />
                                        <label class="btn-upload btn btn-primary mt-4" for="input-file"> آپلود تصویر</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="body" id="basic-conf">{{$entity->body}}</textarea>
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

