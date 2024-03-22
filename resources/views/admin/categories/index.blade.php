@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Categories</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Category Name</th>
                                                    <th>Created On</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        @foreach ($categories as $key=> $value )
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                            <td>{{ $value->category_name }}</td>
                                            <td>{{ date("d-m-Y, h:i a", strtotime($value->created_at)) }}</td>
                                            <td>
                                                <span class="badge @if($value->status == 'active') badge-success @else badge-danger @endif">
                                                    {{ $value->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-category', $value->id) }}" class="btn btn-blue btn-sm">Edit</a>
                                                @if ($value->status == 'active')
                                                <a href="{{ route('update-status',['categories',$value->id,'inactive']) }}" class="btn btn-danger btn-sm">Inactive</a>  
                                                @else  
                                                <a href="{{ route('update-status',['categories',$value->id,'active']) }}" class="btn btn-success btn-sm">Active</a>
                                                @endif
                                            </td>
                                            </tr>
                                        @endforeach
                                        
                                            <tbody>
                         
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                      
                        
                    </div> <!-- container -->

                </div> <!-- content -->
@endsection