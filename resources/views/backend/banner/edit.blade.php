@extends('layouts.backendapp')
@section('title', 'edit Banner- ')



@section('content')

<div class="">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>Banner edit form</h2>
                    <h2 class="ml-3"><a class="text-info" href="{{ route('backend.banner.index') }}">all banner</a></h2>
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.banner.update', $banner->id) }}" method="post" 
                    enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">banner title</lebel>
                            <input type="text" class = "form-control" name= "banner_title" 
                            value="{{ $banner->banner_title }}">
                            @error ('banner_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">banner description</lebel>
                            <textarea name="banner_description" class = "form-control" rows="4">{{ $banner->banner_description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">banner image</lebel>
                            <input type="file" class = "form-control mb-2" id="upload_image" name= "banner_image">
                            <img width="150" id="insert_image" src="{{ asset('/storage/uploads/banner/'.$banner->banner_image) }}" 
                            alt="{{ $banner->banner_title }}">
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
@section('backend_js')
    <script>
        var upload_image = document.getElementById('upload_image');
        var insert_image = document.getElementById('insert_image');

        upload_image.addEventListener("change", function(){
            insert_image.src = window.URL.createObjectURL(upload_image.files[0]);
        });
    </script>
@endsection