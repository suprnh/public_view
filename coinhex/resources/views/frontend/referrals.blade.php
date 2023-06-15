<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 

<div class="user-content">
	<div class="user-panel">
		<h2 class="user-panel-title">{{ __t('Referrals') }}</h2>
		@include('frontend.section.msg')
		<h5>{{ __t('Invite your friends and family.') }}</h5>

		
		<p>{{ __t('Imagine giving your unique referral link to your crypto-friend, and he or she contributes tokens using your link, the bonus will be sent to your account automatically. The strategy is simple: the more links you send to your collagues, family and friends - the more chances you have to earn tokens!') }}</p>
		<h6>{{ __t('My unique referral link is:') }}</h6>
		<div class="refferal-info">
			<span class="refferal-copy-feedback copy-feedback"></span>
			<em class="fas fa-link"></em>
			<input type="text" class="refferal-address copy-address" value="{{ url('signup?ref=') }}<?php echo get_current_ref_id(); ?>" disabled>
			<a href="#" class="refferal-copy copy-trigger"><em class="ti ti-files"></em></a>
		</div><!-- .refferal-info -->
		<div class="gaps-2x"></div>
		<ul class="share-links">
			<?php 
			$encoded_url = urlencode(url('signup?ref=').''.get_current_ref_id());
			?>
			<li>{{ __t('Share with') }} : </li>
			<li><a href="http://twitter.com/share?url={{ url('signup?ref=') }}<?php echo get_current_ref_id(); ?>" target="_blank"><em class="fab fa-twitter"></em></a></li>
			<li><a href="http://www.facebook.com/share.php?description={{ url('signup?ref=') }}<?php echo get_current_ref_id(); ?>&u={{ url('signup?ref=') }}<?php echo get_current_ref_id(); ?>" target="_blank"><em class="fab fa-facebook-f"></em></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?url=<?php echo $encoded_url; ?>source=<?php echo $encoded_url; ?>" target="_blank"><em class="fab fa-linkedin-in"></em></a></li>
			<li><a href="https://web.whatsapp.com/<?php echo $encoded_url; ?>source=<?php echo $encoded_url; ?>" target="_blank"><em class="fab fa-whatsapp"></em></a></li>
		</ul><!-- .share-links -->
		<div class="gaps-1x"></div>
		<h4>{{ __t('Number of people signed in with your referral') }} :<span style="font-size:18px;"> <?php echo count($referral_all); ?></span></h4>
		<div class="gaps-2x"></div>
		<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>{{ __t('Referral User') }}</th>
							<th>{{ __t('Registered Date') }}</th>
							<th>{{ __t('Total Token') }}</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($referrals) && count($referrals) > 0){ 
						foreach($referrals as $k=>$v)
						{
						?>
						<tr>
							<td><?php echo $v->email; ?></td>
							<td><?php echo date('d/m/Y',strtotime($v->created_date)); ?></td>
							<td><?php echo get_p2p_by_user_id($v->ID); ?> Token</td>
						</tr>
						<?php }
						}else{
						?>
						<tr>
							<td colspan="4">{{ __t('No Referral found !') }}</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if(!empty($referrals) && count($referrals) > 0) { echo $referrals->links(); } ?>
			</div>
		
	</div><!-- .user-panel -->
</div><!-- .user-content -->
    
    
@endsection