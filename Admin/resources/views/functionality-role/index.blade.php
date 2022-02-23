@extends('layouts.master')

@section('title')
    خانه
@endsection

@section('vendor_style')


@endsection
@section('style')

@endsection

@section('content')
    <form class="form" action="{{route("role.functionality.store",request()->role->id)}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="panel-title">عملکردهای نقش</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-none" id="newFunctionalityTable">
                        <thead>
                        <tr>
                            <th class="row-counter">
                                <div class="checkbox-custom checkbox-default checkbox-inline">
                                    <input disabled type="checkbox" name="check-all" class="check-all" id="checkAll">
                                    <label for="checkAll"></label>
                                </div>
                            </th>
                            <th class="row-counter">ردیف</th>
                            <th class="text-center">آدرس</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @if($items)
                            @foreach($items as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td class="row-counter">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="functionality[]"
                                                       id="checkAction{{$item['id']}}"
                                                       value="{{$item['id']}}"  {{$item['checked'] == true ? 'checked' : ''}}>
                                                <label for="checkAction{{$item['id']}}"></label>
                                            </div>
                                        </td>
                                        <td class="row-counter row-number">{{$i}}</td>
                                        <td class="text-center">{{$item['name']}}</td>
                                    </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info mb-none text-center">
                                        <i class="material-icons">info_outline</i>
                                        اطلاعاتی یافت نشد.
                                    </div>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                @if($items)
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="submit" class="mt-lg btn btn-primary btn-block">ذخیره</button>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>

@endsection


@section('top_scripts')

@endsection
@section('scripts')
@endsection
