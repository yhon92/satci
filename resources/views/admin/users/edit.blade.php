 @extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Editar Usuario: <strong>{{ $user->username }}</strong></div>
				<div class="panel-body">
					@include('partials.message')
					{!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
						@include('admin.users.partials.fields')
						<div class="form-group">
							<label>
								{!! Form::checkbox('active') !!}								
								Activo
							</label>
							{{-- {!! Form::label('active', 'Activo') !!} --}}
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Guardar
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
