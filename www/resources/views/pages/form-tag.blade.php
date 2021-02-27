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

@section('form-tag')
<div class="m-3 border border-danger">
    <div class="form-group row m-2">
        <div class="m-3 text-center">
            <div class="m-3 text-center">

                @if($_SESSION['creating'] === true)
                    <p class="mb-3">Create your tag plz</p>
                @else
                    <p class="mb-3">Update your tag plz</p>
                @endif
                    <form class="m-3" action="" method="post">
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
