
@extends('layouts.app')


@section('content')
           
            <div class="row tm-row">
                @if($noCategoryBlogsMessage)
                    <p>{{ $noCategoryBlogsMessage }}</p>
                @else
                @foreach ($categoryBlogs as $row )
                @php
                    // Calculate the difference in days between post creation date and current date
                    $daysDifference = now()->diffInDays($row->created_at);
                @endphp
                    <article class="col-12 col-md-6 tm-post">
                    <hr class="tm-hr-primary">
                    <a href="{{ route('front-blog',$row->url_slug) }}" class="effect-lily tm-post-link tm-pt-60">
                        <div class="tm-post-link-inner">
                            @if ($row->image)
                               <img src="{{ asset($row->image) }}" alt="Image" style="aspect-ratio: 16/9;" class="img-fluid">
                            @else
                               <img src="img/img-01.jpg" alt="Image" style="aspect-ratio: 16/9;" class="img-fluid"> 
                            @endif
                                                        
                        </div>
                        @if ($daysDifference <= 1) <!-- Display "New" badge if post is within 7 days old -->
                            <span class="position-absolute tm-new-badge">New</span>
                        @endif
                        
                        <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $row->blog_title }}</h2>
                    </a> 
                    <div class="d-flex justify-content-between tm-pt-45">
                        <span class="tm-color-primary">{{ $row->category->category_name }}</span>
                        <span class="tm-color-primary">{{ date("d-m-Y, h:i a", strtotime($row->created_at)) }}</span>
                    </div>
                </article>
                @endforeach
                @endif
                
            </div>
            <div class="row tm-row tm-mt-50 tm-mb-75">
                <div class="tm-paging-wrapper">
                       {{ $categoryBlogs->links('pagination::simple-bootstrap-5') }}
                </div>                
            </div> 

            @endsection