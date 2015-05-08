{{-- <div class="form-group"> --}}
	{{-- {!! Form::label('username', 'Usuario') !!} --}}
{{-- 	{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
</div> --}}
<div class="form-group">
	{{-- {!! Form::label('first_name', 'Nombres') !!} --}}
	{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Nombres', 'required' => '']) !!}
</div>
<div class="form-group">
	{{-- {!! Form::label('last_name', 'Apellidos') !!} --}}
	{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Apellidos', 'required' => '']) !!}
</div>
{{-- <div class="form-group"> --}}
	{{-- {!! Form::label('password', 'Contraseña') !!} --}}
{{--	{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
</div>
<div class="form-group"> --}}
	{{-- {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!} --}}
{{-- 	{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Contraseña']) !!}
</div> --}}
<div class="form-group">
	<label>
		{!! Form::checkbox('active') !!}								
		Activo
	</label>
	{{-- {!! Form::label('active', 'Activo') !!} --}}
</div>