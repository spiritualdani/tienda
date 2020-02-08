<!DOCTYPE html>
<html>
<head>
	<title>Bill</title>
	<style>
		
		table, th, td {
			border: 1px solid black;
			text-align: left;
		}

	</style>

</head>
<body>
	<h1>MILK</h1>
	<p><b>cashier: </b> {{$sale->user->name}} </p>
	<p><b>client: </b> {{$sale->client->name}} </p>
	<p><b>ci: </b> {{$sale->client->ci}} </p>

	<b>Products: </b><br>	

		<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>Quantity</td>
					<td>Unit/P </td>
					<td>Subtotal</td>


				</tr>	
				
			</thead>

			<tbody>
				<?php 
					$count_total = 0;
				 ?>
				
				@foreach($products_sales as $product_sale)
				<tr>
            		<td>{{ $product_sale->product->name }}</td>
            		<td>{{ $product_sale->quantity }}</td>
            		<td>{{ $product_sale->product->prize }}</td>
            		<td>{{ $product_sale->amount }}</td>

            	</tr> 

            	<?php 
            		$count_total = $count_total + $product_sale->amount;
            	?>
        		@endforeach  
        		     
			</tbody>


            <tfoot>

                        <tr >
                            <td colspan="3" class="text-left; font-weight-bold">TOTAL: </td>
                            <!--<td>CI</td>-->  
                            <td  class="text-right font-weight-bold" >{{$count_total}}</td>
                           
                        </tr>

            </tfoot>

		</table>


		<p><b>Date: </b> {{$sale->created_at}} </p>

 	
		
     
           

              

</body>
</html>