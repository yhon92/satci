{{-- @extends('app') --}}

{{-- @section('content') --}}
<div class="container-fluid">
	<div class="bs-docs-section">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading"><strong>Iniciar Sesión</strong></div>
				<div class="panel-body">
					@include('partials.message')
					{!! Form::open(['url' => '/auth/login']) !!}
						<div class="form-group">
							{{-- {!! Form::label('username', 'Usuario') !!} --}}
							{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
						</div>
						<div class="form-group">
							{{-- {!! Form::label('password', 'Contraseña') !!} --}}
							{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Iniciar</button>
							</div>
						</div>
					{!! Form::close() !!}
					{{-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label" for="username">Usuario</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="password">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" id="password" name="password">
							</div>
						</div>

						<!-- <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>
 -->
						{{-- <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Iniciar</button>

								<!-- <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a> -->
							</div>
						</div>
					</form> --}}
				</div>
			</div>
		</div>
	</div>
</div>
{{-- @endsection --}}
