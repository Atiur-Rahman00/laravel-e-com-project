@extends('layouts.backendapp')
@section('title', 'Add Banner- ')



@section('content')

<div class="">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>Banner add form</h2>
                    <h2 class="ml-3"><a class="text-info" href="{{ route('backend.banner.index') }}">all banner</a></h2>
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.banner.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">banner title</lebel>
                            <input type="text" class = "form-control" name= "banner_title" placeholder="Enter banner title">
                            @error ('banner_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">banner description</lebel>
                            <textarea name="banner_description" class = "form-control" rows="4"></textarea>
                        </div>
                        <lebel class="form-lebel text-uppercase">banner image</lebel>
                            <input type="file" class = "form-control" name= "banner_image">
                            @error ('banner_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                           <button type="submit" class = "btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection