@extends('layouts.app')

@section('content')
<a href="/manage" class="btn btn-default">Go Back</a>
   
    <br><br> 
    
   <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$user->name}}</h3>
              <small>Registered on {{$user->created_at}}</small>
              
                <div class="radio" style="float:right">
                <label style="color:green"><input type="radio" name="optradio">Active</label>
                
                    <label style="color:orangered"><input type="radio" name="optradio">Inactive</label>
                </div>
              
              
            </div>
            <div class="panel-body">
              <div class="row">                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Department:</td>
                        <td>Programming</td>
                      </tr>
                      <tr>
                        <td>Designation:</td>
                        <td>Team support</td>
                      </tr>                    
                   
                         <tr>
                             <tr>
                        <td>Gender</td>
                        <td>Male</td>
                      </tr>
                        <tr>
                        <td>Physical Address</td>
                        <td>Paulshof, Sandton</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:info@support.com">info@support.com</a></td>
                      </tr>
                        <td>Contact Number(s)</td>
                        <td>123-456-7890(Landline)<br><br>555-4567-890(Mobile)
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  
                </div>
              </div>
@endsection