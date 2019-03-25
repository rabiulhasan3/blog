@extends('layouts.backend.app')

@section('title','Create Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.cs')}}s" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.post.store')}}" method="post" enctype="multipart/form-data">
         @csrf

    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Post
                    </h2>
                </div>
                <div class="body">
                   
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tile" autocomplete="off" class="form-control" name="title">
                                <label class="form-label">Post Title</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Post Image</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                        </div>
                        <div class="form-group">
                             <input type="checkbox" id="publish" class="filled-in" name="status" value="1" />
                             <label for="publish">Filled In</label>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Categories & Tags
                    </h2>
                </div>
                <div class="body">
                   
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                <label for="">Select Category</label>
                                <select name="categories[]" class="form-control show-tick" data-live-search="true" multiple="true">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                <label for="">Select Tags</label>
                                <select name="tags[]" class="form-control show-tick" data-live-search="true" multiple="true">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <a href="{{ route('admin.post.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Body
                    </h2>
                </div>
                <div class="body">
                    <textarea id="tinymce" name="body"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->

    </form>


</div>
@endsection

@push('scripts')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
    <!-- Editor -->
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>
@endpush