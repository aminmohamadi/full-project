@extends('layouts.master')

@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>مدیریت نقش ها</h3>
        @endslot
        <li class="breadcrumb-item active">مدیریت نقش ها</li>
    @endcomponent
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
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th class="row-counter">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">توضیح</th>
                                <th class="text-center">دسترسی های نقش</th>
                                <th class="text-center">منو نقش</th>
                                <th class="text-center">عملیات</th>


                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td class="row-counter row-number">{{$i++}}</td>
                                    <td class="text-center">
                                        <span class="font-weight-bold">{{$item->name}}</span>
                                    </td>
                                    <td class="text-center"> {{$item->description}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-round" href="{{route('role.functionality.get',$item->id)}}">دسترسی های نقش</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-round" href="{{route('role.menu.show',$item->id)}}">منو نقش</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-icon simple-ajax-modal"
                                           href="{{route('role.show',$item->id)}}">
                                            <i class="las la-pen text-warning font-30 "></i>
                                        </a>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#delete-item" oncontextmenu="return false" data-action="{{route('role.destroy',$item->id)}}"
                                           data-id="{{$item->id}}" data-method="delete" class="btn btn-icon modal-with-zoom-anim">
                                            <i class="las la-trash-alt text-danger font-30"></i>
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
