@extends('app')

@section('content')
<div class="col-md-6">
	<div class="panel panel-default">
		{{-- <div class="panel-heading">Home</div> --}}
		<div class="panel-body">
			{!! Form::open(['class' => 'form-horizontal','route' => 'solicitude.store', 'method' => 'POST']) !!}
			<fieldset>
				<legend>Solicitud</legend>
				<div class="form-group">
					{!! Form::label('solicitude_number', 'Nº de Solicitud', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						{!! Form::text('solicitude_number', null, ['class' => 'form-control', 'placeholder' => 'Número de Solicitud']) !!}
					</div>
				</div>
				<div class="form-group" ng-controller="DatepickerDemoCtrl">
					{!! Form::label('reception_date', 'Fecha de Recepción', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						<p class="input-group">
							{!! Form::text('reception_date', null, ['class' => 'form-control', 'placeholder' => 'Fecha de Recepción', 'datepicker-popup' => 'dd-MM-yyyy', 'ng-model' => 'dt', 'is-open' => 'opened', 'min-date' => "minDate", 'max-date' => "maxDate", 'picker-options' => 'dateOptions', 'date-disabled' => 'disabled(date, mode)', 'ng-required' => 'true', 'close-text' => 'Close']) !!}
							<span class="input-group-btn">
								<button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
							</span>
						</p>
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
					{!! Form::label('identification', 'Cédula / RIF', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						{!! Form::label('identification', '@{{identification}}', ['class' => 'form-label']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('applicant_date', 'Solicitante', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						{!! Form::label('applicant_date', '@{{fullName}}', ['class' => 'form-label']) !!}
					</div>
				</div>
				<div class="form-group" ng-controller="DatepickerDemoCtrl">
					{!! Form::label('document_date', 'Fecha del Documento', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						<p class="input-group">
							{!! Form::text('document_date', null, ['class' => 'form-control', 'placeholder' => 'Fecha del Documento', 'datepicker-popup' => 'dd-MM-yyyy', 'ng-model' => 'dt', 'is-open' => 'opened', 'min-date' => "minDate", 'max-date' => "maxDate", 'picker-options' => 'dateOptions', /*'date-disabled' => 'disabled(date, mode)',*/ 'ng-required' => 'true', 'close-text' => 'Close']) !!}
							<span class="input-group-btn">
								<button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
							</span>
						</p>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('topic', 'Asunto', ['class' => 'col-lg-4 control-label']) !!}
					<div class="col-lg-8">
						{!! Form::textarea('topic', null, ['class' => 'form-control', 'placeholder' => 'Asunto', 'rows' => '3']) !!}
					</div>
				</div>
				<div class="col-md-6 col-md-offset-3">
					<button type="reset" class="btn btn-default">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				{{-- </div> --}}
			</fieldset>
			{!! Form::close() !!}
		</div>
	</div>
</div>



	@endsection
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
							{{-- <div class="form-group"> --}}
