@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                {{$ticket->subject}}
                <span class="pull-right">
                    <a href="#" class="btn btn-primary " onclick="event.preventDefault();
                            document.getElementById('complete').submit()">Mark Complete
                        {!! Form::open(['method'=>'put','id'=>'complete','hidden','route'=>['tickets.update',$ticket->id]]) !!}
                        {!! Form::close() !!}
                    </a>
                    <a href="#" class="btn btn-success ">Edit</a>
                    <a href="#" class="btn btn-danger " onclick="event.preventDefault();
                                                     document.getElementById('del-form').submit()">Delete
                        {!! Form::open(['method'=>'delete','id'=>'del-form','hidden','route'=>['tickets.destroy',$ticket->id]]) !!}
                        {!! Form::close() !!}
                    </a>
                </span>

            </h2>

        </div>
        <div class="panel-body">
            <div class="panel well">
                <div class="panel-body">

                    <div class="col-md-6">
                        <h4>Owner: <b>{{$ticket->owners->name}}</b></h4>
                        <h4>Status:<b style="color: {{$ticket->statuses->color}}">{{$ticket->statuses->name}}</b></h4>
                        <h4>Priority:<b style="color: {{$ticket->priorities->color}}">{{$ticket->priorities->name}}</b></h4>
                        <h4>Agent Assigned: <b>{{$ticket->agents->name}}</b></h4>
                    </div>

                    <div class="col-md-6">
                        <h4>Category: <b>{{$ticket->categories->name}}</b></h4>
                        <h4>Created: <b>{{$ticket->created_at->diffForHumans()}}</b></h4>
                        <h4>Updated: <b>{{$ticket->updated_at->diffForHumans()}}</b></h4>
                    </div>
                </div>
            </div>
            {{$ticket->content}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Comments
                <span class="pull-right">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addComment">
                        Add Comment
                    </a>
                </span>
            </h3>
        </div>
        <div class="panel-body">
            @if($ticket->comments->isEmpty())
                <h3 class="text-center">No comments available</h3>
            @else
                @foreach($ticket->comments as $comment)
                by {{$comment->users->name}} {{$comment->created_at->diffForHumans()}}
                <div class="panel well">
                    <div class="panel-body">
                        {!! $comment->content !!}
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    @include('partials._comment_modal')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#summertext').summernote();
        });
    </script>
@endsection
