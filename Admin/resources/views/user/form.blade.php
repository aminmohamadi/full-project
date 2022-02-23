<div id="modalUser"

     class="modal-block modal-block-lg zoom-anim-dialog modal-header-color modal-block-primary modal-with-footer">
    <section class="panel">
        <form action="{{$action}}" method="POST" id="formUser"
              enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="modal-dismiss"><i class="material-icons">close</i> </a>
                </div>
                <h2 class="panel-title">افزودن کاربر</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">نام<span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" placeholder="نام"
                                   value="{{$user->name}}" name="name" id="username" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">نام خانوادگی<span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" placeholder="نام خانوادگی"
                                   value="{{$user->last_name}}" name="last_name" id="name" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company">شماره موبایل<span
                                    class="required">*</span></label>
                            <input type="text" class="form-control ltr text-left" value="{{$user->mobile}}"
                                   placeholder="شماره موبایل" id="company" maxlength="11" name="mobile" required/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">نام کاربری<span
                                    class="required">*</span></label>
                            <input type="text" class="form-control ltr text-left" placeholder="نام کاربری"
                                   value="{{$user->username}}" name="username" id="username" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">رمزعبور<span
                                    class="required">*</span></label>
                            <input type="password" class="form-control ltr text-left" placeholder="رمزعبور"
                                   name="password" id="password" required data-rule-minlength="6"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="re-password">تکرار رمزعبور<span
                                    class="required">*</span></label>
                            <input type="password" class="form-control ltr text-left" placeholder="تکرار رمزعبور"
                                   name="password_confirmation" id="re-password" required data-rule-minlength="6"
                                   data-rule-equalto="#password"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="national_code">کدملی</label>
                            <input type="text" class="form-control ltr text-left" value="{{$user->national_code}}"
                                   placeholder="کدملی" id="national_code" maxlength="10" name="national_code"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role_id">نقش<span
                                    class="required">*</span></label>
                            <select id="role_id" class="form-control" name="role_id" required>
                                <option value="">انتخاب کنید</option>
                                @foreach(\App\Models\Role::all() as $role)
                                    @if(Auth::user()->role_id == \App\Helper\Constants::ROLE_ADMIN)
                                        <option @if($user->role_id === $role->id) selected
                                                @endif value="{{$role->id}}">{{$role->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">وضعیت<span
                                    class="required">*</span></label>
                            <select id="status" class="form-control" name="status" required>
                                <option value="">انتخاب کنید</option>
                                <option @if($user->id && $user->status == \App\Helper\Constants::DISABLE) selected
                                        @endif value="{{\App\Helper\Constants::DISABLE}}">غیر
                                    فعال
                                </option>
                                <option @if($user->id && $user->status == \App\Helper\Constants::ENABLE) selected
                                        @endif value="{{\App\Helper\Constants::ENABLE}}"> فعال
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">جنسیت<span
                                    class="required">*</span></label>
                            <select id="gender" class="form-control" name="gender" required>
                                <option value="">انتخاب کنید</option>
                                <option @if($user->id && $user->gender === \App\Helper\Constants::GENDER_MALE) selected
                                        @endif value="{{\App\Helper\Constants::GENDER_MALE}}">آقا
                                </option>
                                <option @if($user->id && $user->gender === 2) selected @endif value="2">خانم
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" class="form-control ltr text-left" placeholder="ایمیل"
                                   value="{{$user->email}}" name="email" id="email"/>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary modal-confirm">ذخیره</button>
                        <button class="btn btn-default modal-dismiss">انصراف</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<script>
    $(document).ready(function () {
        if (typeof ajaxComponents !== 'undefined' && $.isFunction(ajaxComponents))
            ajaxComponents('#modalUser');
    });
</script>

