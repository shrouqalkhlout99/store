@extends('layouts.admin')
@section('title')
    {{ $title }} <a href="{{ route('categories.create') }}">Create</a>
@endsection
@section('content')
    @if($success)
        <div class="alert alert-success">
{{$success}}
        </div>
    @endif

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
                            <th>{{__('Id')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Slug')}}</th>
                            <th>{{__('Parent Name')}}</th>
                            <td>{{__('Product Count')}}</td>
                            <th>{{__('status')}}</th>
                            <th>{{__('created At')}}</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parent->name}}</td>
                                <td>{{$category->count}}</td>
                                <td>{{$category->status}}</td>
                                <td>{{$category->created_at}}</td>
                                <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-dark">{{__('Edit')}}</a> </td>

                                <td><form action="{{ route('categories.destroy', $category->id)}}" method="post">
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


    {{$categories->links()}}
@endsection
