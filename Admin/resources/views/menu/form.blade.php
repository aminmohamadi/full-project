@extends('layouts.master')
@section('content')
<div class="row">
    <div class="card">
        <form action="{{$action}}" method="post" id="formRole"
              enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <header class="card-header">
                <div class="card-title">
                    <h2 class="card-title">{{$panelTitle}}</h2>
                </div>

            </header>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="name">عنوان</label>
                            <input type="text" class="form-control" placeholder="عنوان"
                                   name="name" id="name" value="{{$menu->name}}" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="page_name">نام صفحه</label>
                            <input type="text" class="form-control" placeholder="نام صفحه"
                                   name="page_name" id="page_name" value="{{$menu->page_name}}" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="route_name">مسیر</label>
                            <select class="form-control"
                                    name="route_name" id="route_name" required>
                                <option>انتخاب کنید</option>
                                @foreach($items as $item)
                                    <option @if($menu->route_name === $item) selected @endif value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="icon">آیکون</label>
                            <input value="{{$menu->icon}}" type="text" class="form-control"
                                   name="icon" id="icon" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="status">وضعبت</label>
                            <select class="form-control"
                                    name="status" id="status" required>
                                <option>انتخاب کنید</option>
                                <option @if($menu->status === '1') selected @endif value="1">فعال</option>
                                <option @if($menu->status === '0') selected @endif value="0">غیر فعال</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <label for="parent_id">ولد</label>
                            <select class="form-control"
                                    name="parent_id" id="parent_id" required>
                                <option>انتخاب کنید</option>
                                <option value="0">والد</option>
                                @foreach(auth()->user()->role->available_menu() as $item)
                                <option @if($menu->parent_id === $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

            </div>

            <footer class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary modal-confirm">ذخیره</button>
                    </div>
                </div>
            </footer>
        </form>
    </div>
</div>
@endsection
