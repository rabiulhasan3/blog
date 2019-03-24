@extends('layouts.backend.app')

@section('title','Create Tag')

@push('css')

@endpush

@section('content')
<div class="container-fluid">


    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Category
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="email_address" autocomplete="off" class="form-control" name="name">
                                <label class="form-label">Category Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Category Image</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                        </div>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->


</div>
@endsection

@push('scripts')

@endpush