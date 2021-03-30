@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">商品詳細</div>
                @if (session('err_msg'))
                    <p class="text-danger">
                        {{ session('err_msg') }}
                    </p>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--成功時のメッセージ--}}
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    {{-- エラーメッセージ --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif

                  
                  </button>

                    <div class="table-resopnsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('商品情報ID')}}</th>
                                    <th>{{__('商品画像')}}</th>
                                    <th>{{__('商品名')}}</th>
                                    <th>{{__('メーカー')}}</th>
                                    <th>{{__('価格')}}</th>
                                    <th>{{__('在庫数')}}</th>
                                    <th>{{__('コメント')}}</th>
                                    <th>{{__('編集')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($product))  
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td class="w-25">
                                                @if ($product->productimage != null)  
                                                    @foreach ($product->productimage as $item)
                                                        <img src="{{ Storage::url($item->getData() ) }}" class="img-fluid img-thumbnail"/> 
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->company_id }}</td>
                                            <td>{{ $product->price}}</td>
                                            <td>{{ $product->stock}}</td>
                                            <td>{{ $product->comment}}</td>
                                            <td><button class="btn btn-danger col-md-10" onclick="location.href='/edit/{{ $product->id }}'">{{__('編集')}}</button></td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-danger col-md-5" onclick="location.href='{{ route('home') }}'">戻る</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection