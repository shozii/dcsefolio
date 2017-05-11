@extends('layouts.app')
@section('header')
    <style>

    p{
        color: #003663;
    }
    .in{
        display: inline;
    }
    a{
        color: #003663;
    }
   
    .padd{
        margin-top: 60px;
    }

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
</style>
    <script>
    var c_semester="{{ $user->semester }}";
    $(document).ready(function(){
            $("#semester").val(c_semester);
            $("#donebtn").hide();

            $('#editbtn').click(function(){
                $('#semester').prop('disabled',false);
                $("#semester").val('');
                $('#donebtn').show();
                $('#editbtn').hide();
            });

            $('#donebtn').click(function(){
               $('#donebtn').hide();
               $('#editbtn').show(); 
            });

    });


    </script>
@endsection
@section('content')
<div class="container">
	<div class="row padd">
	<div class="col-md-6 col-md-offset-3 post-style">
        <br>
        <p>Name:</p>
		<input id="name" type="text"  name="name" value="{{ $user->name }}" required autofocus disabled>
         </br>
         <hr>
     </br>
        <!--Edit Form Started-->
        <form method="POST" action="/edit/{{$user->id}}" id="form1">
            {{ method_field('PATCH') }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <p>Semester</p>
        <select class="in" id="semester" name="semester" required disabled>
                <option value="1st">First</option>
             	<option value="2nd">Second</option>
                <option value="3rd">Third</option>
                <option value="4th">Fourth</option>
                <option value="5th">Fifth</option>
                <option value="6th">Sixth</option>h
                <option value="7th">Seventh</option>
                <option value="8th">Eigth</option>
       </select>
        <a id="editbtn" class="in btn btn-warning">Edit</a>
        <input id="donebtn" type="submit" class="in btn btn-success" value="Done"></input>
       <hr>
   </form>
   <!--Edit Form Ended-->
       <p>Registration number</p>
        <input id="regno" type="text" value="{{ $user->regno }}" name="regno" required disabled="disabled"> 
        <br>
        <hr>
	   </div>
    </div>
</div>
@endsection