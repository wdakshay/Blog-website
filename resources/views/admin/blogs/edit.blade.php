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
                                            <input type="hidden" name="id" class="form-control" value="{{ $blog->id }}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                        <label for="blog">Blog Title</label>
                                                        <input type="text" name="blog_title" id="blog" class="form-control" value="{{ $blog->blog_title }}">
                                                    
                                                </div> 
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                        <label for="image">Image</label>
                                                        <input type="file" name="image" id="image" class="form-control" value="">
                                                        <input type="hidden" name="old_image" class="form-control" value="{{ $blog->image }}">
                                                        @if ($blog->image)
                                                            <img style="width: 100px" src="{{ asset( $blog->image) }}" alt="">
                                                        @endif
                                                    
                                                </div> 
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                        <label for="blog">Categories</label>
                                                        <select name="category_id[]" id="" class="form-control" multiple>
                                                            @foreach ( $categories as $value )
                                                                <option value="{{ $value->id }} " @if(in_array($value->id, $blog_categories)) selected @endif>{{ $value->category_name }}</option>
                                                            @endforeach
                                                        
                                                        </select>                                                    
                                                </div> 
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group mb-3">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="" class="form-control">
                                                            <option value="">Please Select</option>
                                                            <option value="active" @if($blog->status == 'active') selected @endif>Active</option>
                                                            <option value="inactive" @if($blog->status == 'inactive') selected @endif>Inactive</option>
                                                        </select>
                                                        <br>

                                                        <label for="displayOnHome">Display On Home</label><br>
                                                <div class="radio radio-info form-check-inline">
                                                   <input type="radio" id="displayOnHome1" value="1 @if($blog->display_on_home == 1) checked @endif" name="display_on_home" checked="">
                                                   <label for="displayOnHome1"> Yes </label>
                                                </div>
                                                <div class="radio radio-info form-check-inline">
                                                   <input type="radio" id="displayOnHome0" value="0 @if($blog->display_on_home == 0) checked @endif" name="display_on_home" checked="">
                                                   <label for="displayOnHome0"> No </label>
                                                </div>
                                                </div>
                                                
                                            </div> 
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label for="description" class="sub-header">Description</label>
                                                    <!-- Add a textarea within the Snow editor container -->
                                                    <textarea id="editor" class="form-control" name="descritption" style="height: 300px;" value="{{ $blog->descritption}}">{{ $blog->descritption}}</textarea>
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
                    <script>
                    var quill = new Quill('#snow-editor', {
                    theme: 'snow',
                    });

                    // Update hidden textarea on editor change
                    quill.on('text-change', function () {
                    document.getElementById('description').value = quill.root.innerHTML;
                    });
                    </script>
@endsection