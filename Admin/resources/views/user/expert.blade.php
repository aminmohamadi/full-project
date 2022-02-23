@extends('admin.layout.master')

@section('title')
    {{$pageTitle}}
@endsection

@section('content')
    <section class="panel panel-info">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">{{$pageTitle}}</h2>
        </header>

        <div class="panel-body has-checkbox" id="userCheckbox">
            <div class="table-responsive">
                <table class="table table-bordered mb-none" id="userTable">
                    <thead>
                    <tr>
                        <th class="row-counter">ردیف</th>
                        <th class="text-center">نام و نام خانوادگی</th>
                        <th class="text-center">موبایل</th>
                        <th class="text-center">تخصص</th>
                        <th class="text-center">استان محل سکونت</th>
                        <th class="text-center">شهر محل سکونت</th>
                        <th class="text-center">حوزه کاری</th>
                        <th class="text-center">تصویر پروانه</th>
                        <th class="text-center">تصویر کارت ملی</th>
                        <th class="text-center">وضعیت</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users->count())
                        @foreach($users as $user)
                            <tr>
                                <td class="row-counter row-number">{{$user->index+1}}</td>
                                <td class="text-center">
                                    <span class="font-weight-bold">{{$user->getFullName()}}</span>
                                </td>
                                <td class="text-center">{{$user->mobile}}</td>
                                <td class="text-center">{{$user->expertField->title}}</td>
                                <td class="text-center">{{$user->addressProvince->title}}</td>
                                <td class="text-center">{{$user->addressCity->title}}</td>
                                <td class="text-center">{{$user->city->title}}</td>
                                <td class="text-center"><a target="_blank"
                                                           href="{{asset("storage/images/{$user->photos[0]->name}")}}"><img
                                            width="100%"
                                            src="{{asset("storage/images/{$user->photos[0]->name}")}}"></a>
                                </td>
                                <td class="text-center"><a target="_blank"
                                                           href="{{asset("storage/images/{$user->photos[1]->name}")}}"><img
                                            width="100%"
                                            src="{{asset("storage/images/{$user->photos[1]->name}")}}"></a>
                                </td>
                                <td class="text-center">{{$user->getStatus()}}</td>
                                <td class="row-counter">
                                    <a class="btn btn-icon"
                                       href="{{route('user.changeStatus',[$user->id,1])}}"><i
                                            class="material-icons success"
                                            data-original-title="تایید کارشناس"
                                            data-toggle="tooltip"
                                            data-trigger="hover">check_circle</i></a>
                                    <a class="btn btn-icon"
                                       href="{{route('user.changeStatus',[$user->id,2])}}"><i
                                            class="material-icons danger"
                                            data-original-title="عدم تایید کارشناس"
                                            data-toggle="tooltip"
                                            data-trigger="hover">cancel</i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">
                                <div class="alert alert-info mb-none text-center">
                                    <i class="material-icons">info_outline</i>
                                    اطلاعاتی وارد نشده است.
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
