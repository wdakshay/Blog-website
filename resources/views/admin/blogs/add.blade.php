@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Add Blog</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">New</h4>
                                        <hr>
                                        <form action="{{ route('store-blog') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                            <label for="blog">Blog Title</label>
                                                            <input type="text" name="blog_title" id="blog" class="form-control" value="{{ old('blog_title') }}">
                                                            @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('blog_title') }}</></div>
                                                            @endif
                                                        
                                                    </div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                            <label for="image">Image</label>
                                                            <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                                                            @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('image') }}</></div>
                                                            @endif
                                                        
                                                    </div> 
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                            <label for="blog">Categories</label>
                                                            <select name="category_id[]" id="" class="form-control" multiple>
                                                                @foreach ( $categories as $value )
                                                                    <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                                                @endforeach
                                                            
                                                            </select>
                                                            @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('category_id') }}</></div>
                                                            @endif                                                    
                                                    </div> 
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                            <label for="status">Status</label>
                                                            <select name="status" id="" class="form-control">
                                                                <option value="">Please Select</option>
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                            </select>
                                                            @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('status') }}</></div>
                                                            @endif
                                                            <br>

                                                            <label for="displayOnHome">Display On Home</label><br>
                                                    <div class="radio radio-info form-check-inline">
                                                    <input type="radio" id="displayOnHome1" value="1" name="display_on_home" checked="">
                                                    <label for="displayOnHome1"> Yes </label>
                                                    </div>
                                                    <div class="radio radio-info form-check-inline">
                                                    <input type="radio" id="displayOnHome0" value="0" name="display_on_home" checked="">
                                                    <label for="displayOnHome0"> No </label>
                                                    </div>
                                                    @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('display_on_home') }}</></div>
                                                            @endif
                                                    </div>
                                                    
                                                </div> 
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="description" class="sub-header">Description</label>
                                                        <!-- Add a textarea within the Snow editor container -->
                                                        <textarea id="snow-editor" class="form-control" name="descritption" style="height: 300px;">{{ old('descritption') }}</textarea>
                                                        @if ($errors->any())
                                                                <div class=" help-block text-danger">{{ $errors->first('descritption') }}</></div>
                                                            @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                      
                        
                    </div> <!-- container -->

                </div> <!-- content -->
                    
@endsection