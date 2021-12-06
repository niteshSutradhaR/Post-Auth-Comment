@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">  
        <div class="col-md-6">
            <div class="row form-group">
                <label class="col-md-2" for="title">Title</label>     
                <div class="col-md-10">
                    <input type="text" class="form-control rounded" name="title" id="title" aria-describedby="title" value="{{$post->title ?? ''}}" readonly>
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-md-2" for="description">Description</label>     
                <div class="col-md-10">
                    <textarea class="form-control rounded" name="description" id="description" aria-describedby="description" readonly>{{$post->description ?? ''}}</textarea>
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-md-2" for="description">tags</label>     
                <div class="col-md-10">
                	@if($post->tags!=Null)
                		@foreach($post->tags as $tag)
                			<label class="badge badge-dark">{{$tag}}</label>
                		@endforeach
                	@endif
                </div>
            </div>   
        </div>  
    </div>  
	<form class="row justify-content-center mt-2" action="{{route('post.comment')}}" method="post">
		@csrf
        <div class="col-md-6">
        	<input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="row form-group">
                <label class="col-md-2" for="comment">Comment</label>     
                <div class="col-md-10">
                    <textarea class="form-control rounded" name="comment" id="comment" aria-describedby="comment" placeholder="Enter comment" required></textarea>
                </div>
            </div>  
            <div class="row form-group">
            	<div class="col-md-12">
            		<button class="btn btn-dark float-right">Add</button>
            	</div>
            </div>
        </div>
	</form>   
	<hr>  
	@if(count($post->comments)!=0)
		<div class="row">
			<div class="col-md-12 text-center">
				<h3>Comments</h3>
			</div>
		</div>
	    	@foreach($post->comments as $comment)
			    <div class="row justify-content-center">
			        <div class="col-md-6">
			            <div class="row form-group">     
			                <div class="col-md-12">
			                    <textarea class="form-control rounded" name="comment" id="comment" aria-describedby="comment" readonly>{{$comment->comment ?? ''}}</textarea>
			                </div>    
			                <div class="col-md-6">
			                	<label class="badge badge-dark">By :  {{$comment->user->name ?? ''}}</label>
			                </div>  
			                <div class="col-md-6 text-right">
			                	<label class="badge badge-dark"> {{date('d M Y H: i A',strtotime($comment->created_at))}}</label>
			                </div>
			            </div>  
			        </div>
			    </div>
	        @endforeach
    @endif
</div>
@endsection