@extends('layouts.master')
@section('content')
    @component('layouts.components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>آپشن های سایت</h3>
        @endslot
        <li class="breadcrumb-item active">آپشن های سایت</li>
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
                        <h2 class="card-title">آپشن های سایت</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">آدرس</label>
                                <input type="text" class="form-control" placeholder="آدرس"
                                       name="option[address]" id="address" value="{{\Models\Option::get('address')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="site_phone">تلفن</label>
                                <input type="text" class="form-control" placeholder="تلفن"
                                       name="option[site_phone]" id="site_phone" value="{{\Models\Option::get('site_phone')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="site_email">ایمیل</label>
                                <input type="text" class="form-control" placeholder="ایمیل"
                                       name="option[site_email]" id="site_email" value="{{\Models\Option::get('site_email')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="instagram">اینستاگرام</label>
                                <input type="text" class="form-control" placeholder="اینستاگرام"
                                       name="option[instagram]" id="instagram" value="{{\Models\Option::get('instagram')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="instagram">توئیتر</label>
                                <input type="text" class="form-control" placeholder="توئیتر"
                                       name="option[tweeter]" id="instagram" value="{{\Models\Option::get('tweeter')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="linkedin">لینکدین</label>
                                <input type="text" class="form-control" placeholder="لینکدین"
                                       name="option[linkedin]" id="linkedin" value="{{\Models\Option::get('linkedin')}}" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="whatsapp">واتساپ</label>
                                <input type="text" class="form-control" placeholder="واتساپ"
                                       name="option[whatsapp]" id="whatsapp" value="{{\Models\Option::get('whatsapp')}}" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid">
                                        <p class="text-muted">برای آپلود لوگو روشن روی "آپلود تصویر" کلیک کنید.</p>
                                        <div class="preview-box d-block justify-content-center rounded shadow overflow-hidden bg-light p-1" style="height: 150px!important;">
                                            @if(\Models\Option::get('light-logo'))<img class="preview-content" height="150" src="{{asset('storage/options\\').\Models\Option::get('light-logo')}}">@endif
                                        </div>
                                        <input type="file" id="input-file" name="light-logo" accept="image/*" onchange={handleChange()} hidden />
                                        <label class="btn-upload btn btn-primary mt-4" for="input-file"> آپلود تصویر</label>
                                    </div>

                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-grid">
                                        <p class="text-muted">برای آپلود لوگو تاریک روی "آپلود تصویر" کلیک کنید.</p>
                                        <div class="preview-box d-block justify-content-center rounded shadow overflow-hidden bg-light p-1" id="input-file2-preview-box" style="height: 150px!important;">
                                            @if(\Models\Option::get('dark-logo'))<img class="preview-content" height="150" src="{{asset('storage/options\\').\Models\Option::get('dark-logo')}}">@endif
                                        </div>
                                        <input type="file" id="input-file2" name="dark-logo" accept="image/*" onchange={handleChange2()} hidden />
                                        <label class="btn-upload btn btn-primary mt-4" for="input-file2"> آپلود تصویر</label>
                                    </div>

                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->

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
