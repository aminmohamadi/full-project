@extends('layouts.master')

@section('title')
    خانه
@endsection

@section('vendor_style')


@endsection
@section('style')

@endsection

@section('content')
    <form class="form" action="{{route("functionality.store")}}" method="post"
          id="formNewFunctionality">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-title">عملکردهای جدید</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-none" id="newFunctionalityTable">
                        <thead>
                        <tr>
                            <th class="row-counter">
                                <div class="form-check">
                                    <input disabled  type="checkbox" name="check-all" class="form-check-input" id="checkAll">
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
                            @foreach($items as $key =>$val)
                                @foreach($val as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td class="row-counter">
                                            <div class="form-check">
                                                <input type="checkbox" name="functionality[]"
                                                       class="form-check-input"
                                                       id="checkAction{{$item['gate']}}"
                                                       value="{{$item['gate']}}"  {{$item['checked'] == true ? 'checked' : ''}}>
                                                <label for="checkAction{{$item['gate']}}"></label>
                                            </div>
                                        </td>
                                        <td class="row-counter row-number">{{$i}}</td>
                                        <td class="text-center">{{$item['gate']}}</td>
                                    </tr>
                                @endforeach
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
