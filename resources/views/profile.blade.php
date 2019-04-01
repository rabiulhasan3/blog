@extends('layouts.frontend.app')

@section('title')
	{{ $author->name }} Profile
@endsection

@push('css')

    <link href="{{ asset('assets/frontend/css/category-sidebar/css/styles.css')}}" rel="stylesheet">

	<link href="{{ asset('assets/frontend/css/category-sidebar/css/responsive.css')}}" rel="stylesheet">
@endpush

@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{ strtoupper($author->name) }}</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">

						@if($posts->count() > 0)

						@foreach( $posts as $key=>$post)
							<div class="col-md-6 col-sm-12">
								<div class="card h-100">
									<div class="single-post post-style-1">

										<div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image )}}" alt="Blog Image"></div>

										<a class="avatar" href="{{ route('author.profile',$post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>

										<div class="blog-info">

											<h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>

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

										</div><!-- blog-info -->
									</div><!-- single-post -->
								</div><!-- card -->
							</div>
						@endforeach
						@else
						<div class="col-lg-12 col-md-12">
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

					<b>{{ $posts->links() }}</b>

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>Since At  <strong>{{ $author->created_at->toDateString() }}</strong></p>
							<p>{{ $author->about }}</p>
							<p>Total Post  <strong>{{ $author->posts->count() }}</strong></p>
						</div>

						

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->
@endsection