@extends('layouts.admin')
@section('title')
    <div class="d-flex justify-content-between">
        <h2>products</h2>
        <a class="btn btn-sm btn-outline-primary" href="{{route('products.create')}}">create</a>
        <a class="btn btn-sm btn-outline-dark" href="{{route('products.trash')}}">trash</a>
    </div>


@endsection
@section('content')
  <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">


                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>{{__('image')}}</th>
                            <th>{{__('name')}}</th>
                            <th>{{__('Category')}} </th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Qty.')}}</th>
                            <th>{{__('status')}}</th>
                            <th>{{__('created At')}}</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{ $product->image_url}}" width="60" alt=""> </td>
                                <td>{{$product->name_first}}</td>
                                <td>{{$product->category->name}}/{{$product->category->parent->name}}</td>
                                <td>{{$product->format_price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td></td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->created_at}}</td>
                                <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-dark">{{__('Edit')}}</a> </td>
                                <td><form action="{{ route('products.destroy', $product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" >{{__('Delete')}}</button>
                                    </form></td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /تستخدم لاظهار الباجينت الي تم استخدامها بالكونترولور-->
{{$products->links('pagination')}}


@endsection
