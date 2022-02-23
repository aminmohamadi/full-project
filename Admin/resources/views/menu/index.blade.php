@extends('layouts.master')

@section('title')
    نقش ها
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">مدیریت نقش ها</h4>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="card-body border">
                    <p class="card-subtitle font-14 mb-2">این زیرنویس کارت است</p>
                    <p class="card-text text-muted"> برخی از نمونه‌های سریع متن بخش عمده ای از محتوای کارت.
                        این یک واقعیت ثابت شده است که خواننده از خواندنی ها حواسش پرت می شود
                        محتوا.
                    </p>
                </div>
            </div><!--end card -body-->
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">نتایج به دست آمده</h4>
            </div><!--end card-header-->
            <div class="card-body">
                <div class="card-body border">
                    <div class="table-responsive">
                        <div class="right">
                            <a href="{{route('role.menu.create',$role->id)}}" class="btn btn-primary">افزودن
                                <i class="ti ti-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped mb-0">

                            <thead>
                            <tr>
                                <th class="row-counter">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">نام صفحه</th>
                                <th class="text-center">مسیر</th>
                                <th class="text-center">آیکون</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($role->menu as $item)
                                <tr>
                                    <td class="row-counter row-number">{{$item->index++}}</td>
                                    <td class="text-center">
                                        <span class="font-weight-bold">{{$item->name}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="font-weight-bold">{{$item->page_name}}</span>
                                    </td>
                                    <td class="text-center"> {{$item->route_name}}</td>
                                    <td class="text-center">
                                        <i class="material-icons">{{$item->icon}}</i>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-icon simple-ajax-modal"
                                           href="{{route('role.menu.edit',$item->id)}}">
                                            <i class="las la-pen text-warning font-25 "></i>


                                        </a>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#delete-item" oncontextmenu="return false" data-action="{{route('role.menu.destroy',$item->id)}}"
                                           data-id="{{$item->id}}" data-method="delete" class="btn btn-icon modal-with-zoom-anim">
                                            <i class="las la-trash-alt text-danger font-25"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table><!--end /table-->
                    </div>
                </div>
            </div><!--end card -body-->
        </div>

    </div>
@endsection
