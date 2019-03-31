@extends('layouts.frontend.app')

@push('css')

    <link href="{{ asset('assets/frontend/css/category/css/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/category/css/responsive.css')}}" rel="stylesheet">

    <style>
        .favorite_posts{
            color: blue;
        }
        .slider {
            background-image: url({{ Storage::disk('public')->url('category/'.$category->image) }})!important; 
        }
    </style>
@endpush

@section('content')
		<div class="slider display-table center-text">
			<h1 class="title display-table-cell"><b> {{ strtoupper($category->name) }} POSTS</b></h1>
		</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

                @if($category->posts->count() > 0 )
				@foreach( $category->posts as $post )
					<div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}"></div>

                            <a class="avatar" href="#"><img src="https://playjoor.com/assets/avatar/patrick.png" alt="{{ $post->user->name }}"></a>

                                <div class="blog-info">

                                    <h4 class="title">
                                        <a href="{{ route('post.details',$post->slug) }}">
                                            <b>
                                                {{ $post->title }}
                                            </b>
                                        </a>
                                    </h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0)" onclick="toastr.info('To add favourite list. You need log in first :)','info',{
                                                    closeButton : true,
                                                    progressBar : true,
                                                })">
                                                    <i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" onclick="document.getElementById('favourite-form-{{ $post->id }}').submit()"
                                                    class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favourite_post' : '' }}"
                                                    >
                                                    <i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}
                                                </a>

                                                <form id="favourite-form-{{ $post->id }}" action="{{ route( 'post.favourite',$post->id ) }}" style="display: none" method="post">
                                                    @csrf
                                                    
                                                </form>
                                            @endguest
                                            
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
                @else

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-info">
                                <h4 class="title">
                                    <strong>Sorry, No post found :(</strong>
                                </h4>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endif
			</div><!-- row -->

			{{-- <b>{{ $posts->links() }}</b> --}}

		</div><!-- container -->
	</section><!-- section -->
@endsection