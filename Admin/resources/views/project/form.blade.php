@extends('layouts.master')
@section('title', 'مدیریت اسلایدر ها')
@push('css')
@endpush

@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>ایجاد اسلایدر</h3>
        @endslot
        <li class="breadcrumb-item">
            <a href="{{route('slider.index')}}">مدیریت اسلایدر ها</a>
        </li>
        <li class="breadcrumb-item active">ایجاد اسلایدر</li>
    @endcomponent
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="#"
                       id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-main" type="button"
                       role="tab" aria-controls="pills-main" aria-selected="true"
                    >اطلاعات اصلی</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{isset($method) ? '' : 'disabled'}}" href="#"
                       id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button"
                       role="tab" aria-controls="pills-gallery" aria-selected="true"
                    >گالری تصاویر</a>
                </li>
            </ul>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab">
                    <form action="{{$action}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($method)
                            @method($method)
                        @endisset
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input type="text" class="form-control" placeholder="عنوان"
                                           name="title" id="title" value="{{$entity->title}}" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client">کارفرما</label>
                                    <input type="text" class="form-control" placeholder="کارفرما"
                                           name="client" id="client" value="{{$entity->client}}" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">تاریخ اجرا</label>
                                    <input class="form-control mb-3 persian-date-picker" id="pcal1" type="text"
                                           name="date"
                                           placeholder="تاریخ اجرا" value="{{$entity->date}}" required
                                    >
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="basic-conf">توضیحات پروژه</label>
                                <textarea name="body" id="basic-conf">{{$entity->body}}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>

                    </form>

                </div>
                <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                    <div class="col-12">
                        <div class="file-loading">
                            <input id="input-24" name="image[]" multiple type="file"
                                   data-upload-url="{{route('upload.project.image',$entity->id)}}"
                                   data-language="fa" data-rtl="true" data-max-file-count="0"
                                   data-validate-initial-count="true"
                                   data-initial-preview-as-data="true"
                                   data-initial-preview-download-url="false"
                                   data-show-ajax-error-details="false"
                                   data-overwrite-initial="false"
                                   data-max-file-size=5000",
                                   data-initial-caption="{{auth()->user()->getFullNameAttribute()}}"
                                   data-allowed-file-types="['image']"
                                   data-allowed-file-extensions='["jpg", "png", "jpeg"]'
                            >
                        </div>

                    </div><!--end col-->
                </div>
            </div>

        </div><!--end card-body-->
    </div><!--end card-->
@endsection
@php
    $images=[];
    foreach ($entity->images->pluck('address') as $key =>$item){
      array_push($images,'/storage/project/'.$item);
    }
    $initialPreviewConfig = [];
    foreach ($entity->images as $item){
        $item_config = [
            "type"=>"image",
            "caption"=>$item->alt,
            "url"=> route('delete.project.image',$item->id),
            "key"=> $item->id
    ];
        array_push($initialPreviewConfig,$item_config);
    }
@endphp
@push('js')
    <script>
        $(document).ready(function () {
            $("#input-24").fileinput({
                initialPreview: @php echo json_encode($images); @endphp,
                initialPreviewConfig:@php echo json_encode($initialPreviewConfig); @endphp,
                ajaxDeleteSettings: {
                    method: "delete",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                uploadExtraData: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
            });

        });
    </script>
@endpush
