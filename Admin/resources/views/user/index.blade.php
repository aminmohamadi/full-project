@extends('admin.layout.master')

@section('title')
    مدیریت کاربران
@endsection

@section('content')
    <section class="panel panel-info">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">مدیریت کاربران</h2>
        </header>

        <div class="panel-body has-checkbox" id="userCheckbox">
            <div class="table-responsive">
                <table class="table table-bordered mb-none" id="userTable">
                    <caption class="action">
                        <a href="{{route('user.create')}}" class="simple-ajax-modal btn btn-default pull-left">افزودن
                            <i class="material-icons">add</i>
                        </a>
                    </caption>
                    <thead>
                    <tr>
                        <th class="row-counter">ردیف</th>
                        <th class="text-center">نام و نام خانوادگی</th>
                        <th class="text-center">موبایل</th>
                        <th class="text-center">نقش</th>
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
                                <td class="text-center">{{$user->getRoleName()}}</td>
                                <td class="row-counter">
                                    <a class="btn btn-icon simple-ajax-modal"
                                       href="{{route('user.edit',$user->id)}}"><i class="material-icons warning"
                                                                                  data-original-title="ویرایش"
                                                                                  data-toggle="tooltip"
                                                                                  data-trigger="hover">edit</i></a>
                                    <a href="#delete-modal" oncontextmenu="return false"
                                       data-link="{{route('user.destroy',$user->id)}}"
                                       data-id="{{$user->id}}" class="btn btn-icon modal-with-zoom-anim"><i
                                            class="material-icons danger" data-original-title="حذف"
                                            data-toggle="tooltip"
                                            data-trigger="hover">delete</i></a>
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
