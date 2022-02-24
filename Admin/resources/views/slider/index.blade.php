@extends('layouts.master')
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>مدیریت اسلایدر ها</h3>
        @endslot
        <li class="breadcrumb-item active">مدیریت اسلایدر ها</li>
    @endcomponent
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">مدیریت پست ها</h4>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">پست ها</h5>
                <a class="btn btn-primary" href="{{route('slider.create')}}">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                     <thead>
                     <tr>
                         <th class="text-center">رديف</th>
                         <th class="text-center">عنوان</th>
                         <th class="text-center">هدر</th>
                         <th class="text-center">لینک</th>
                         <th class="text-center">عمليات</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                         <tr>
                             <td class="text-center">{{$loop->index + 1}}</td>
                             <td class="text-center">{{$item->title}}</td>
                             <td class="text-center">{{$item->header}}</td>
                             <td class="text-center">{{$item->link}}</td>
                             <td class="text-center">
                                 <a class="btn btn-icon simple-ajax-modal"
                                    href="{{route('slider.show',$item->id)}}">
                                     <i class="las la-pen text-warning font-30 "></i>
                                 </a>
                                 <a type="button" data-bs-toggle="modal" data-bs-target="#delete-item" oncontextmenu="return false" data-action="{{route('slider.delete',$item->id)}}"
                                    data-id="{{$item->id}}" data-method="delete" class="btn btn-icon modal-with-zoom-anim">
                                     <i class="las la-trash-alt text-danger font-30"></i>
                                 </a>
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
            </div>
            <div class="card-footer">
                <div class="paginator">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
