<!DOCTYPE html>
<html>
<head>
	<title>Bill</title>
	<style type="text/css">
		table, th, td{
			border: 1px solid black;
			text-align: left;
		}

		.text-centered
		{
			text-align: center;
		}

		.total 
		{
			text-align: right;
		}






	</style>

</head>
<body>

	<h3>LLAJTA MILK S.A.</h3> 

	<p>---------------------------</p>
	<p>{{$qr}}</p>
	<p>---------------------------</p>


	<p>SUBSIDIARY: </p> 
	<p>ADDRESS: {{$sale->description}} </p>
	<p>PHONES: 4200124 Int. 122</p>
	<p>Cochabamba</p><br>

			<p>SALES CHECK</p>
	<p>---------------------------</p>
	<p>NIT: </p>
	<p>BILL NO.</p>
	<p>AUTORIZATION </p>
	<p>---------------------------</p>
	<p>DATE: {{$sale->created_at}} </p>
	<p>NIT/CI: {{$sale->client->ci}}</p>
	<p>SENOR(ES): {{$sale->client->name}} </p>
	<p>---------------------------</p>

	<table>
		<thead>
			<tr>
				<td>Name</td>
				<td class="text-centered">Quantity</td>
				<td class="text-centered">Unit/P</td>
				<td class="text-centered">SubTotal</td>
			</tr>	
		</thead>
		<tbody>
			<?php 
				$count_total = 0; 
			?>
			@foreach($products_sales as $product_sale)

			<tr>
				<td>{{$product_sale->product->name}}</td>
				<td class="text-centered">{{$product_sale->quantity}}</td>
				<td class="text-centered">{{$product_sale->product->prize}}</td>
				<td class="text-centered">{{$product_sale->amount}}</td>	
			</tr>
			<?php 
				$count_total = $count_total + $product_sale->amount;

			?>

			@endforeach


		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" class="">TOTAL Bs: </td>
				<td class="text-centered">{{$count_total}}</td>
			</tr>


		</tfoot>




	</table>

	<p>---------------------------</p>
	<p>CASHIER: {{$sale->user->name}}</p>
</body>
</html>