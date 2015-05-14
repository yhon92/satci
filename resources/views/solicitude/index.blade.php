@extends('app')

@section('content')
{{-- <div class="container"> --}}
	{{-- <div class="col-md-6"> --}}
		{{-- <div class="bs-component"> --}}
			<p>
				<a href="{{ route('solicitude.create') }}" class="btn btn-primary">Nueva Solicitud</a>
			</p>
		{{-- </div> --}}
	{{-- </div> --}}
		
	{{-- <div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nº Solicitud</th>
									<th>Recepción</th>
									<th>R. Social</th>
									<th>Nombre</th>
									<th>Asunto</th> --}}
									{{-- <th>Estado</th> --}}
							{{-- 	</tr>
							</thead>
							<tbody>
							@foreach ($requests as $request)
								<tr data-id='{{ $request->id }}'>
									<td>{{ $request->request_number }}</td>
									<td>{{ $request->reception_date }}</td>
									<td>{{ $request->identification_type }}</td>
									<td>{{ $request->applicant->full_name }}</td>
									<td>{{ $request->topic }}</td> --}}
									{{-- <td>{{ $request->status }}</td> --}}
									{{-- <td>
										<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-warning glyphicon glyphicon-edit"></a>
										<a href="#" class="btn btn-xs btn-danger glyphicon glyphicon-remove"></a>
									</td> --}}
			{{-- 					</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
{{-- </div> --}}
@endsection
