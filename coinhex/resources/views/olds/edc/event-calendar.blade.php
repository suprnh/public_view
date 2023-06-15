@extends('edc.layout.leftbar')
@section('title')
<div class="col-lg-12">
    <h1 class="page-header">Event Calendar</h1>
</div>
@stop
@section('dashboard')
            <div class="row">

            @if (Session::has('event_success'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-success">{{ Session::get('event_success') }}</div>
            </div></div>
            @endif

            @if (Session::has('event_error'))
            <div class="row"><div class="col-sm-12">
            <div class="alert alert-danger">{{ Session::get('event_error') }}</div>
            </div></div>
            @endif
             
                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>

            </div>


            <!-- Modal -->
            <div class="modal fade" id="add_event_modal" role="dialog">
                <div class="modal-dialog modal-md">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><strong>Quick Add New Event</strong></h4>
                    </div>
                    <form name="mfrm" action="{{ route('edc-qk-add-ev') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                            <label>Event Name :</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter event name or title" required>
                        </div>
                      </div>
                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4">
                            <label>Start Date :</label>
                            <input type="text" name="start_date" id="sd" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>" required >
                        </div>
                        <div class="col-md-4">
                            <label>End Date :</label>
                            <input type="text" name="end_date" id="ed" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>" required >
                        </div>
                        <div class="col-md-4">
                            <label>Any Color :</label>
                            <select name="event_color" class="form-control">
                              <option style="color:#337ab7;" value="#337ab7">&#9724; Dark blue</option>
                              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                              <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                              <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                              <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                              <option style="color:#000;" value="#000">&#9724; Black</option>
                            </select>
                        </div>
                      </div>
                      <div class="row" style="margin-top: 10px; color:silver;">
                        <div class="col-md-12">
                            <span>**Other required details of any event, you can manage from edit section, thankyou.</span>
                        </div>
                      </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="add" class="btn btn-primary pull-left" value="Add Event">
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
                  
                </div>
            </div>



            <div class="modal fade" id="edit_event_modal" role="dialog">
                <div class="modal-dialog modal-md">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><strong>Quick Edit Event</strong></h4>
                    </div>
                    <form name="mfrm" action="{{ route('edc-qk-up-ev') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                            <label>Event Name :</label>
                            <input type="text" name="title" id="ev_title" class="form-control" placeholder="Enter event name or title" required>
                        </div>
                      </div>
                      <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4">
                            <label>Start Date :</label>
                            <input type="text" name="start_date" id="ev_sd" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>" required >
                        </div>
                        <div class="col-md-4">
                            <label>End Date :</label>
                            <input type="text" name="end_date" id="ev_ed" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>" required >
                        </div>
                        <div class="col-md-4">
                            <label>Any Color :</label>
                            <select name="event_color" class="form-control" id="ev_color">
                              <option style="color:#337ab7;" value="#337ab7">&#9724; Dark blue</option>
                              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                              <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                              <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                              <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                              <option style="color:#000;" value="#000">&#9724; Black</option>
                            </select>
                        </div>
                      </div>
                      <div class="row" style="margin-top: 10px; color:silver;">
                        <div class="col-md-12">
                            <span>**Other required details of any event, you can manage from edit section, thankyou.</span>
                        </div>
                      </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" name="edit" class="btn btn-primary pull-left" value="Save Event">
                                <input type="hidden" name="ev_id" id="ev_id">
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
                  
                </div>
            </div>
@stop

@push('footer-js')
    <script type="text/javascript">

    $(document).ready(function() {
        
        $('#calendar').fullCalendar({
            customButtons: {
                myCustomButton: {
                  text: 'List View',
                  click: function() {
                    window.location.href = "{{ route('edc-all-events') }}";
                  }
                }
            },
            header: {
                left: 'prev,next today myCustomButton',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '<?php echo date('Y-m-d'); ?>',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                
                if(start.isBefore(moment())) {
                    //previous date not select
                } else {
                    $("#add_event_modal #sd").val(moment(start).format("DD-MM-YYYY"));
                    $("#add_event_modal #ed").val(moment(end).format("DD-MM-YYYY"));
                    $('#add_event_modal').modal('show');
                }
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $("#edit_event_modal #ev_title").val(event.title);
                    $("#edit_event_modal #ev_sd").val(moment(event.start).format("DD-MM-YYYY"));
                    $("#edit_event_modal #ev_ed").val(moment(event.end).add(-1, 'days').format("DD-MM-YYYY"));
                    $("#edit_event_modal #ev_color").val(event.color);
                    $("#edit_event_modal #ev_id").val(event.id);
                    $("#edit_event_modal").modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                if(event.start.isBefore(moment())) {
                    //$('#calendar').fullCalendar('removeEvents', event.id); // remove event
                } else {
                    ev_modify(event);
                }
            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                ev_modify(event);

            },
            events: [
                    <?php
                    if(!empty($cal_data) && count($cal_data) > 0)
                    {
                        foreach($cal_data as $data)
                        {
                    ?>
                    {
                        id: '<?php echo $data->ID; ?>',
                        title: '<?php echo $data->title; ?>',
                        start: '<?php echo $data->start_date; ?>',
                        end: '<?php echo date('Y-m-d',strtotime('+1 day', strtotime($data->end_date))); ?>',
                        color: '<?php echo $data->event_color; ?>',
                    },
                    <?php
                        }
                    }
                    ?>
            ]
        });

        
        function ev_modify(event){
            var start = moment(event.start).format("DD-MM-YYYY");
            var end = moment(event.end).add(-1, 'days').format("DD-MM-YYYY");
            var token = "{{ csrf_token() }}";
            var id = event.id;
            $.ajax({
                type:"POST",
                url:"{{ route('ajx-event-modify') }}",
                data:"id="+id+"&start="+start+"&end="+end+"&_token="+token,
                success:function(res)
                {
                    
                }
            });
        }
        
    });

        
    </script>
@endpush