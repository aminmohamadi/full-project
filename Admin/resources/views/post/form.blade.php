@extends('layouts.master')
@section('title', 'مدیریت پست ها')
@push('css')
@endpush()
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>ایجاد پست</h3>
        @endslot
        <li class="breadcrumb-item">
            <a href="{{route('post.index')}}">پست</a>
        </li>/
        <li class="breadcrumb-item active">ایجاد پست</li>
    @endcomponent
    <div class="row">
        <form action="{{$action}}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <div class="card">
                <div class="card-header pb-0">
                    <h5>ایجاد پست</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-6">
                           <div class="col-md-12 my-2">
                               <div class="form-group">
                                   <label for="title"
                                          class="control-label">عنوان</label>
                                   <input type="text" class="form-control" id="title"
                                          value="{{$entity->title}}"
                                          placeholder="عنوان" name="title">
                               </div>
                           </div>
                           <div class="col-md-12 my-2">
                               <div class="form-group">
                                   <label for="tags" class="control-label">تگ ها</label>
                                   <input class="form-control" name="tags" id="tags" type="text" value="{{$entity->title}}" data-role="tagsinput" />                            </div>
                           </div>
                           <div class="col-md-12 my-2">
                               <div class="form-group">
                                   <label for="status"
                                          class="control-label">وضعیت</label>
                                   <select class="form-control form-select" name="status"
                                           id="status">
                                       <option value="">انتخاب کنید ...</option>
                                       <option value="1" {{$entity->status == 1 ? "selected" : ""}}>فعال</option>
                                       <option value="0" {{$entity->status == 0 ? "selected" : ""}}>غیر فعال</option>
                                   </select>
                               </div>

                           </div>
                           <div class="col-md-12 my-2">
                               <div class="form-group">
                                   <label for="category_id"
                                          class="control-label">دسته بندی</label>
                                   <select class="form-control form-select" name="category_id"
                                           id="category_id">
                                       <option value="">انتخاب کنید ...</option>
                                       @foreach(\Models\Category::all() as $item)
                                           <option value="{{$item->id}}" {{$entity->category_id == $item->id ? "selected" : ""}}>{{$item->title}}</option>

                                       @endforeach
                                   </select>
                               </div>

                           </div>
                       </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid">
                                        <p class="text-muted">تصویر وبلاگ خود را در اینجا آپلود کنید، لطفا روی دکمه "آپلود تصویر" کلیک کنید.</p>
                                        <div class="preview-box d-block justify-content-center rounded shadow overflow-hidden bg-light p-1" style="height: 150px!important;">
                                            @if($entity->image)<img class="preview-content" height="150" src="{{asset('storage/post\\').$entity->image}}">@endif
                                        </div>
                                        <input type="file" id="input-file" name="image" accept="image/*" onchange={handleChange()} hidden />
                                        <label class="btn-upload btn btn-primary mt-4" for="input-file"> آپلود تصویر</label>
                                    </div>

                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea name="body" id="basic-conf">{{$entity->body}}</textarea>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">ثبت</button>
                </div>
            </div>
        </form>
    </div>
@endsection

