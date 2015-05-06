@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>
				<div class="panel-body">
					<p>
						<a class="btn btn-primary" href="{{ route('admin.users.create') }}" role="button">Crear Usuario</a>
					</p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Nº</th>
								<th>Username</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Status</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ ++$num }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->first_name }}</td>
								<td>{{ $user->last_name }}</td>
								<td>{{ $user->status }}</td>
								<td>
									<a href="">Edit</a>
									<a href="">Del</a>
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
@endsection
