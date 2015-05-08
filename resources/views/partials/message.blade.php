@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>¡Vaya!</strong> Hubo algunos problemas con su entrada.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif