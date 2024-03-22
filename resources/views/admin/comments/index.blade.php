@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                             @if(session('success'))
                        <div class="alert alert-success">
                        {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                        {{ session('error') }}
                        </div>
                        @endif
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Comments</h4>
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
                                                    <th>Full Name</th>
                                                    <th>Created On</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        @foreach ($comments as $key=> $value )
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                            <td>{{ $value->full_name }}</td>
                                            <td>{{ date("d-m-Y, h:i a", strtotime($value->created_at)) }}</td>
                                            <td>
                                                <span class="badge @if($value->status == 'active') badge-success @else badge-danger @endif">
                                                    {{ $value->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('delete-comment', $value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                                @if ($value->status == 'active')
                                                <a href="{{ route('update-status',['blog_comments',$value->id,'inactive']) }}" class="btn btn-danger btn-sm">Reject</a>  
                                                @else  
                                                <a href="{{ route('update-status',['blog_comments',$value->id,'active']) }}" class="btn btn-success btn-sm">Approved</a>
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