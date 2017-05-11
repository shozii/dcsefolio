@extends('layouts.app')
@section('header')
<!-- Custom CSS -->
    <link href="http://localhost:8000/css/simple-sidebar.css" rel="stylesheet"></link>
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
 .my-btn{
    background-color:#003663;
    color: white;
 }
p{
    color:#003663;
    font-style: italic;
}
</style>
@endsection


@section('navbar')
<li>
<a href="/about/{{$id}}">About {{$c_c->name}}</a>
</li>
@endsection

@section('content')
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">  

                <ul class="sidebar-nav">
                    
                <!--////////////////////////////Course List////////////////////////////////////////-->
                @foreach($courses as $course)
                @if( $course->semester == Auth::user()->semester)             
                <li class="sidebar-brand">
                    <a href="{{$course->path_user()}}">
                        {{ $course->name }} 
                    </a>

                </li>
                @endif
                @endforeach  
<!--////////////////////////////Course List Ends////////////////////////////////////-->         
            </ul>
    </div>
</div>
            <!-- end sidebar-wrapper -->

    <div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="list-group hello">
                    @foreach($cposts as $cpost)    
                        @if($cpost->course_id==$id)  
                                          
                        <li class="list-group-item post_style">

                         Title: {{ $cpost->title }}                             
                        </br>
                        @if($cpost->desc!=null)
                        Description: {{ $cpost->desc }}                             
                        </br>
                        @endif

                        @if($cpost->image !=null)
                        <a href="{{ '/courseuploads/'.$cpost->image }}" download><img class="pull-right" src="{{ '/courseuploads/'.$cpost->image }}" width="80px" height="60px"></a>                      
                        @endif
                        </br>

                        @if($cpost->file !=null)
                       <a href="{{'/courseuploads/'.$cpost->file}}" download>{{$cpost->file}}</a>
                        </br>
                        @endif

                        <hr>
                        <p>{{ $cpost->course->instructor->name }}</p>

                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

@endsection