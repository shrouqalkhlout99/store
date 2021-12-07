@extends('layouts.admin')
@section('title','Create New product')


@section('content')

    <form enctype="multipart/form-data" method="post" action="{{route('products.store')}}">
        @csrf
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

    <section class="content">
        <div class="row">
            <form class="col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName"> product Name</label>
                            <input type="text" name="name_first" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                            @error('name')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="inputDescription"> Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"> {{old('description')}} </textarea>
                            @error('description')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputCategory">Category</label>
                            <select class="form-control custom-select @error('category_id') is-invalid @enderror" name="category_id">
                                <option selected disabled value="">select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id ==old('category_id',$category->category_id)) selected @endif>{{$category->name}} </option>

                                @endforeach
                                @error('category_id')
                                <p class="invalid-feedback" >{{$message}}</p>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sku"> SKU</label>
                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{old('sku')}}">
                            @error('sku')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="quantity">quantity</label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}">
                            @error('quantity')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="price"> price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
                            @error('price')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="sale_price"> Sale price</label>
                            <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{old('sale_price')}}">
                            @error('sale_price')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="width">width </label>
                            <input type="number" name="width" class="form-control @error('width') is-invalid @enderror" value="{{old('width')}}">
                            @error('width')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="weight"> weight</label>
                            <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{old('weight')}}">
                            @error('weight')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="height"> height</label>
                            <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" value="{{old('height')}}">
                            @error('height')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="length"> length</label>
                            <input type="number" name="name" class="form-control @error('length') is-invalid @enderror" value="{{old('length')}}">
                            @error('length')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="status">status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_active" value="active" @if(old('status') == 'active') checked @endif>
                                <label class="form-check-label" for="status_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_draft" value="draft" @if(old('status') == 'draft') checked @endif>
                                <label class="form-check-label" for="status_draft">
                                    Draft
                                </label>
                            </div>
                            @error('status')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary"> Add</button>
                        </div>
                    </div>
                    <!-- /.card-body -->

            </form>


@endsection
