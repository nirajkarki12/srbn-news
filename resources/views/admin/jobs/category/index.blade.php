@extends('layouts.admin')

@section('title', 'Jobs Category')

@section('content-header', 'List of Jobs Categories')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><a href="{{route('jobs.category')}}"><i class="fa fa-folder-o"></i> Category</a></li>
@endsection

@section('content')

    @include('notification.notify')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">List of Categories</h3>
                    <div class="box-tools pull-right">
                        <a href="#" data-toggle="modal" data-target="#categoryModal" class="btn pull-right" title="Add a Category">
                            <span class="fa fa-plus"> New Category</span>
                        </a>
                    </div>
                </div>
                <div class="box-body">

                    @if(count($categories) > 0)

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="4%">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Name Nepali</th>
                                <th>Position</th>
                                <th class="text-center" width="11%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $key => $cat)
                                <tr>
                                    <td style="vertical-align:middle">{{ $key+1 }}</td>
                                    <td>
                                        <img src="{{$cat->image}}" alt="image" style="height:35px">
                                    </td>
                                    <td style="vertical-align:middle">
                                        {{ $cat->name }}
                                    </td>
                                   <td>{{$cat->name_nepali}}</td>
                                   <td>{{$cat->position}}</td>


                                    <td style="vertical-align:middle" class="text-center">
                                        <span class="btn btn-warning btn-xs" onclick="edit({{$cat}})" style="cursor: pointer" title="Edit category">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </span>
                                        &nbsp;
                                        <a class="btn btn-danger btn-xs" href="{{route('jobs.category.delete' , $cat)}}" title="Delete a category" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3 class="no-result">No results found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form" action="{{route('jobs.category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

{{--                    <div class="modal-header">--}}
{{--                        <span>Add Category</span>--}}
{{--                    </div>--}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Name of job category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name Nepali</label>
                            <input type="text" id="name_nepali" name="name_nepali" value="{{old('name_nepali')}}" placeholder="Name of job category in nepali" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" name="position" id="position" placeholder="Order of the category" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                        <div id="image-file">

                        </div>

                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function edit(category){
            $('#name').val(category.name)
            $('#name_nepali').val(category.name_nepali)
            $('#position').val(category.position)

            $('#image-file').html(`<img src="${category.image}" style="height:35px" title="${category.name}"/>`)

            $('#categoryModal').modal('show')
            $('#form').attr('action', `{{route('jobs.category.store')}}/${category.id}`);
            $('#image').removeAttr('required');
        }

        $('#categoryModal').on('hidden.bs.modal', function (e) {
            $('#categoryModal').find('form')[0].reset();
            $('#image').attr('required', true);
            $('#image-file').html('')
            $('#form').attr('action', `{{route('jobs.category.store')}}`);
        })
    </script>
@endsection
