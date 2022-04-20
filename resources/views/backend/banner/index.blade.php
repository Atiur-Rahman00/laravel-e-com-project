@extends('layouts.backendapp')
@section('title', 'all banner - ')

@section('content')

<div class="">
    <div class="row">
        <div class="col-lg-12 m-auto">
        <div class="card">
                <div class="card-header d-flex">
                    <h2>All Banner</h2>
                    <h2 class="ml-3"><a class="text-info" href="{{ route('backend.banner.create') }}">add banner</a></h2>
                </div>
                <div class="card-body">
                   <table class="table table-bordered">
                       <thead>
                            <th>sl</th>
                            <th>banner title</th>
                            <th>banner description</th>
                            <th>banner image</th>
                            <th>creatated_at</th>
                            <th>status</th>
                            <th>action</th>
                       </thead>
                       <tbody>
                            @forelse ( $all_data as $data )
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $data->banner_title }}</td>
                                    <td>{{ Str::limit($data->banner_description, 30, '...') }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('/storage/uploads/banner/'.$data->banner_image) }}" 
                                        alt="{{ $data->banner_title }}">
                                    </td>
                                    <td>{{ $data->created_at->format('d-m-y') }}</td>
                                    <td>{{ $data->status == 1 ? 'active' : 'deactive' }}</td>
                                    <td>
                                        <a class="btn btn-{{ $data->status == 1 ? 'warning' : 'info' }} btn-sm" href="{{ route('backend.status.update', $data->id) }}">
                                            {{ $data->status == 1 ? 'deactive' : 'active' }}</a>
                                        <a class="btn btn-success btn-sm" href="{{ route('backend.banner.edit', $data->id) }}">Edit</a>
                                        <form class="d-inline" action="{{ route('backend.banner.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>  
                                    </td>
                                </tr>
                            @empty
                            <td class="text-danger text-center" colspan="10">No data added yet</td>  
                            @endforelse
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 m-auto">
        <div class="card">
            <div class="card-header d-flex">
                <h2>Trashed Banner</h2>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                   <thead>
                        <th>sl</th>
                        <th>banner title</th>
                        <th>banner description</th>
                        <th>banner image</th>
                        <th>creatated_at</th>
                        <th>status</th>
                        <th>action</th>
                   </thead>
                   <tbody>
                        @foreach( $trashed_data as $data )
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $data->banner_title }}</td>
                                <td>{{ Str::limit($data->banner_description, 30, '...') }}</td>
                                <td>
                                    <img width="100" src="{{ asset('/storage/uploads/banner/'.$data->banner_image) }}" 
                                    alt="{{ $data->banner_title }}">
                                </td>
                                <td>{{ $data->created_at->format('d-m-y') }}</td>
                                <td>{{ $data->status == 1 ? 'active' : 'deactive' }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('backend.banner.restore', $data->id) }}">Restore</a>  
                                    <button value="{{ route('backend.banner.permanent.delete', $data->id) }}" type="submit" class="permanent_delete btn btn-danger btn-sm">Permanent Delete</button>  
                                </td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
<div class="toast" style="position: absolute; top:0; right:0;" data-delay="6000">
    <div class="toast-header">
      <strong class="me-auto">{{ config('app.name') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
     {{ session('success') }}
    </div>
</div>
@endif
  
@endsection

@section('backend_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css">
@endsection

@section('backend_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.all.min.js"></script>
<script>
    $('.toast').toast('show')


    //for sweet alert
    $('.permanent_delete  ').on('click',function(){
        var btnrul = $(this).val();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = btnrul;
        }
        })
    });

</script>
@endsection