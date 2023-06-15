<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
               <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">{{ __t('Privecy Policy') }}</h2>
						@include('frontend.section.msg')
                        <div class="user-panel-content">
                            <p><strong>{{ __t('This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. This Privacy Policy for softNio') }}</strong></p>
                            
                            <p>{{ __t('We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from http://demo.themenio.com/ico') }}</p>
                            <h6>{{ __t('Information Collection And Use') }}</h6>
                            <p>{{ __t('Every legitimate project that sources funds through an crowdsale has a website, where they specify what the project is all about, its goals, the amount of money needed, how long the funding campaign will go on for and so forth.') }}</p>
                            <h6>{{ __t('Types of Data Collected') }}</h6>
                            <p>{{ __t('We collect several different types of information for various purposes to provide and improve our Service to you.</p>
                            <h6>{{ __t('Use of Data') }}</h6>
                            <p>{{ __t('Bitcoin, still being the single most dominant cryptocurrency, is accepted pretty much anywhere in the crypto world. However, as Ethereum offers a stable and convenient Blockchain platform for developers to set up their projects.') }}</p>
                            <h6>{{ __t('Transfer Of Data') }}</h6>
                            <p>{{ __t('We may also collect information how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.') }}</p>
                            
                        </div>

                    </div><!-- .user-panel -->
                </div><!-- .user-content -->
           

			
    
    
@endsection