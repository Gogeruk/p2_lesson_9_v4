@extends('layout')

@section('title-field')
<label for="title" class="col-sm-2 col-form-label">Title</label>
<div class="col-sm-10">
    <input type="text" name="title" class="form-control m-2" id="title" placeholder="your title" value="{{"$title"}}">
</div>
@endsection
@section('slug-field')
<label for="slug" class="col-sm-2 col-form-label">Slug</label>
<div class="col-sm-10">
    <input type="text" name="slug" class="form-control m-2" id="slug" placeholder="your slug" value="{{"$slug"}}">
</div>
@endsection
@section('body-field')
<label for="body" class="col-sm-2 col-form-label">Body</label>
<div class="col-sm-10">
    <input type="text" name="body" class="form-control m-2" id="body" placeholder="your body" value="{{"$body"}}">
</div>
@endsection
@section('cat-name-field')
<label for="category" class="form-label mb-3">Category</label>
<select id="category" name="category" class="form-select" aria-label="Default select example">
    <option selected>Choose your category plz</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" @if("{{ $category_s }}" == "{{ $category->id }}" ) selected=true @endif > {{ $category->title }} </option>
    @endforeach
</select>
@endsection

@section('tag-name-field')
<p>Choose tags plz</p>
<div class="form-check">
    <table class="table">
        <td>
        @foreach($tags as $key => $tag)
            <input class="form-check-input" type="checkbox" id="tags" name="tags[]" value="{{ $tag->id }}" @if(in_array($tag->id, $tags_s)) checked @endif>
            <label class="form-check-label" for="tags">{{ $tag->title }}</label>
            <br>
        @endforeach
        </td>
    <table>
</div>
@endsection

@section('form-post')
<div class="m-3 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3 text-center">
            <div class="m-3 text-center">
                <form class="m-3" action="" method="post">

                @if($_SESSION['creating'] === true)
                    <p class="mb-3">Create your post plz</p>
                @else
                    <p class="mb-3">Update your post plz</p>
                @endif
                    <div class="mb-3">
                        @yield('cat-name-field')
                        @if(isset($_SESSION['errors']['category']))
                            @foreach($_SESSION['errors']['category'] as $error)
                                <div class="mb-4 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group row">
                        @yield('title-field')
                        @if(isset($_SESSION['errors']['title']))
                            @foreach($_SESSION['errors']['title'] as $error)
                                <div class="mb-4 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group row">
                        @yield('slug-field')
                        @if(isset($_SESSION['errors']['slug']))
                            @foreach($_SESSION['errors']['slug'] as $error)
                                <div class="mb-4 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        @yield('body-field')
                        @if(isset($_SESSION['errors']['body']))
                            @foreach($_SESSION['errors']['body'] as $error)
                                <div class="mb-4 alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="mb-3">
                            @yield('tag-name-field')
                            @if(isset($_SESSION['errors']['tags']))
                                @foreach($_SESSION['errors']['tags'] as $error)
                                    <div class="mb-4 alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @php
                            unset($_SESSION['errors']);
                        @endphp
                    </div>
                    <button type="submit" class="btn btn-danger" id="button" name="submit">submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
