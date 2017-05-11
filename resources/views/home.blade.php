@extends('layouts.app')
@section('header')
<style>
.post_style{
    background-color:white;
    color:#2B2B2B;
    margin-top: 10px;
    width:700px;   
    border-radius: 5px;
    box-shadow: 2px 2px 10px rgba(1,1,1,0.2);
    padding: 20px;
    margin-bottom: 5px;
    transition: all 500ms ease;
    display:block; 
}
.post-style:hover{
    box-shadow: 2px 2px 12px rgba(1,1,1,0.7);
}
.item{
    width:100px;
}
.item_style{
      background-color:#2A3891;
    color:white;
    height: 20px; 
}
.padd{
    padding-left: 50px;
}
p{
    color:#003663;
    font-style: italic;
}
</style>
<!-- Custom CSS -->
    <link href="/css/simple-sidebar.css" rel="stylesheet"></link>
@stop

@section('content')
<div class="container">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                @foreach($courses as $course)
           @if( $course->semester == Auth::user()->semester)
                <li class="sidebar-brand">
                    <a href="{{$course->path_user()}}">
                        {{ $course->name }}
                    </a>
                </li> 
               @endif
                @endforeach           
            </ul>
        </div>
    </div>
        <!-- end sidebar-wrapper -->
 <div class="container ">
    <div class="row media">
        <div class="col-md-3 col-md-offset-1">

            <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="list-group hello ">
                  @foreach($posts as $post)                        
                        <li class="list-group-item post_style">
                         Title: {{ $post->title }}                             
                        </br>
                        @if($post->desc!=null)
                        Description: {{ $post->desc }} 
                        </br>                          
                        @endif
                        @if($post->image !=null)
                        </br>
                        <a href="{{ '/uploads/'.$post->image }}" download><img class="media-right padd" src="{{ '/uploads/'.$post->image }}" width="250px" height="180px"></a>                      
                        @endif
                        @if($post->p_file !=null)
                       <a href="{{'/files/'.$post->p_file}}" download>{{$post->p_file}}</a>
                        </br>
                        @endif
                        <hr>
                        <p>{{ $post->instructor->name }}</p>
                      </li>
                    @endforeach
                </ul>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

