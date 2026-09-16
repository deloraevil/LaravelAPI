@extends('template')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content">
            </div>

            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="img_path">Img_path</label>
                <input type="file" class="form-control" id="img_path" name="img_path">
            </div>

            <select class="form-control" id="is_published" name="is_published">
                <option value="1">Опубликован</option>
                <option value="0">Не опубликован</option>
            </select>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
