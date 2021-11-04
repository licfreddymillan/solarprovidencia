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
		Estimado {{ $data['comprador']->name }} su pago por Paypal ha sido EXITOSO... <br><br>

		<b>Detalles del Pago</b><br>
		<ul>
			<li># de Transacción: <b>{{ $data['compra']->payment_id }}</b></li>
			<li>Monto: <b>{{ $data['compra']->amount }}</b></li>
			<li>Fecha: <b>{{ date('d-m-Y', strtotime($data['compra']->date)) }}</b></li>
			@if (!is_null($data['compra']->course_id))
				<li>Curso: <b>{{ $data['compra']->course->title }}</b></li>
			@else
				<li>Evento: <b>{{ $data['compra']->event->title }}</b></li>
			@endif
		</ul>
	</div>
</body>
</html>