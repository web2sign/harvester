
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice No.: {{ $invoice }}</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 14px;
				line-height: 20px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td .title {
				font-size: 20px;
				line-height: 45px;
				color: #333;
				font-weight: bold;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ccc;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #ddd;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #ddd;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>

		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<strong style="font-size:24px;text-transform: uppercase;">Invoice</strong><br />
									Invoice No.: {{ $invoice }}<br />
									Invoice Date : {{ Carbon\Carbon::parse( $date )->lastOfMonth()->format('F d, Y')}}<br />
									Total Due : {{ number_format($total_amount, 2, '.', ',') }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<strong>Invoice To</strong><br />
									Leadstreet bvba<br />
									Johan Vantomme<br />
									Juliann Claerhoutstraat 13<br />
									8572 Kaster, Belgium<br />
									VAT: BE0556.843.742
								</td>
								<td>
									<strong>Invoice From</strong><br />
									{!! nl2br($invoice_details) !!}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td colspan="2">

						<table>
							<tr class="heading">
								<td style="text-align: left; width:90px">Date</td>
								<td style="text-align: left; width:150px">Task</td>
								<td style="text-align: left;">Note</td>
								<td style="width:50px">Hours</td>
							</tr>

							@foreach($data as $d)
							<tr class="item">
								<td style="text-align: left;">{{ $d['spent_date'] }}</td>
								<td style="text-align: left;">{{ $d['task']['name'] }}</td>
								<td style="text-align: left;">{{ $d['notes'] }}</td>
								<td style="text-align: right;">{{ $d['hours'] }}</td>
							</tr>
							@endforeach

							<tr>
								<td style="padding-bottom:40px;" colspan="4"></td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td style="text-align: right; padding: 0;" colspan="2">
									
									<table>
										<tr>
											<td style="width:200px"></td>
											<td style="text-align: left; border-bottom:1px solid #ddd">Total Hours</td>
											<td style="text-align: right; border-bottom:1px solid #ddd" width="60">{{ $total_hours }}</td>
										</tr>
										<tr>
											<td style="width:200px"></td>
											<td style="text-align: left; border-bottom:1px solid #ddd">Rate (EUR)</td>
											<td style="text-align: right; border-bottom:1px solid #ddd" width="60">{{ $rate }}</td>
										</tr>
										<tr>
											<td style="width:200px"></td>
											<td style="text-align: left; border-top:2px solid #ccc; font-weight:bold;">Total Due</td>
											<td style="text-align: right; border-top:2px solid #ccc; font-weight:bold;" width="60">
												{{ number_format($total_amount , 2, '.', ',') }}
											</td>
										</tr>
									</table>


								</td>
							</tr>
						</table>

					</td>
				</tr>

				<tr>
					<tr>
						<td style="padding-bottom:40px;" colspan="2"></td>
					</tr>
				</tr>

				<tr class="details">
					<td colspan="2">
						<strong>Payment Method</strong><br />
						{{ $payment_method }}
					</td>
				</tr>

				<tr class="details">
					<td colspan="2">
						<strong>Account Details</strong><br />
						{!! $account_details !!}
					</td>
				</tr>

				<tr class="details">
					<td colspan="2">
						<strong>Recipient's Address</strong><br />
						{!! $address !!}
					</td>
				</tr>


			</table>
		</div>
	</body>
</html>
