@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Blogs</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                <div class="row">
                            <div class="col-12">
                                <!-- project card -->
                                <div class="card d-block">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-dots-3"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                                <a href="{{ route('edit-blog', $blog->id) }}" class="dropdown-item"><i class="mdi mdi-pencil mr-1"></i>Edit</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>Delete</a>
                                            </div>
                                        </div>
                                        <!-- project title-->
                                        <h3 class="mt-0 font-20">
                                            {{ $blog->blog_title }}
                                        </h3>
                                        <div class="badge @if ($blog->status == 'active') btn-success @else btn-danger  @endif mb-3">{{ $blog->status }}</div>

                                        <p class="text-muted mb-2"><img src="{{ asset($blog->image) }}" alt="Blog_image" style="width: 500px"></p>

                                        <p class="text-muted mb-2">
                                           {!! $blog->descritption !!}
                                        </p>

                                        <div class="mb-4">
                                            <h5>Categories</h5>
                                            <div class="text-uppercase">
                                                @foreach ($blog_categories as $value)
                                                    <a href="" class="badge badge-soft-primary mr-1">{{ $value->category_name }}</a>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-4">
                                                    <h5>Created</h5>
                                                    <p>{{ date("d-m-Y, h:i a", strtotime($blog->created_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-4">
                                                    <h5>Updated</h5>
                                                    <p>{{ date("d-m-Y, h:i a", strtotime($blog->updated_at)) }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end card-body-->
                                    
                                </div> <!-- end card-->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-right">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-dots-3"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Latest</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Popular</a>
                                            </div>
                                        </div>

                                        <h4 class="mt-0 mb-3">Comments</h4>

                                        <div class="mt-2">
                                            @foreach ($comments as $comment)
                                                <div class="media mt-3">
                                                <img class="mr-2 avatar-sm rounded-circle" src="{{ asset('assets/images/users/user-2.jpg') }}"
                                                    alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0"><a href="contacts-profile.html" class="text-reset">{{ $comment->full_name }}</a> <small class="text-muted">{{ date("d-m-Y, h:i a", strtotime($comment->created_at)) }}</small></h5>
                                                   {{ $comment->comment }}
                                                </div>
                                                <a href="#" class="btn btn-success btn-sm">Approve</a>
                                                <a href="#" class="btn btn-danger btn-sm">Reject</a>
                                            @endforeach
                                            
                                            </div>
                                    </div> <!-- end card-body-->
                                </div>


                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

                      
                        
                    </div> <!-- container -->

                </div> <!-- content -->
@endsection