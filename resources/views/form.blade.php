@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">新規登録</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="product_name">商品名</label>
                            <input id="product_name" name="product_name" class="form-control" value="{{ old('product_name') }}" type="text">
                            @if ($errors->has('product_name'))
                            <div class="text-danger">
                                {{ $errors->first('product_name') }}
                            </div>
                            @endif
                        <div class="form-group">
                            <label for="company_name">メーカー名</label>
                            <select class="form-control col-md-12" name="company_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->company_id }}">{{ $product->company->company_name }}</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">価格</label>
                            <input id="price" name="price" class="form-control" value="{{ old('price') }}" type="text">
                            @if ($errors->has('price'))
                            <div class="text-danger">
                                {{ $errors->first('price') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="stock">在庫</label>
                            <input id="stock" name="stock" class="form-control" value="{{ old('stock') }}" type="text">
                            @if ($errors->has('stock'))
                            <div class="text-danger">
                                {{ $errors->first('stock') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="comment">コメント</label>
                            <textarea id="comment" name="comment" class="form-control" rows="4">{{ old('comment') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="image" accept="image/png, image/jpeg">
                        </div>
                        <div class="mt-5">
                            <a class="btn btn-secondary" href="{{ route('home') }}">戻る</a>
                            <button type="submit" class="btn btn-danger">投稿する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection