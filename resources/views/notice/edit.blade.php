@extends('layouts.app', ['page' => __('NOTICE MANAGEMENT'), 'pageSlug' => 'notice'])

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('notice.update', ['id' => $notice->id]) }}" autocomplete="off">
          @csrf
          @method('put')
          
          <div class="form-group @if($errors->has('author')) has-danger @endif">
            <label for="author">Author</label>
            <input type="text" name="author"
            class="form-control @if($errors->has('author')) form-control-danger @endif"
            id="author" value="{{$notice->author}}" placeholder="Author" required>

            @if($errors->has('author'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first('author')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
              </div>
            @endif
          </div>
          <div class="form-group @if($errors->has('title')) has-danger @endif">
            <label for="title">Title</label>
            <input type="text" name="title"
            class="form-control @if($errors->has('title')) form-control-danger @endif"
            id="title" value="{{$notice->title}}" placeholder="Title" required>

            @if($errors->has('title'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first('title')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
              </div>
            @endif
          </div>
          <div class="form-group @if($errors->has('content')) has-danger @endif">
            <label for="content">Content</label>
            <textarea name="content"
            class="form-control @if($errors->has('content')) form-control-danger @endif"
            id="content" required>{{$notice->content}}</textarea>

            @if($errors->has('content'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first('content')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
              </div>
            @endif
          </div>
  
          <button type="submit" class="btn btn-sm btn-primary animation-on-hover">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection