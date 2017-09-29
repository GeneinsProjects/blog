@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">About Us</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                            We are 4th year BSIT students at Holy Name University</br>
                            Enjoying and Exploring the wonders of the cloud!!!</br></br>
                            <img src="{{asset('cloud.png')}}" style="width: 400px;">
                        </br></br>
                        </center>
                            <table border="1" align="center" >
                                <tr>
                                    <td><img src="{{asset('genpic.jpg')}}" style="width: 150px;"></td>
                                    <td>Genein Merced L. Lumayag</td>
                                </tr>
                                <tr>
                                    <td><img src="{{asset('fredpic.jpg')}}" style="width: 150px;"></td>
                                    <td>Frederick D. Bautista</td>
                                </tr>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection