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
		Estimado {{ $data['transferencia']->user->name }} su pago por Transferencia Bancaria ha sido @if ($data['transferencia']->status == 1) APROBADO @else DENEGADO @endif ... <br><br>

		<b>Detalles de la Transferencia</b><br>
		<ul>
			<li>Banco: <b>{{ $data['transferencia']->bank }}</b></li>
			<li># de Transacción: <b>{{ $data['transferencia']->transaction_number }}</b></li>
			<li>Monto: <b>{{ $data['transferencia']->amount }}</b></li>
			<li>Fecha: <b>{{ date('d-m-Y', strtotime($data['transferencia']->date)) }}</b></li>
			@if (!is_null($data['transferencia']->course_id))
				<li>Curso: <b>{{ $data['transferencia']->course->title }}</b></li>
			@else
				<li>Evento: <b>{{ $data['transferencia']->event->title }}</b></li>
			@endif
		</ul>
	</div>
</body>
</html>