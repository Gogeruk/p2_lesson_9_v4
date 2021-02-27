@extends('layout')

@section('list-posts')
    <div class="m-3 border border-danger">
        <div class="form-group row m-2">
            <div class="m-3">
                <h2 class="mb-3 text-center">List-posts</h2>
                @forelse ($posts as $post)
                    @if ($loop->first)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Category_id</th>
                                </tr>
                            </thead>
                    @endif
                        <tbody>
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->category_id }}</td>
                                <td>
                                    <button onclick="location.href='/post/{{ $post->id }}/update'" type="submit" class="btn btn-danger" name="button">update</button>
                                    <button onclick="location.href='/post/{{ $post->id }}/delete'" type="submit" class="btn btn-danger" name="button">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    @if ($loop->last)
                        </table>
                    @endif
                    @empty
                        <p class="m-3 text-center">No posts, sorry fren. Better luck next time.</p>
                    @endforelse
                    @if(isset($_SESSION['status']))
                        <p class="m-3 text-center">{{ $_SESSION['status'] }}</p>
                    @endif
                <div class="m-3 text-center">
                    <button onclick="location.href='/post/create'" type="submit" class="btn btn-danger" name="button">create a new post</button>
                </div>
                @include('pages.pagination.pagination', ['pagination_of' => $_SESSION['pagination_of']])
                @php
                    unset($_SESSION['status'])
                @endphp
            </div>
        </div>
@endsection
