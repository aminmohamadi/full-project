<div id="modalRole"
     class="modal-block modal-block-lg zoom-anim-dialog modal-header-color modal-block-primary modal-with-footer">
    <section class="panel">
        <form action="{{$action}}" method="post" id="formRole"
              enctype="multipart/form-data">
            @csrf
            @isset($method)
                @method($method)
            @endisset
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="modal-dismiss"><i class="material-icons">close</i> </a>
                </div>
                <h2 class="panel-title">{{$panelTitle}}</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input type="text" class="form-control" placeholder="عنوان"
                                   name="title" id="title" value="{{$role->title}}" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">توضیح</label>
                            <input type="text" class="form-control" placeholder="توضیح"
                                   name="description" id="description"  value="{{$role->description}}" required/>
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
            ajaxComponents('#modalRole');
    });
</script>

