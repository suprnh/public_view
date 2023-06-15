@extends('edc.layout.dashboardpanel')
@section('leftbar')
<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('edc-dashboard') }}">Dashboard</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <?php
                $edcArr = getEDCinfo(Session::get('userid'));
                if(!empty($edcArr)){
                    $edcSlug = "edc/".$edcArr->user_slug;
                } else { $edcSlug = "edc/"; }
                ?>
                <a href="<?php echo url($edcSlug); ?>" target="_blank">
                <i class="fa fa-home" aria-hidden="true"></i>
                View Site</a>
            </li>
            <li class=""> EDC | <?php echo getUserName(Session::get('userid')); ?></li>
            <li class="dropdown">
                <a href="{{ route('edc-logout') }}">
                    <i class="fa fa-sign-out fa-fw"></i> Logout
                </a>

                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li >
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Activity Plans<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li >
                                <a href="{{ route('edc-all-activity') }}">All Activity Plans</a>
                            </li>

                            <li >
                                <a href="{{ route('edc-add-activity') }}">Add Activity Plan</a>
                            </li>


                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-phone fa-fw"></i> Contacts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li >
                                <a href="{{ route('edc-all-contacts') }}">All Contacts</a>
                            </li>
                            <li >
                                <a href="{{ route('edc-add-contact') }}">Add Contact</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar fa-fw"></i> Events<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li >
                                <a href="{{ route('edc-all-events') }}">All Events</a>
                            </li>

                            <li >
                                <a href="{{ route('edc-add-event') }}">Add Event</a>
                            </li>

                            <li >
                                <a href="{{ route('edc-event-cal') }}">Calender</a>
                            </li>


                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                   
                    <!--li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Mentors <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li >
                                <a href="{{ route('edc-all-mentor') }}">All Mentors</a>
                            </li>

                            <li >
                                <a href="{{ route('edc-add-mentor') }}">Add  Mentors</a>
                            </li>
                            
                            <li >
                                <a href="{{ route('edc-manage-expertise-category') }}">Categories</a>
                            </li>
                            
                        </ul>

                    </li-->
               
                    <li>
                        <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Start-up Stories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="{{ route('edc-all-success-stories') }}">All Stories</a>
                            </li>
                            <li>
                                <a href="{{ route('edc-add-success-stories') }}">Add Story</a>
                            </li>
                            
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    
                    <!--li>
                        <a href="#"><i class="fa fa-trophy fa-fw"></i> Achievements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li >
                                <a  href="{{ route('edc-all-achievements') }}">All Achievements</a>
                            </li>
                             <li >
                                <a  href="{{ route('edc-add-achievements') }}">Add Achievement</a>
                            </li>
                            
                        </ul>
                    </li-->



        

        <li >
            <a href="#"><i class="fa fa-newspaper-o fa-fw"></i>News <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

                <li >
                    <a href="{{ route('edc-all-news') }}">All News</a>
                </li>

                <li >
                    <a href="{{ route('edc-add-news') }}">Add News</a>
                </li>

            </ul>

         </li>

          <!--li>
            <a href="#"><i class="fa fa-share-alt fa-fw"></i>Branches <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

                <li >
                    <a href="{{ route('edc-all-branches') }}">All Branches</a>
                </li>

                <li >
                    <a href="{{ route('edc-add-branch') }}">Add Branch</a>
                </li>

            </ul>

         </li-->

    <li>
        <a href="#"><i class="fa fa-cog fa-fw"></i>Settings <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">

             <li>
                <a href="{{ route('edc-edit-profile') }}">Your Profile</a>
            </li>
            <li>
                <a href="{{ route('edc-change-password') }}">Change Password</a>
            </li>

        </ul>

    </li>

</ul>
</div>
<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
@stop