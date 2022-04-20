@extends('layouts.backendapp')
@section('title', 'Add category- ')



@section('content')


    <div class="row d-flex">
        <div class="col-lg-5 col-md-5">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>category add form</h2>
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">category name</lebel>
                            <input type="text" class = "form-control" name= "category_name" placeholder="Enter category">
                            @error ('category_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">parent name</lebel>
                            <select name="parent_name" id="" class="form-control">
                                <option disabled selected>select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">description</lebel>
                            <textarea class="form-control" name="category_description" rows="5"></textarea>
                            @error ('category_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <lebel class="form-lebel text-uppercase">category photo</lebel>
                            <input type="file" class = "form-control" name= "category_image">
                            @error ('category_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class = "btn btn-primary form-control">Add</button>
                         </div>
                    </form>


  


                </div>
            </div>
        </div>


        <div class="col-lg-7">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>Trashed Banner</h2>
                </div>
                <div class="card-body">
                   <table class="table table-bordered">
                       <thead>
                            <th>id</th>
                            <th>banner title</th>
                            <th>banner image</th>
                            <th>status</th>
                            <th>action</th>
                       </thead>
                       <tbody>
                            @foreach( $categories as $category )
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('/storage/uploads/category/'.$category->category_image) }}" 
                                        alt="{{ $category->slug }}">
                                    </td>
                                    <td>{{ $category->status == 1 ? 'active' : 'deactive' }}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ route('backend.banner.restore', $category->id) }}">Edit</a>  
                                        <button value="{{ route('backend.banner.permanent.delete', $category->id) }}" type="submit" class="permanent_delete btn btn-danger btn-sm">Delete</button>  
                                    </td>
                                </tr>
                                @if (!empty($category->childs))
                                    @foreach ($category->childs as $child)
                                    <tr>
                                        <td></td>
                                        <td> --{{ $child->category_name }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/uploads/category/'.$child->category_image) }}" 
                                            alt="{{ $child->slug }}">
                                        </td>
                                        <td>{{ $child->status == 1 ? 'active' : 'deactive' }}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ route('backend.banner.restore', $child->id) }}">Edit</a>  
                                            <button value="{{ route('backend.banner.permanent.delete', $child->id) }}" type="submit" class="permanent_delete btn btn-danger btn-sm">Delete</button>  
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                    
                                @endif
                            @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
</div>





@endsection