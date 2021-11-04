<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Academia Solar Providencia</title>
</head>
<body>
	<div style="text-align: center;">
		<img src="https://academia.solarprovidencia.com/logos/logo.png" alt="">
	</div>
	<div>
		Estimado Damián Chávez tienes un nuevo reporte de pago por Transferencia Bancaria en tu Academia... <br><br>

		<b>Datos de la Transferencia</b><br>
		<ul>
			<li>Usuario: <b>{{ $data['comprador']->name }}</b></li>
			<li>Correo Electrónico: <b>{{ $data['comprador']->email }}</b></li>
			<li>Teléfono: <b>{{ $data['comprador']->phone }}</b></li>
			<li>Banco: <b>{{ $data['transferencia']->bank }}</b></li>
			@if (!is_null($data['transferencia']->course_id))
				<li>Curso: <b>{{ $data['transferencia']->course->title }}</b></li>
			@else
				<li>Evento: <b>{{ $data['transferencia']->event->title }}</b></li>
			@endif
			<li># de Transacción: <b>{{ $data['transferencia']->transaction_number }}</b></li>
			<li>Monto: <b>{{ $data['transferencia']->amount }}</b></li>
			<li>Fecha: <b>{{ date('d-m-Y', strtotime($data['transferencia']->date)) }}</b></li>
		</ul>
		

	</div>
</body>
</html>