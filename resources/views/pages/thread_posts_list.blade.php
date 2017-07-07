@extends('layouts.masters.main')

@section('page-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$category->name}}
                </div>

                <div class="panel-body">
                    <div class="col-md-4">
                        <a href="{{url('/create_post/' . $category->slug)}}">Make a post</a>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        Search for discussion post
                        <form role="form" method="POST" action="{{ route('search_post') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="search_category" value="{{$category->slug}}"></input>
                        <input style="width:55%;" type="text" name="search_title"></input>
                        <!-- aDD DROPDOWN -->
                        
                        <button type="submit" class="btn btn-primary">
                         Search
                        </button>
                    </form>
                    </div>
                    <br>
                    <!-- Visually this will be updated later -->
                    @if (count($posts['posts']) > 0)
                        @foreach($posts['posts'] as $post)
                            <br>
                            <div class="col-md-12 {{($post->pinned > 0) ? 'well' : ''}}">
                                <a href="{{url('/post/'.$post->slug)}}">{{$post->title}}</a>
                                @if($post->pinned > 0)
                                    <span style="color:green">Pinned *</span>
                                @endif
                                <p>{{$post->body}}</p>
                                Posted by: <a href="{{url('/profile/' . $post->user->name)}}">{{$post->user->name}}</a>
                                <br>
                                Created at: {{$post->created_at}}, Updated at: {{$post->updated_at}}
                                <br>
                                <br>
                                @if ($moderator)
                                    <form style="display:inline-table;" role="form" method="POST" action="{{ route('close_post') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{$post->id}}"></input>
                                        
                                        <button type="submit" class="btn btn-primary">
                                        Close Post
                                        </button>
                                    </form>
                                    <form style="display:inline-table;" role="form" method="POST" action="{{ route('open_post') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{$post->id}}"></input>
                                        
                                        <button type="submit" class="btn btn-primary">
                                        Open Post
                                        </button>
                                    </form>
                                @endif
                                @if ($admin)
                                    <form style="display:inline-table;" role="form" method="POST" action="{{ route('delete_post') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="post_id" value="{{$post->id}}"></input>
                                        
                                        <button type="submit" class="btn btn-danger">
                                        Delete Post
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @else
                        No posts :(
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
