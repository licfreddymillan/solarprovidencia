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
		Estimado Damián Chávez tienes un nuevo pago por Paypal en tu Academia... <br><br>

		<b>Datos del Pago</b><br>
		<ul>
			<li>Usuario: <b>{{ $data['comprador']->name }}</b></li>
			<li>Correo Electrónico: <b>{{ $data['comprador']->email }}</b></li>
			<li>Teléfono: <b>{{ $data['comprador']->phone }}</b></li>
			@if (!is_null($data['compra']->course_id))
				<li>Curso: <b>{{ $data['compra']->course->title }}</b></li>
			@else
				<li>Evento: <b>{{ $data['compra']->event->title }}</b></li>
			@endif
			<li># de Transacción: <b>{{ $data['compra']->payment_id }}</b></li>
			<li>Monto: <b>{{ $data['compra']->amount }}</b></li>
			<li>Fecha: <b>{{ date('d-m-Y', strtotime($data['compra']->date)) }}</b></li>
		</ul>
	</div>
</body>
</html>