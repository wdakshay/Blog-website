@extends('layouts.app')

@section('content')
    <div class="row tm-row">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    <!-- Video player 1422x800 -->
                    <img src="{{ asset($blog->image) }}" alt="" width="710" height="400" class="tm-mb-40">
                </div>
            </div>
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
                        <div class="mb-4">
                            <h2 class="pt-2 tm-color-primary tm-post-title">{{ $blog->blog_title }}</h2>
                            <p class="tm-mb-40">{{ date("d-m-Y, h:i a", strtotime($blog->created_at)) }} by Admin Nat</p>
                            <p>{!! $blog->descritption !!}</p>
                            <span class="d-block text-right tm-color-primary">
                                @if ($blogcategoryNames)
                                 @foreach ($blogcategoryNames as $cat)
                                    {{ $cat->category_name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                 @endforeach </span>
                                @endif
                        </div>
                        
                        <!-- Comments -->
                        <div>
                            <h2 class="tm-color-primary tm-post-title">Comments</h2>
                            <hr class="tm-hr-primary tm-mb-45">
                            @if($comments)
                            @foreach ($comments as $comment)
                                <div class="tm-comment tm-mb-45">
                                <figure class="tm-comment-figure">
                                    <img src="{{ asset('img/comment-1.jpg') }}" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                                    <figcaption class="tm-color-primary text-center">{{ $comment->full_name }}</figcaption>
                                </figure>
                                <div>
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                    <div class="d-flex justify-content-between g-2">
                                        <a href="#" class="tm-color-primary">REPLY</a>
                                        <span class="tm-color-primary">{{ date("d-m-Y, h:i a", strtotime($comment->created_at)) }} </span>
                                    </div>                                                 
                                </div>                                
                            </div>
                            @endforeach

                            @endif
                            
                            @if(Auth::check())
                                <form action="{{ route('submit-comment') }}" class="mb-5 tm-comment-form">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                                    <div class="mb-4">
                                        <input class="form-control" name="name" type="text" placeholder="Enter your name">
                                        @if ($errors->any())
                                            <div class=" help-block text-danger">{{ $errors->first('name') }}</></div>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <input class="form-control" name="email" type="text" placeholder="Enter you email">
                                        @if ($errors->any())
                                            <div class=" help-block text-danger">{{ $errors->first('email') }}</></div>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Write you message"></textarea>
                                        @if ($errors->any())
                                            <div class=" help-block text-danger">{{ $errors->first('message') }}</></div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="tm-btn tm-btn-primary tm-btn-small">Submit</button>                        
                                    </div>                                
                                </form>
                             @else
                                <!-- Show login/register prompt -->
                                <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to comment.</p>
                            @endif                          
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 tm-aside-col">
                    <div class="tm-post-sidebar">
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="mb-4 tm-post-title tm-color-primary">Categories</h2>
                        <ul class="tm-mb-75 pl-5 tm-category-list">
                            
                            @if ($categoryNames)
                                @foreach ($categoryNames as $cat)
                                    <li><a href="{{ route('front-category', $cat->url_slug) }}" class="tm-color-primary">{{ $cat->category_name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
                        
                        @if($noRelatedPostMessage)
                            <p>{{ $noRelatedPostMessage }}</p>
                        @else
                            @if ($relatedBlogs)
                            @foreach ($relatedBlogs as $post )
                                <a href="{{ $post->url_slug }}" class="d-block tm-mb-40">
                            <figure>
                                <img src="{{ asset($post->image) }}" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">{{ $post->blog_title }}</figcaption>
                            </figure>
                           </a>
                            @endforeach

                        @endif
                        @endif
                    </div>                    
                </aside>
            </div>
@endsection