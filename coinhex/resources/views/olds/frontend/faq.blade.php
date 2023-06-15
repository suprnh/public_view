<?php set_front_language(); ?>
@extends('frontend.layouts.dashboard-structure')
@section('mid_area') 
	
                            
                <div class="user-content">
                    <div class="user-panel">
                        <h2 class="user-panel-title">{{ __t('Frequently Asked Questions') }}</h2>
						@include('frontend.section.msg')
						                        <div id="faqList">
                            <h4 class="color-dark">{{ __t('General') }}</h4>
                            <div class="accordion-simple" id="faqList-1">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-1">{{ __t('What is ACW Global Network?') }}  </h6>
                                    <div id="collapse-1-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('A Decentralized ACW network to enable users to seek help during their tough situation like joblessness. Valid proof and honest appeal will be determined by distributed consensus among other ACW of the network. "Help others to get help" is the main motto which is powered by ACW Blockchain Technology. To know more details kindly have a look on our Whitepaper.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-2">{{ __t('What is the aim of ACW Network?') }}</h6>
                                    <div id="collapse-1-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Distress and tough situation is part of life when people looses his/her basic aminities. Being a part of ACW Global network will help to get rid of such kind of emergency situation') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-3">{{ __t('How do I benefit from ACW Global Network?') }}</h6>
                                    <div id="collapse-1-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Buying our token means you are joining to secure future in tough situations of your life. We will continously be working on new ideas and new technologies to better our partnership with you. There is no limit to where we can take ACW with the work we are willing to put in. Being involved in the early stages of this platform puts you in the best position for when we are fully operational.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-4">{{ __t('How can we track progress of ACW Global Development?') }}</h6>
                                    <div id="collapse-1-4" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Follow us on any of the links provided on this page to see what we are up to, and how things are going. We will provide weekly updates on all available forms of social media.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                            </div><!-- .accordion -->

                            <h4 class="color-dark">{{ __t('ICO') }}</h4>
                            <div class="accordion-simple" id="faqList-2">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-1">{{ __t('How can I participate in Token Sale?') }}</h6>
                                    <div id="collapse-2-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('You can join the Crowdsale by creating a new account on our website and participate by investing in one of our company ACW Network address via one of our accepted ACW Global Networkcurrencies.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-2">{{ __t('What ACW Global Networkcurrencies can we use to purchase High?') }}</h6>
                                    <div id="collapse-2-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('You can use BTC, ETH or LTC ACW Global Networkcurrency.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-3">{{ __t('How many tokens are available for ICO?') }}</h6>
                                    <div id="collapse-2-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('40% of total supply is allocated for ICO sell. Total supply of tokens = 100 million. ICO sell allocation = 40 million.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                             
                            </div><!-- .accordion -->

                            <h4 class="color-dark">{{ __t('Tokens') }}</h4>
                            <div class="accordion-simple" id="faqList-3">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-1">{{ __t('What is ICO Token?') }}</h6>
                                    <div id="collapse-3-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('An Initial Coin Offering, also commonly referred to as an ICO, is a fund raising mechanism in which new projects sell their underlying ACW Global Network tokens in exchange for other popular ACW Global Networkcurrencies.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-2">{{ __t('Are there any restrictions?') }}</h6>
                                    <div id="collapse-3-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Sales are not allowed to places where there are regulations in place to prevent participation.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-3">{{ __t('What will happens once the hard cap is reached?') }}</h6>
                                    <div id="collapse-3-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('ICO will close once we successfully achieve our target hard cap. Please follow our Token and Fund distribution section to have an idea of ACW Global financial model.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                            </div><!-- .accordion -->
                        </div><!-- #faqList -->
                    
                            <h4 class="color-dark">{{ __t('General') }}</h4>
                            <div class="accordion-simple" id="faqList-1">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-1">{{ __t('What is ACW Global Network?') }}  </h6>
                                    <div id="collapse-1-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('A Decentralized peer to peer network to enable users to seek help during their tough situation like joblessness. Valid proof and honest appeal will be determined by distributed consensus among other peers of the network. "Help others to get help" is the main motto which is powered by ACW Blockchain Technology. To know more details kindly have a look on our Whitepaper.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-2">{{ __t('What is the aim of ACW Global Network?') }}</h6>
                                    <div id="collapse-1-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Distress and tough situation is part of life when people looses his/her basic aminities. Being a part of ACW Global network will help to get rid of such kind of emergency situation') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-3">{{ __t('How do I benefit from ACW Global Network?') }}</h6>
                                    <div id="collapse-1-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Buying our token means you are joining to secure future in tough situations of your life. We will continously be working on new ideas and new technologies to better our partnership with you. There is no limit to where we can take ACW with the work we are willing to put in. Being involved in the early stages of this platform puts you in the best position for when we are fully operational.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-1-4">{{ __t('How can we track progress of ACW Global Development?') }}</h6>
                                    <div id="collapse-1-4" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Follow us on any of the links provided on this page to see what we are up to, and how things are going. We will provide weekly updates on all available forms of social media.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                            </div><!-- .accordion -->

                            <h4 class="color-dark">{{ __t('Crowdsale') }}</h4>
                            <div class="accordion-simple" id="faqList-2">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-1">{{ __t('How can I participate in Token Sale?') }}</h6>
                                    <div id="collapse-2-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('You can join the crowdsale by creating a new account on our website and participate by investing in one of our company Peer 2 Peer Global Network address via one of our accepted Peer 2 Peer Global Networkcurrencies.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-2">{{ __t('What Peer 2 Peer Global Networkcurrencies can we use to purchase ACW?') }}</h6>
                                    <div id="collapse-2-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('You can use BTC, ETH or LTC Peer 2 Peer Global Networkcurrency.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-2-3">{{ __t('How many tokens are available for crowdsale?') }}</h6>
                                    <div id="collapse-2-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('40% of total supply is allocated for crowdsale sell. Total supply of tokens = 100 million. crowdsale sell allocation = 40 million.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                             
                            </div><!-- .accordion -->

                            <h4 class="color-dark">{{ __t('Tokens') }}</h4>
                            <div class="accordion-simple" id="faqList-3">
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-1">{{ __t('What is crowdsale Token?') }}</h6>
                                    <div id="collapse-3-1" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('An Initial Coin Offering, also commonly referred to as an crowdsale, is a fund raising mechanism in which new projects sell their underlying Peer 2 Peer Global Network tokens in exchange for other popular Peer 2 Peer Global Networkcurrencies.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-2">{{ __t('Are there any restrictions?') }}</h6>
                                    <div id="collapse-3-2" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Sales are not allowed to places where there are regulations in place to prevent participation.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                                <div class="accordion-item">
                                    <h6 class="accordion-heading collapsed" data-toggle="collapse" data-target="#collapse-3-3">{{ __t('What will happens once the hard cap is reached?') }}</h6>
                                    <div id="collapse-3-3" class="collapse" data-parent="#faqList">
                                        <div class="accordion-content">
                                            <p>{{ __t('Crowdsale will close once we successfully achieve our target hard cap. Please follow our Token and Fund distribution section to have an idea of ACW Global financial model.') }}</p>
                                        </div>
                                    </div>
                                </div><!-- .accordion-item -->
                            </div><!-- .accordion -->
                        </div><!-- #faqList -->
                    
					</div><!-- .user-panel -->
                </div><!-- .user-content -->
           
    
@endsection