@extends('mail.structure')
@section('mail_body')

	<tr>
		<td style="padding: 10px 30px;">
				
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">Hello Admin,</p>
			
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">Contact request from {{  $name }} .</p>
			
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">Detail below: </p>
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">
				Name: {{ $name }}</p>
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">
				Email: {{ $email }}</p>
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">
				Message: {{ $msg }}</p>
					
		</td>
	</tr>
	
@endsection
