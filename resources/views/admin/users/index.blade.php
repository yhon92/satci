@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>
				<div class="panel-body">
				
					@if (session()->has('message'))
						<p class="alert alert-success">{{ session()->get('message') }}</p>
					@endif

					<p>
						<a class="btn btn-primary" href="{{ route('admin.users.create') }}" role="button">Crear Usuario</a>
					</p>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nº</th>
									<th>Usuario</th>
									<th>Nombres</th>
									<th>Apellidos</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($users as $user)
								<tr data-id='{{ $user->id }}'>
									<td>{{ ++$num }}</td>
									<td>{{ $user->username }}</td>
									<td>{{ $user->first_name }}</td>
									<td>{{ $user->last_name }}</td>
									<td>{{ $user->status }}</td>
									<td>
										<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>
										<a href="#" class="btn btn-xs btn-danger glyphicon glyphicon-remove"></a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{!! Form::open(['route' => ['admin.users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection


@section('scripts')
<script>
	$(document).ready(function () {
		$('.glyphicon-remove').click(function (e) {
			
			e.preventDefault;

			var row  = $(this).parents('tr');
			var id 	 = row.data('id');
			var form = $('#form-delete');
			var url  = form.attr('action').replace(':USER_ID', id);
			var data = form.serialize();
			
			$.post(url, data, function (result) {
				row.fadeOut();
			})
			.fail(function () {
				row.show();
			});
		});
	});
</script>
@stop()
