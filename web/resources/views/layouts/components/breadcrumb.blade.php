<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-start">
                {{ $breadcrumb_title ?? '' }}
            </div>
            <div class="float-end">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">داشبورد</a></li>/
                    {{ $slot ?? ''}}
                </ol>
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div>
