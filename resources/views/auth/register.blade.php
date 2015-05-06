@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Crear Usuario</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					{{-- {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'route' => 'admin.users.store', 'method' => 'POST']) !!} --}}
					{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}
						<div class="form-group">
							{{-- {!! Form::label('username', 'Usuario') !!} --}}
							{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
						</div>
						<div class="form-group">
							{{-- {!! Form::label('first_name', 'Nombres') !!} --}}
							{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Nombres']) !!}
						</div>
						<div class="form-group">
							{{-- {!! Form::label('last_name', 'Apellidos') !!} --}}
							{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Apellidos']) !!}
						</div>
						<div class="form-group">
							{{-- {!! Form::label('password', 'Contraseña') !!} --}}
							{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
						</div>
						<div class="form-group">
							{{-- {!! Form::label('password_confirmation', 'Confirmar Contraseña') !!} --}}
							{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Contraseña']) !!}
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
							</div>
						</div>

					{!! Form::close() !!}
					{{-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label class="col-md-5 control-label" for="username">Usuario</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-5 control-label" for="first_name">Nombres</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-5 control-label" for="last_name">Apellidos</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-5 control-label" for="password">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-5 control-label" for="password_confirmation">Confirma Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
							</div>
						</div>
					</form> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
