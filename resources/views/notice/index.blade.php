@extends('layouts.app', ['page' => __('NOTICE MANAGEMENT'), 'pageSlug' => 'notice'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <a href="{{route('notice.create')}}">
                        <button class="btn btn-sm btn-primary animation-on-hover" type="button">New Notice</button>
                    </a>
                    
                    <form method="get" action="{{route('notice.search')}}">
                        @csrf
                        <div class="form-group">
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="search-type" value="author" checked> Author 
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="search-type" value="title"> Title
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-10">
                                <input type="text" class="form-control" name="search" placeholder="Search" required>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-round animation-on-hover mb-2">
                                    <i class="tim-icons icon-zoom-split"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('msg'))
                        <div class="alert
                            @if (session('msg.success'))
                                alert-success
                            @elseif (session('msg.error'))
                                alert-danger
                            @endif
                            alert-dismissible fade show" role="alert">
                            {{session('msg.msg')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    @endif

                </div>
                    
                <div class="card-body">
                    @if($notices->isEmpty())
                        <div class="alert alert-default" role="alert">
                            Nenhuma Notícia encontrada!
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notices as $notice)
                                    <tr>
                                        <td class="text-center">{{$notice->id}}</td>
                                        <td>{{$notice->author}}</td>
                                        <td>{{$notice->title}}</td>
                                        <td>{{$notice->created_at}}</td>
                                        <td>{{$notice->updated_at}}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{route('notice.show', ['id' => $notice->id])}}">
                                                <button type="button" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('notice.edit', ['id' => $notice->id])}}">
                                                <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                                    <i class="tim-icons icon-settings"></i>
                                                </button>
                                            </a>
                                            <form action="{{route('notice.destroy', ['id' => $notice->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$notices->links('pagination::bootstrap-4')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection