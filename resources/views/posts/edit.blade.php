@extends('layouts.app')

@section('content')
<div class="container">    
    <form class="row justify-content-center" method="post" action="{{route('post.update',['id'=>$post->id])}}">  
        @csrf
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{$post->id}}">
        <div class="col-md-6">
            <div class="row form-group">
                <label class="col-md-2" for="title">Title</label>     
                <div class="col-md-10">
                    <input type="text" class="form-control rounded" name="title" id="title" aria-describedby="title" value="{{$post->title ?? ''}}" required>
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-md-2" for="description">Description</label>     
                <div class="col-md-10">
                    <textarea class="form-control rounded" name="description" id="description" aria-describedby="description" required>{{$post->description ?? ''}}</textarea>
                </div>
            </div>  
                <div class="row form-group">
                    <label class="col-md-2" for="tags">tags</label>     
                    <div class="col-md-10">
                        <textarea class="form-control rounded" id="post-tags" name="tags" id="tags" aria-describedby="tags" placeholder="Enter tags" >{{$post->tags ?? ''}}</textarea>
                    </div>
                </div>
            <div class="row form-group">
                <div class="col-md-12 text-right">
                    <button class="btn btn-dark">Update</button>
                </div>
            </div>
        </div>  
    </form>  
</div>
@endsection