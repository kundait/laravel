@if(Auth::guard('web')->check())
<p class='text-success'>You are logged in as a USER</p>
@else
<p class='text-danger'>You are not logged in as a USER</p>
@endif

@if(Auth::guard('admin')->check())
<p class='text-success'>You are logged in as a ADMIN</p>
@else
<p class='text-danger'>You are not logged in as a ADMIN</p>
@endif


