@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
                <div class="card">
                    <div class="card-header">検索フォーム</div>
                    <div class="card-body">
                        <form action="{{ route('serch') }}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('get')}}
                        <div class="form-group">
                            <label>商品名</label>
                            <input type="text" class="form-control col-md-12" placeholder="検索したい商品名を入力してください" name="product_name" >
                            <label>メーカー名</label>
                            <select class="form-control col-md-12" name="company_id">
                                <option value="">指定なし</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->company_id }}">{{ $product->company->company_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary col-md-5">検索</button>
                        </div>
                                <button type="button" class="btn btn-danger col-md-5" onclick="location.href='{{ route('create') }}'"  >{{ __('新規登録') }}</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">商品情報</div>
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
    
                        <table class="table table-image">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('ID')}}</th>
                                    <th scope="col">{{__('商品画像')}}</th>
                                    <th scope="col">{{__('商品名')}}</th>
                                    <th scope="col">{{__('価格')}}</th>
                                    <th scope="col">{{__('在庫数')}}</th>
                                    <th scope="col">{{__('メーカー名')}}</th>
                                    <th scope="col">{{__('詳細表示')}}</th>
                                    <th scope="col">{{__('削除')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($products)) 
                                    @foreach ($products as $product)  
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
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->company->company_name}}</td>
                                            <td><button class="btn btn-danger col-md-10" onclick="location.href='/{{ $product->id }}'">{{__('詳細')}}</button></td>
                                            <td><form method="POST" action="{{ route('delete', $product->id) }}" onsubmit="return checkDelete()">@csrf
                                            <button type="submit" class="btn btn-primary">削除</button>
                                            </form></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
    }
    </script> 

@endsection