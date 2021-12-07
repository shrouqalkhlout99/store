@extends('layouts.admin')
@section('title')
Trashed product
@endsection
@section('content')
    <x-alert />
    <div class="d-flex mb-4">

            <form action="{{ route('products.restore')}}" method="post" class="mr-3">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-sm btn-warning" >Restore All</button>
            </form>

      <form action="{{ route('products.forceDelete')}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger" >Empty trash</button>
            </form>
    </div>

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
                            <th>image</th>
                            <th>name</th>
                            <th>Category </th>
                            <th>Price</th>
                            <th>Qty.</th>
                            <th>status</th>
                            <th>Deleted At</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{ asset('uploads/'.$product->image_path)}}" width="60" alt=""> </td>
                                <td>{{$product->name_first}}</td>
                                <td>{{$product->category_name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->deleted_at}}</td>
                                <td>
                                    <form action="{{ route('products.restore', $product->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-sm btn-warning" >Restore</button>
                                    </form>
                                </td>
                                <td><form action="{{ route('products.forceDelete', $product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" >Force Delete</button>
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

