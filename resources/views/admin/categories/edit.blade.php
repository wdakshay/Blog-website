@extends('admin.layouts.admin-app')

@section('Admin-content')
    <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    
                                    <h4 class="page-title">Add Categories</h4>
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
                                        <form action="{{ route('store-category') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="id" class="form-control" value="{{ $category->id }}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                        <label for="category">Category</label>
                                                        <input type="text" name="category_name" id="category" class="form-control" value="{{ $category->category_name }}">
                                                        @if ($errors->any())
                                                            <div class=" help-block text-danger  ">{{ $errors->first('category_name') }}</></div>
                                                        @endif
                                                </div> 
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group mb-3">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                          <option value="" @if($category->status == '') selected @endif>Please Select</option>
                                                          <option value="active" @if($category->status == 'active') selected @endif>Active</option>
                                                          <option value="inactive" @if($category->status == 'inactive') selected @endif>Inactive</option>
                                                        </select>
                                                        @if ($errors->any())
                                                            <div class=" help-block text-danger">{{ $errors->first('status') }}</></div>
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