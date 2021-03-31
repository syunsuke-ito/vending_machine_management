@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">商品詳細</div>
                <div class="card-body">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>商品情報ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>メーカー</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>コメント</th>
                                <th>編集</th>
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
                                    <td><button class="btn btn-info col-md-10" onclick="location.href='/edit/{{ $product->id }}'">編集</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-secondary col-md-5" onclick="location.href='{{ route('home') }}'">戻る</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection