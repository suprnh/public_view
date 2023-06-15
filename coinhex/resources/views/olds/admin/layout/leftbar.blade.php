@extends('admin.layout.dashboardpanel')
@section('leftbar')
    <?php
    $admin_language = get_admin_language();
    ?>
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">{{ _tr('Toggle navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    <!--  <a class="navbar-brand" href="{{ route('admin-dashboard') }}">{{ _tr(' Admin Panel') }}</a> -->
        <a class="logo" href="{{ route('admin-dashboard') }}"><h1 class="logo-image"> Admin Panel</h1></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right hidden-xs">
        <?php /*
			<li>
			<?php 
				$languages = get_langs();
			?>
			<select class="selectpicker form-control switch_lang" id="choose_lang">
				<?php 
					if(isset($languages) && count($languages) >0 ){
						foreach($languages as $lang){
						$label = _tr("$lang->language($lang->language_code)");
					?>
					<option value="<?php echo $lang->language_code; ?>" <?php if($admin_language==$lang->language_code){ ?> selected="selected" <?php } ?>><?php echo $label; ?></option>
				<?php }
					}
				?>
			</select>
			</li>
			*/ ?>
        <li class="view_site ">
            <a href="{{ route('high') }}" target="_blank">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ _tr('View Site') }}</a>
        </li>


        <li class="admin-welcome"> <i class="fa fa-user" aria-hidden="true"></i>{{ _tr('Welcome Admin') }}</li>
        <li class="dropdown logout">
            <a href="{{ route('admin-logout') }}">
                <i class="fa fa-sign-out fa-fw"></i> {{ _tr('Logout') }}
            </a>

            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php /*
					<li class="{{ Request::is('iamadmin/dashboard/all-language/*') || Request::is('iamadmin/dashboard/all-language') ||  Request::is('iamadmin/dashboard/add-language/*') || Request::is('iamadmin/dashboard/add-language') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-language fa-fw"></i>{{ _tr('Languages') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/all-language/*') || Request::is('iamadmin/dashboard/all-language') ||  Request::is('iamadmin/dashboard/add-language/*') || Request::is('iamadmin/dashboard/add-language') ? 'active' : '' }}">
							<a href="{{ route('all-language') }}">{{ _tr('All Languages') }}</a>
						</li>
						<li class="{{ Request::is('iamadmin/dashboard/all-translation/*') || Request::is('iamadmin/dashboard/all-translation') ? 'active' : '' }}">
							<a href="{{ route('all-translation') }}">{{ _tr('All Translation') }}</a>
						</li>
						<li class="{{ Request::is('iamadmin/dashboard/add-translation/*') || Request::is('iamadmin/dashboard/add-translation') ? 'active' : '' }}">
							<a href="{{ route('add-translation') }}">{{ _tr('Add Translation') }}</a>
						</li>
                     
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
					*/ ?>
                <li class="visible-xs"><span class="welcome"> <i class="fa fa-user fa-fw" aria-hidden="true"></i> {{ _tr('Welcome Admin') }}</span></li>
                <li class="visible-xs">
                    <a href="{{ route('high') }}">
                        <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                        {{ _tr('View Site') }}</a>
                </li>
                <li class="dropdown logout visible-xs">
                    <a href="{{ route('admin-logout') }}">
                        <i class="fa fa-sign-out fa-fw"></i> {{ _tr('Logout') }}
                    </a>

                    <!-- /.dropdown-user -->
                </li>
               <!--  <li>
                    <a href="#"><i class="fa fa-check-square fa-fw"></i>{{ _tr('AML/KYC Applications') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-kyc-applications/*') || Request::is('iamadmin/dashboard/all-kyc-applications') ? 'active' : '' }}">
                            <a href="{{ route('all-kyc-applications') }}">{{ _tr('All AML/KYC Applications') }}</a>
                        </li>

                        <li class="{{ Request::is('iamadmin/dashboard/add-kyc-application/*') || Request::is('iamadmin/dashboard/add-kyc-application') ? 'active' : '' }}">
                            <a href="{{ route('add-kyc-application') }}">{{ _tr('Add AML/KYC Application') }}</a>
                        </li>
                    </ul>
                
                </li> -->

                <li>
                    <a href="#"><i class="fa fa-btc fa-fw"></i> {{ _tr('Contributions') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-contributions/*') || Request::is('iamadmin/dashboard/all-contributions') ? 'active' : '' }}">
                            <a href="{{ route('all-contributions') }}">{{ _tr('All Contributions') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-contribution/*') || Request::is('iamadmin/dashboard/add-contribution') ? 'active' : '' }}">
                            <a href="{{ route('add-contribution') }}">{{ _tr('Add Contribution') }}</a>
                        </li>

                    </ul>
                </li>
				
				
                <li  class="{{ Request::is('iamadmin/dashboard/edit-user/*') ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-user fa-fw"></i>{{ _tr('Users') }} <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/users/*') || Request::is('iamadmin/dashboard/users') ? 'active' : '' }}">
                            <a href="{{ route('all-edcs') }}">{{ _tr('All Users') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-user') || Request::is('iamadmin/dashboard/edit-user/*') ? 'active' : '' }}">
                            <a href="{{ route('add-edc') }}">{{ _tr('Add User') }}</a>
                        </li>
                    </ul>
                </li>


                

                <?php /*<li>
                    <a href="#"><i class="fa fa-file-word-o fa-fw"></i>{{ _tr('Whitepapers') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-whitepaper/*') || Request::is('iamadmin/dashboard/all-whitepaper') ? 'active' : '' }}">
                            <a href="{{ route('all-whitepaper') }}">{{ _tr('All Whitepapers') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-whitepaper/*') || Request::is('iamadmin/dashboard/add-whitepaper') ? 'active' : '' }}">
                            <a href="{{ route('add-whitepaper') }}">{{ _tr('Add Whitepaper') }}</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li> */ ?>

                


                <!-- <li>
                    <a href="#"><i class="fa fa-star-half-o fa-fw"></i>ICO Listing<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-ico-listing/*') || Request::is('iamadmin/dashboard/all-ico-listing') ? 'active' : '' }}">
                            <a href="{{ route('all-ico-listing') }}">All ICO</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-ico-listing/*') || Request::is('iamadmin/dashboard/add-ico-listing') ? 'active' : '' }}">
                            <a href="{{ route('add-ico-listing') }}">Add ICO</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-star-half-o fa-fw"></i>Airdrop Listing<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-airdrop-listing/*') || Request::is('iamadmin/dashboard/all-airdrop-listing') ? 'active' : '' }}">
                            <a href="{{ route('all-airdrop-listing') }}">All Airdrop</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-airdrop-listing/*') || Request::is('iamadmin/dashboard/add-airdrop-listing') ? 'active' : '' }}">
                            <a href="{{ route('add-airdrop-listing') }}">Add Airdrop</a>
                        </li>
                    </ul>
                </li> -->

                <li>
                    <a href="#"><i class="fa fa-road fa-fw"></i>{{ _tr('Roadmaps') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-roadmap/*') || Request::is('iamadmin/dashboard/all-roadmap') ? 'active' : '' }}">
                            <a href="{{ route('all-roadmap') }}">{{ _tr('All Roadmaps') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-roadmap/*') || Request::is('iamadmin/dashboard/add-roadmap') ? 'active' : '' }}">
                            <a href="{{ route('add-roadmap') }}">{{ _tr('Add Roadmap') }}</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-life-ring fa-fw"></i>{{ _tr('Token Information') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/general-token-info/*') || Request::is('iamadmin/dashboard/general-token-info') ? 'active' : '' }}">
                            <a href="{{ route('general-token-info') }}">{{ _tr('General Info') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/platform-distribution/*') || Request::is('iamadmin/dashboard/platform-distribution') ? 'active' : '' }}">
                            <a href="{{ route('platform-distribution') }}">{{ _tr('Platform & Distribution') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/ico-phase/*') || Request::is('iamadmin/dashboard/ico-phase') ? 'active' : '' }}">
                            <a href="{{ route('ico-phase') }}">{{ _tr('ICO Phase') }}</a>
                        </li>
                    <!--li class="{{ Request::is('iamadmin/dashboard/add-token/*') || Request::is('iamadmin/dashboard/add-token') ? 'active' : '' }}">
                                <a href="{{ route('add-token') }}">{{ _tr('Add Info') }}</a>
                            </li-->

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
               

                <?php /*
					<li>
                        <a href="#"><i class="fa fa-gift fa-fw"></i>{{ _tr('Bonus Master') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li class="{{ Request::is('iamadmin/dashboard/all-bonus/*') || Request::is('iamadmin/dashboard/all-bonus') ? 'active' : '' }}">
                                <a href="{{ route('all-bonus') }}">{{ _tr('All Bonus') }}</a>
                            </li>
                            <li class="{{ Request::is('iamadmin/dashboard/add-bonus/*') || Request::is('iamadmin/dashboard/add-bonus') ? 'active' : '' }}">
                                <a href="{{ route('add-bonus') }}">{{ _tr('Add Bonus') }} </a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
					*/ ?>


                




                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i>{{ _tr('Teams') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-people/*') || Request::is('iamadmin/dashboard/all-people') ? 'active' : '' }}">
                            <a href="{{ route('all-people') }}">{{ _tr('All Teams') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-people/*') || Request::is('iamadmin/dashboard/add-people') ? 'active' : '' }}">
                            <a href="{{ route('add-people') }}">{{ _tr('Add Team') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/all-people-category/*') || Request::is('iamadmin/dashboard/all-people-category') ? 'active' : '' }}">
                            <a href="{{ route('all-people-category') }}">{{ _tr('All Categories') }}</a>
                        </li>
                        <!-- <li class="{{ Request::is('iamadmin/dashboard/add-people-category/*') || Request::is('iamadmin/dashboard/add-people-category') ? 'active' : '' }}">
                            <a href="{{ route('add-people-category') }}">{{ _tr('Add Category') }}</a>
                        </li> -->

                    </ul>
                </li>




                <?php /* <li>
                    <a href="#"><i class="fa fa-file-text fa-fw"></i>{{ _tr('CMS Pages') }} <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/all-pages/*') || Request::is('iamadmin/dashboard/all-pages') ? 'active' : '' }}">
                            <a  href="{{ route('all-pages') }}">{{ _tr('All Pages') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-page/*') || Request::is('iamadmin/dashboard/add-page') ? 'active' : '' }}">
                            <a  href="{{ route('add-page') }}">{{ _tr('Add Page') }}</a>
                        </li>

                    </ul>
                </li> */ ?>

                

                <li>
                    <a href="#"><i class="fa fa-upload fa-fw"></i> Faqs<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li >
                            <a  href="{{ route('all-faqs') }}">All Faqs</a>
                        </li>
                        <li >
                            <a  href="{{ route('add-faq') }}">Add Faq</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-upload fa-fw"></i> Documents<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li >
                            <a  href="{{ route('all-docs') }}">All Documents</a>
                        </li>
                        <li >
                            <a  href="{{ route('add-doc') }}">Add Document</a>
                        </li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-phone fa-fw"></i>{{ _tr('Contacts') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/all-contacts/*') || Request::is('iamadmin/dashboard/all-contacts') ? 'active' : '' }}">
                            <a href="{{ route('all-contacts') }}">{{ _tr('All Contacts') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-contact/*') || Request::is('iamadmin/dashboard/add-contact') ? 'active' : '' }}">
                            <a href="{{ route('add-contact') }}">{{ _tr('Add Contact') }}</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
				
				<li>
                    <a href="#"><i class="fa fa-phone fa-fw"></i>{{ _tr('Subscription Plan') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/all-contacts/*') || Request::is('iamadmin/dashboard/all-contacts') ? 'active' : '' }}">
                            <a href="{{ route('all-plans') }}">{{ _tr('All Plan') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-contact/*') || Request::is('iamadmin/dashboard/add-contact') ? 'active' : '' }}">
                            <a href="{{ route('add-contact') }}">{{ _tr('Add Plan') }}</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="#"><i class="fa fa-bell fa-fw"></i>{{ _tr('Subscribers') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li class="{{ Request::is('iamadmin/dashboard/all-subscribers/*') || Request::is('iamadmin/dashboard/all-subscribers') ? 'active' : '' }}">
                            <a href="{{ route('all-subscribers') }}">{{ _tr('All Subscribers') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-subscriber/*') || Request::is('iamadmin/dashboard/add-subscriber') ? 'active' : '' }}">
                            <a href="{{ route('add-subscriber') }}">{{ _tr('Add Subscriber') }}</a>
                        </li>

                    </ul>

                </li>


                <li>
                    <a href="#"><i class="fa fa-cog fa-fw"></i>{{ _tr('Settings') }} <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">


                        <li class="{{ Request::is('iamadmin/dashboard/general-settings') ? 'active' : '' }}">
                            <a href="{{ route('general-settings') }}">{{ _tr('General Settings') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/edit-profile') ? 'active' : '' }}">
                            <a href="{{ route('edit-profile') }}">{{ _tr('Your Profile') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/change-password') ? 'active' : '' }}">
                            <a href="{{ route('change-password') }}">{{ _tr('Change Password') }}</a>
                        </li>

                    </ul>

                </li>

                <li>
                    <a href="#"><i class="fa fa-file-video-o fa-fw"></i>{{ _tr('Videos') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <?php /*<li class="{{ Request::is('iamadmin/dashboard/all-video/*') || Request::is('iamadmin/dashboard/all-video') ? 'active' : '' }}">
                            <a href="{{ route('all-video') }}">{{ _tr('All Videos') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-video/*') || Request::is('iamadmin/dashboard/add-video') ? 'active' : '' }}">
                            <a href="{{ route('add-video') }}">{{ _tr('Add Video') }}</a>
                        </li> */ ?>
                        <li class="{{ Request::is('iamadmin/dashboard/landing-page-video/*') || Request::is('iamadmin/dashboard/landing-page-video') ? 'active' : '' }}">
                            <a href="{{ route('landing-page-video') }}">{{ _tr('Landing Page Videos') }}</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

				<li>
                    <a href="{{ route('social-media-links') }}"><i class="fa fa-share-alt fa-fw"></i>{{ _tr('Social Media Links') }} <span class="fa arrow"></span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-paper-plane fa-fw"></i>{{ _tr('Email Templates') }} <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::is('iamadmin/dashboard/all-email-template/*') || Request::is('iamadmin/dashboard/all-email-template') ? 'active' : '' }}">
                            <a  href="{{ route('all-email-template') }}">{{ _tr('All Email Templates') }}</a>
                        </li>
                        <li class="{{ Request::is('iamadmin/dashboard/add-email-template/*') || Request::is('iamadmin/dashboard/add-email-template') ? 'active' : '' }}">
                            <a  href="{{ route('add-email-template') }}">{{ _tr('Add Email Template') }}</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
@stop