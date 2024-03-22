@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Users</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                         <div class="row">
                            <div class="col-xl-6">
                                <div class="card-box">
                                    <h4 class="header-title mb-4">Default Tabs</h4>
        
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Users
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                Admin
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="home">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr.No</th>
                                                                        <th>User Name</th>
                                                                        <th>Created On</th>
                                                                        <th>Email</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                            @foreach ($users as $key=> $value )
                                                                <tr>
                                                                    <td>{{ ++$key }}</td>
                                                                <td>{{ $value->name }}</td>
                                                                <td>{{ date("d-m-Y, h:i a", strtotime($value->created_at)) }}</td>
                                                                <td>
                                                                   {{ $value->email }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('edit-blog', $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
                                        </div>
                                        <div class="tab-pane show active" id="profile">
                                             <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr.No</th>
                                                                        <th>Admin</th>
                                                                        <th>Created On</th>
                                                                        <th>Email</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                            @foreach ($admin as $key=> $value )
                                                                <tr>
                                                                    <td>{{ ++$key }}</td>
                                                                <td>{{ $value->name }}</td>
                                                                <td>{{ date("d-m-Y, h:i a", strtotime($value->created_at)) }}</td>
                                                                <td>
                                                                   {{ $value->email }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('edit-blog', $value->id) }}" class="btn btn-blue btn-sm">Edit</a>
                                                                    <a href="{{ route('edit-blog', $value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
                                        </div>
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                  </div> <!-- container -->

                </div> <!-- content -->
@endsection