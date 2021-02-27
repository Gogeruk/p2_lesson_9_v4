@extends('layout')

@section('list-categories')
    <div class="m-3 border border-danger">
        <div class="form-group row m-2">
            <div class="m-3">
                <h2 class="mb-3 text-center">List-categories</h2>
                @forelse ($categories as $category)
                    @if ($loop->first)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                </tr>
                            </thead>
                    @endif
                        <tbody>
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <button onclick="location.href='/category/{{ $category->id }}/update'" type="submit" class="btn btn-danger" name="button">update</button>
                                    <button onclick="location.href='/category/{{ $category->id }}/delete'" type="submit" class="btn btn-danger" name="button">delete</button>
                                </td>
                            </tr>
                        </tbody>
                    @if ($loop->last)
                        </table>
                    @endif
                    @empty
                        <p class="m-3 text-center">No categories, sorry fren. Better luck next time.</p>
                    @endforelse
                    @if(isset($_SESSION['status']))
                        <p class="m-3 text-center">{{ $_SESSION['status'] }}</p>
                    @endif
                <div class="m-3 text-center">
                    <button onclick="location.href='/category/create'" type="submit" class="btn btn-danger" name="button">create a new category</button>
                </div>
                @include('pages.pagination.pagination', ['pagination_of' => $_SESSION['pagination_of']])
                @php
                    unset($_SESSION['status'])
                @endphp
            </div>
        </div>
@endsection
