@extends('layouts.frontend.app')

@push('css')

    <link href="{{ asset('assets/frontend/css/category/css/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/category/css/responsive.css')}}" rel="stylesheet">

    <style>
        .favorite_posts{
            color: blue;
        }
        .slider {
            background-image: url('https://images.pexels.com/photos/958168/pexels-photo-958168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940')!important; 
        }
    </style>
@endpush

@section('content')
		<div class="slider display-table center-text">
			<h1 class="title display-table-cell"><b>ALL POST</b></h1>
		</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				@foreach( $posts as $post )
					<div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->title }}"></div>

                            <a class="avatar" href="{{ route('author.profile',$post->user->username) }}"><img src="https://playjoor.com/assets/avatar/patrick.png" alt="{{ $post->user->name }}"></a>

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


			</div><!-- row -->

			<b>{{ $posts->links() }}</b>

		</div><!-- container -->
	</section><!-- section -->
@endsection