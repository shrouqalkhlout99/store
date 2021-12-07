@extends('layouts.admin')
@section('title','Create New Category')


@section('content')

    <form enctype="multipart/form-data" method="post" action="{{route('categories.store')}} ">
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
                            <label for="inputName"> {{__('Category Name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                            @error('name')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="inputDescription"> {{__('Description')}}</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"> {{old('description')}} </textarea>
                            @error('description')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">{{__('parent')}}</label>
                            <select class="form-control custom-select  @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option selected disabled value="">No Parent</option>
                                @foreach($parents as $parent)
                                    <option value="{{$parent->id}}" @if($parent->id == old('parent->id')) selected @endif>{{$parent->name}} </option>

                                @endforeach
                                @error('parent_id')
                                <p class="invalid-feedback" >{{$message}}</p>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">{{__('image')}}</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('status')}}</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_active" value="active" @if(old('status') == 'active') checked @endif>
                                <label class="form-check-label" for="status_active">
                                    {{__('Active')}}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_draft" value="draft" @if(old('status') == 'draft') checked @endif>
                                <label class="form-check-label" for="status_draft">
                                    {{__('Draft')}}
                                </label>
                            </div>
                            @error('status')
                            <p class="invalid-feedback" >{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary"> {{__('Add')}}</button>
                        </div>
                    </div>
                    <!-- /.card-body -->

            </form>


@endsection
