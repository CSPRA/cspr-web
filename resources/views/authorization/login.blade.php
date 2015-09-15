<h1>Welcome!</h1>

<ul>
    @foreach($errors as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(array('route' => 'login', 'class' => 'form')) !!}

<div class="form-group">
    {!! Form::label('Your Name') !!}
    {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Your name')) !!}
</div>

<div class="form-group">
    {!! Form::label('Your E-mail Address') !!}
    {!! Form::text('email', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Your e-mail address')) !!}
</div>

<div class="form-group">
	{!! Form::label('Your Password') !!}
	{!! Form::password('secret',
	 				array('class' => 'form-control')) !!}
	
</div>

<div class="form-group">
    {!! Form::submit('Login', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}