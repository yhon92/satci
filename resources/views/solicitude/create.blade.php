@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				{{-- <div class="panel-heading">Home</div> --}}

				<div class="panel-body">
					<form class="form-horizontal">
					{!! Form::open(['class' => 'form-horizontal','route' => 'solicitude.store', 'method' => 'POST']) !!}
						<fieldset>
							<legend>Solicitud</legend>
							<div class="form-group">
								{!! Form::label('solicitude_number', 'Nº de Solicitud', ['class' => 'col-lg-4 control-label']) !!}
								<div class="col-lg-8">
									{!! Form::text('solicitude_number', null, ['class' => 'form-control', 'placeholder' => 'Número de Solicitud']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('reception_date', 'Fecha de Recepción', ['class' => 'col-lg-4 control-label']) !!}
								<div class="col-lg-8">
									{!! Form::text('reception_date', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Recepción']) !!}
								</div>
							</div>
							<div class="form-group">
							<label class="col-lg-4 control-label">Razon Social</label>
								<div class="col-lg-8">
									<div class="radio">
										<label>
											{!! Form::radio('identification_type', 'Natiral') !!}
											Natural
										</label>
									</div>
									<div class="radio">
										<label>
											{!! Form::radio('identification_type', 'Jurídica') !!}
											Jurídica
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('document_date', 'Fecha de Recepción', ['class' => 'col-lg-4 control-label']) !!}
								<div class="col-lg-8">
									{!! Form::text('document_date', null, ['class' => 'form-control', 'placeholder' => 'Fecha del Documento']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('applicant_date', 'Solicitante', ['class' => 'col-lg-4 control-label']) !!}
								<div class="col-lg-8">
									{!! Form::label('applicant_date', 'Solicitante', ['class' => 'control-label btn-link']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('topic', 'Asunto', ['class' => 'col-lg-4 control-label']) !!}
								<div class="col-lg-8">
									{!! Form::textarea('topic', null, ['class' => 'form-control', 'rows' => '3']) !!}
								</div>
							</div>
{{-- 							<div class="form-group">
								
							<div class="form-group">
								<label for="select" class="col-lg-2 control-label">Selects</label>
								<div class="col-lg-10">
									<select class="form-control" id="select">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<br>
									<select multiple="" class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div> --}}
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="reset" class="btn btn-default">Cancel</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</fieldset>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
