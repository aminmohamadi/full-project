@extends('admin.layout.master')

@section('title')
    ویرایش اطلاعات کاربر
@endsection
@section('content')
    <form action="{{route('user.updateProfile')}}" method="post" id="formUser" enctype="multipart/form-data">
        @method("patch")
        @csrf
        <section class="panel panel-info">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                </div>
                <h2 class="panel-title">{{$pageTitle}}</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="name">نام<span
                                    class="required">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required
                                   value="{{$user->name}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="last_name">نام خانوادگی<span
                                    class="required">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                   required value="{{$user->last_name}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="mobile">موبایل<span
                                    class="required">*</span></label>
                            <input type="text" name="mobile" id="mobile" required class="form-control ltr text-left"
                                   value="{{$user->mobile}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="email">ایمیل</label>
                            <input type="email" name="email" id="email" class="form-control ltr text-left"
                                   value="{{$user->email}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="national_code">کدملی</label>
                            <input type="text" name="national_code" id="national_code"
                                   class="form-control ltr text-left"
                                   value="{{$user->national_code}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="address">آدرس</label>
                            <input type="text" name="address" id="address" class="form-control"
                                   value="{{$user->address}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="gender">جنسیت</label>
                            <select name="gender" id="gender" class="form-control">
                                <option
                                    value="{{\App\Helper\Constants::GENDER_MALE}}"
                                    @if ($user->gender == \App\Helper\Constants::GENDER_MALE)  selected @endif>
                                    مرد
                                </option>
                                <option
                                    value="{{\App\Helper\Constants::GENDER_FEMALE}}"
                                    @if ($user->gender == \App\Helper\Constants::GENDER_FEMALE)  selected @endif>
                                    زن
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="username">نام کاربری</label>
                            <input type="text" name="username" id="username" class="form-control ltr text-left"
                                   disabled
                                   value="{{$user->username}}"/>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success">ذخیره</button>
                    </div>
                </div>
            </footer>
        </section>
    </form>
@endsection
