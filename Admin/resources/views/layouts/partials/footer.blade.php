
<footer class="footer text-center text-sm-start">
    &copy; <script>
        document.write(new Date().getFullYear())
    </script> امین محمدی
</footer>
<div class="modal fade" id="delete-modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="deleteItem" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">اخطار</h2>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="row text-left" style="display: contents">
                    <div class="modal-icon text-warning mr-5 ml-2" style="font-size: 60px">
                        <i class="fa fa-warning"></i>
                    </div>
                    <div class="modal-text ml-3">
                        <h4>اخطار</h4>
                        <p>آیا از انجام عملیات اطمینان دارید؟</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-danger modal-confirm" id="modal-confirm" type="submit">بله</button>
                        <button class="btn btn-info" data-dismiss="modal">خیر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-item" tabindex="-1" aria-labelledby="delete-item-title" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="delete-item-title">اخطار</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="modal-icon text-warning mr-5 ml-2" style="font-size: 60px">
                            <i class="fa fa-info-circle"></i>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="modal-text ml-3">
                            <h4>اخطار</h4>
                            <p>آیا از انجام عملیات اطمینان دارید؟</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">خیر</button>
                        <button class="btn btn-danger modal-confirm" id="modal-confirm" type="submit">بله</button>
                    </div>
                </div>
            </div>

        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
