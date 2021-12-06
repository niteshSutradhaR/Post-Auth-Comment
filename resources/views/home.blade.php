@extends('layouts.app')

@section('content')
<div class="container">    
    <form class="row" id="create-post-form" action="{{route('post.create')}}" method="post">   
        <div class="col-md-3">
            @auth
            <input type="hidden" name="user_id" value="{{ \Crypt::encrypt(auth()->user()->id) }}">
            @endauth
            <input type="hidden" name="post_date" value="{{date('Y-m-d')}}">
            @csrf
        </div>      
        <div class="col-md-6">
                <div class="row form-group">
                    <label class="col-md-2" for="title">Title</label>     
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded" name="title" id="title" aria-describedby="title" placeholder="Enter title" required>
                    </div>
                </div> 
                <div class="row form-group">
                    <label class="col-md-2" for="description">Description</label>     
                    <div class="col-md-10">
                        <textarea class="form-control rounded" name="description" id="description" aria-describedby="description" placeholder="Enter description" required></textarea>
                    </div>
                </div>  
                <div class="row form-group">
                    <label class="col-md-2" for="tags">tags</label>     
                    <div class="col-md-10">
                        <textarea class="form-control rounded" id="post-tags" name="tags" id="tags" aria-describedby="tags" placeholder="Enter tags"></textarea>
                    </div>
                </div>
        </div>      
        <div class="col-md-3">
            <button class="btn btn-dark">Add Post</button>
        </div>
    </form>  
        <div class="row justify-content-end bg-dark mb-2">
            <div class="col-md-4 my-2"> 
                <form class="form-inline" action="{{url('/')}}">
                  <input class="form-control mr-sm-2" type="search" name="tags" placeholder="Search  by tags" aria-label="Search by tags">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    @if(count($posts) == 0)
        <div class="row justify-content-center">
            <div class="col-md-4 my-2 text-center"> 
                <h5>No Posts found ! Go to Home & add some.</h5>
            </div>
        </div>
    @endif
    <div class="row">      
        <div class="col-md-2">
            
        </div>      
        <div class="col-md-8">
            <div class="row">
                @if($posts)
                    @foreach($posts as $post)
                        <div class="col-md-12 mb-5">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">                
                                        <h5 class="card-title">Title : {{ $post->title ?? ''}} 
                                        </h5>
                                    </div>
                                    @auth
                                        @if($post->user_id==auth()->user()->id)
                                            <div class="col-md-1">                 
                                                <a href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-dark float-right mr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-dark float-right" id="delete-post"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                <form action="{{route('post.delete',['id'=>$post->id])}}" method="post" id="delete-post-form">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <p class="card-text">Description : <a href="{{ route('post.view', ['id'=>$post->id])}}">
                                @php 
                                    if($post->description && strlen($post->description)>50)
                                    {
                                        echo substr($post->description, 0, 50).". . . .";
                                    }
                                    else
                                    {
                                        echo $post->description;
                                    }
                                @endphp
                                </a></p>
                                <div class="row">
                                    <div class="col-md-4">
                                        Author : <label class="badge badge-dark">{{ $post->author ?? ''}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        Date : <label class="badge badge-dark">{{ date('d M Y', strtotime($post->post_date)) ?? ''}}</label>
                                    </div>
                                    <div class="col-md-4">
                                        @if(count($post->comments)>0)
                                            Comment/s : <label class="badge badge-dark">{{count($post->comments)}}</label>
                                        @endif
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                @endif                
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4" >
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>      
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
