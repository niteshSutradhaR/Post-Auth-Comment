@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">   
        <div class="col-md-3">
        </div>      
        <div class="col-md-6">
                <div class="row form-group">
                    <label class="col-md-2" for="title">Title</label>     
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded" name="title" id="title" aria-describedby="title" placeholder="Enter title">
                    </div>
                </div> 
                <div class="row form-group">
                    <label class="col-md-2" for="description">Description</label>     
                    <div class="col-md-10">
                        <textarea class="form-control rounded" name="description" id="description" aria-describedby="description" placeholder="Enter description"></textarea>
                    </div>
                </div>  
        </div>      
        <div class="col-md-3">
            <button class="btn btn-dark">Add Post</button>
        </div>
    </div> 
</div>
@endsection