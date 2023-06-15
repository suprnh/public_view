<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
                <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">{{ __t('How to Buy token') }}</h2>
						@include('frontend.section.msg')
                        <div class="user-panel-content">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/nO8RRutn8uo?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <h6>{{ __t('Step 1') }} : {{ __t('Register for an crowdsale through the project’s website') }} </h6>
                            <p>{{ __t('Every legitimate project that sources funds through an crowdsale has a website, where they specify what the project is all about, its goals, the amount of money needed, how long the funding campaign will go on for and so forth.') }}</p>
                            <h6>{{ __t('Step 2') }} : {{ __t('Get Bitcoin, Etheriam or any kind of Cryptocurrency') }} </h6>
                            <p>{{ __t('Bitcoin, still being the single most dominant cryptocurrency, is accepted pretty much anywhere in the crypto world. However, as Ethereum offers a stable and convenient Blockchain platform for developers to set up their projects.') }}</p>

                            <h6>{{ __t('Step 3') }} : {{ __t('Buy tokens from active crowdsale') }}</h6>
                            <p>{{ __t('Bitcoin, still being the single most dominant cryptocurrency, is accepted pretty much anywhere in the crypto world. However, as Ethereum offers a stable and convenient Blockchain platform for developers to set up their projects.') }}</p>
                        </div>

                    </div><!-- .user-panel -->
                </div><!-- .user-content -->

@endsection



