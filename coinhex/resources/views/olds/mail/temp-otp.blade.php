@extends('mail.structure')
@section('mail_body')

	<tr>
		<td style="padding: 10px 30px;">
				
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">Here is you OTP.</p>
			<p style="font-size: 18px; color: #4d4848; line-height: 30px; margin-bottom: 30px; font-family: Arial, Helvetica, sans-serif">{{ $otp }}.</p>
		</td>
	</tr>
@endsection