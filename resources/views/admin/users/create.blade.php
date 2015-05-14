@extends('app')

@section('content')
{{-- <div class="container-fluid"> --}}
	{{-- <div class="row"> --}}
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Crear Usuario</div>
				<div class="panel-body">
					@include('partials.message')
					{{-- {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'route' => 'admin.users.store', 'method' => 'POST']) !!} --}}
					{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}
						@include('admin.users.partials.create-fields')
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	{{-- </div> --}}
{{-- </div> --}}
@endsection
