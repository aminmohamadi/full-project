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
                                <td class="row-counter">
                                    <a class="btn btn-icon simple-ajax-modal"
                                       href="{{route('user.edit',$user->id)}}"><i class="material-icons warning"
                                                                                  data-original-title="ویرایش"
                                                                                  data-toggle="tooltip"
                                                                                  data-trigger="hover">edit</i></a>
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
