@extends('layouts.app', ['page' => __('NOTICE MANAGEMENT'), 'pageSlug' => 'notice'])

@section('content')

    <div class="row">
        <div class="rol-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="display-4 text-center">{{$notice->title}}</h1>
                    <p class="lead">Author: {{$notice->author}}</p>
                    <hr class="my-4">
                </div>
                <div class="card-body">
                    <p>{{$notice->content}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection