@extends('layouts.admin')
@section('title','Edit Category')


@section('content')
    <form enctype="multipart/form-data" method="post" action="{{route('products.update',$product->id)}}">

        @csrf
        @method('put')
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $message)
                        <li>
                            {{$message}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" name="_method" value="put">
        <section class="content">
            <div class="row">
                <form class="col-12">


                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName"> {{__('product Name')}}</label>
                            <input name="name" class="form-control" value="{{$product->name}}">

                        </div>
                        <div class="form-group">
                            <label for="inputDescription"> {{__('Description')}}</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{old('description',$product->description)}} </textarea>
                            @error('description')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-form-select name="category_id" label="Category" :options="$categories" :selected="$product->category_id" />
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="inputStatus">Category</label>--}}
{{--                            <select class="form-control custom-select @error('category_id') is-invalid @enderror" name="category_id">--}}
{{--                                <option selected disabled value="">select category</option>--}}
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->id}}" @if($category->id ==old('category_id',$category->category_id)) selected @endif>{{$category->name}} </option>--}}

{{--                                @endforeach--}}
{{--                                @error('category_id')--}}
{{--                                <p class="invalid-feedback" >{{$message}}</p>--}}
{{--                                @enderror--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="inputImage">{{__('image')}}</label>

                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sku"> {{__('SKU')}}</label>
                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{old('sku')}}">
                            @error('sku')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="quantity">{{__('quantity')}}</label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}">
                            @error('quantity')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="price"> {{__('price')}}</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                            @error('price')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="sale_price"> {{__('Sale price')}}</label>
                            <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{old('sale_price')}}">
                            @error('sale_price')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="width">{{__('width')}} </label>
                            <input type="number" name="width" class="form-control @error('width') is-invalid @enderror" value="{{old('width')}}">
                            @error('width')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="weight"> {{__('weight')}}</label>
                            <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight')}}">
                            @error('weight')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="height"> {{__('height')}}</label>
                            <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" value="{{old('height')}}">
                            @error('height')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="length"> {{__('length')}}</label>
                            <input type="number" name="length" class="form-control @error('length') is-invalid @enderror" value="{{old('length')}}">
                            @error('length')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>

                        <div class="form-group">
                       <label for="status">{{__('status')}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_active" value="active" @if(old('status',$product->status) == 'active') checked @endif>
                                <label class="form-check-label" for="status_active">
                                    {{__('Active')}}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_draft" value="draft" @if(old('status',$product->status) == 'draft') checked @endif>
                                <label class="form-check-label" for="status_draft">
                                    {{__('Draft')}}
                                </label>
                            </div>
                            @error('status')
                            <p class="text-danger" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary"> {{__('update')}}</button>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </form>


@endsection
