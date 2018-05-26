@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-dataTables.css') }}">
@endsection

@section('content')
<!-- room MENU -------------------------------------------------------------- -->
<div class="container-fluid entityContainer">
    <div class="container col-sm-7">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading" style="height: 50px; padding: 5px">
            
                        <div class="col-sm-9" style="height: 50px;">
                            <span class='dataTableHeaderTitle' id='roomTitle'>Rooms <span id='roomCount' class="badge"></span></span>
                        </div>
                        <div class="col-sm-3" style="height: 50px;">
                            <a href='/rooms/create' id='roomAddRoom'>Add Room</a>
                      </div>

                </div>
                <table id="datatable" class="table table-bordered table-striped table-hover table-condensedv" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Name</th>
                            <th>Lighting</th>
                            <th>Plants</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>	

    <!-- room DETAIL -->
    <div class="container col-sm-5">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading col-sm-2" style="height: 50px; padding: 1px">
                    <a href='#' id="roomPhotoAnchor">					            	
                        {{-- <img class="companyLogo" id="roomPhoto" src="{{ app('system')->imageFileName }}" height='48' width='48'> --}}
                        <img class="companyLogo" id="roomPhoto" src="{{ route('image', ['filename' => app('system')->imageFileName]) }}" height='48' width='48'>

                    </a> 
                </div>
                <div class="panel-heading col-sm-8" style="height: 50px;">
                    <h4 id='roomsDetailTitle'>Room Detail</h4> 
                </div>
                <div class="panel-heading col-sm-2" style="height: 50px;">
                    <span id='editRoomLink'></span> 
                    <span class='admin' id='deleteRoomLink'></span> 
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="container col-sm-12" style="padding: 2px;">
                <div class="panel-group" id="roomAccordion" style="width: 100%;">
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" 
                                    data-parent="#roomAccordion" href="#roomCollapse1">Room Information</a>
                            </h4>
                        </div>
                        <div id="roomCollapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id='roomDetail'>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a id="roomNotesTitle" class="accordion-toggle" data-toggle="collapse"
                                             data-parent="#roomAccordion" href="#roomCollapse2">Room Notes <span id='noteCount' class="badge"></span></a>
                            </h4>
                        </div>
                        <div id="roomCollapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p><a href='#' data-toggle="modal" data-target="#noteModal">
                                    Add Note
                                </a></p>
                                <div id='roomNotesListing'>
                                    <table>
                                            <thead>
                                                <tr>
                                                    <th width="200">Notes</th>
                                                    <th width="200">Date Time</th>
                                                    <th width="25"></th>
                                                </tr>
                                            </thead>
                                    </table>

                                    <div style="max-height: 200px; overflow: auto;">
                                        <table id="roomNotesTable">
                                            <tbody id="roomNotesTableBody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a id="roomAboutTitle" class="accordion-toggle" data-toggle="collapse" 
                                                data-parent="#roomAccordion" href="#roomCollapse3">About</a>
                            </h4>
                        </div>
                        
                        <div id="roomCollapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="seedBullet">
                                    <li>
                                        Need Rom detail here
                                    </li>                                    
                                </ul>
                            </div> <!-- panel-body -->
                        </div> <!-- growCollapse3 -->					      
                    </div> <!-- panel panel-default -->
                </div>
            </div> 
        </div> <!-- row -->
    </div>
</div>

@include('notes.model')

@endsection

@section('javascripts')

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        //global
        var selectedEntityID = null; 
        var selectedEntityType = "room"; 

        $('#roomPhotoAnchor').on('click', function() {
            //function showroomImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', $('#roomPhoto').attr('src') + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html("ID " + selectedEntityID);
                $("#imagePopupFooterArea").html($('#roomsDetailTitle').html());
            //}
        });

        $(document).ready( function () {
            
            var table = $('#datatable');
            
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.rooms.index') }}",
                    "type": "post",
                    "data": {
                        "systemID": {{ app('system')->id }}
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "roomName" },
                    { "data": "lighting" },
                    { "data": "plants" }
                ],
                "bScrollInfinite": true, 
                "bScrollCollapse": true, 
                "sScrollY": "400px",
                "fnDrawCallback": function() {
                        table.dataTable()._fnScrollDraw();        
                        table.closest(".dataTables_scrollBody").height(400);
                }
            });

            setTimeout(function() {
                // the timeout is needed to give the ajax call a change to complete 
                $("#roomCount").html($('#datatable').DataTable().data().count());	
                $('#datatable tbody tr:eq(0)').click();
            
            }, 500); 
                        

        });
        /***********************************************************************/
        $('#datatable tbody').on('click', 'tr', function() {
                        
            selectedEntityID = $(this).find('td').html();
            getSingleRoomData(selectedEntityID);

            $('#datatable tr').removeClass('selected'); // de-highlight all in the table
            $(this).addClass('selected'); // highlight the select row - the row displayed in the use info section
        });
        /***********************************************************************/
        function getSingleRoomData(roomID) {
            if(roomID) {
                getSingleRoomDetail(roomID);
                $("#roomNotesTableBody").html("");
               var notes = getNotes(roomID, "room", showRoomNotes); // getNotes is from notes.model
        
            } else {

            }
        }
        /***********************************************************************/

        function getSingleRoomDetail (roomID) {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
					    // alert(resp);
                        
						if(resp != 0){
							resp = $.parseJSON(resp);
							showRoomDetail(resp);
						
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("GET","/api/rooms/" + roomID, false);
				xmlhttp.send();
        }
        /***********************************************************************/

        function showRoomDetail(room) {
            // somewhat of a hack since the room array passed in
            // has an integer string ("3") value as its key and we dont
            // always know what is is - but we should only
            // always have just one object 
            var key = Object.keys(room)[0];
            //alert(room[key].name);

            var roomId = room[key].id + " " + "<br>";
                $("#imagePopupName").html("roomID: " + roomId);
                $("#roomsDetailTitle").html("roomID: " + roomId);

                //roomImg = '{{ app('system')->imageFileName }}';
                //$("#roomPhoto").attr('src', roomImg + "?ghost=" + Math.random());
                            
                var myTable	= "<table class='table table-bordered table-condensed' >";
                    //myTable	+= "<tr>";
                        myTable	+= "<col class='col-sm-6'>";
                        myTable	+= "<col class='col-sm-6'>";

                    myTable	+= "<tr>";
                        myTable	+= "<th>Room Name</th>";
                        myTable	+= "<td id='roomTD'>" + room[key].roomName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Lighting</th>";
                        myTable	+= "<td>" + room[key].lighting + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Hours of Operation</th>";
                        myTable	+= "<td>" + room[key].hoursOfOperation + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Exhaust Type</th>";
                        myTable	+= "<td>" + room[key].exhaustType + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Humidifier</th>";
                        myTable	+= "<td>" + room[key].humidifier + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Room Information</th>";
                        myTable	+= "<td>" + room[key].comment + "</td>";
                    myTable	+= "</tr>";

                myTable	+= "</table>";  
            
            $("#roomDetail").html(myTable);
            $("#editRoomLink").html("<a href='/rooms/edit/" + room[key].id + "'>edit</a>");
            $("#deleteRoomLink").html("<a href='/rooms/destroy/" + room[key].id + "'>delete</a>");
            
            $("#roomnameTD").focus();
        } // end showroomDetail

        /***********************************************************************/
        

        $("#deleteRoomLink").click( function(e) {
            if(!confirm("Are you sure you want to delete this room?"))
                e.preventDefault();
        });

        
        /***********************************************************************/

        function showRoomNotes(notes) {

            //alert(roomNotes);
	
            $("#roomNotesTableBody").html("");
            //alert(patientNotes.length);
            var noteRows = "";
        
                for(var i = 0; i < notes.length; i++) {
                    noteRows += "<tr>";
                    noteRows += "<td width='200'>";
                    noteRows += "<textarea id='noteID" + notes[i].id + "' rows='2' cols='25' maxlength='1056' onfocus='noteOnFocus(" + notes[i].id + ")'>" + notes[i].note + "</textarea>"
                    noteRows += "</td>"
                    noteRows += "<td width='200'>" + notes[i].updated_at + "</td>";


                    if('' == notes[i].imageFileName) {
                        noteRows += "<td width='35'></td>";
                    } else {
                        noteRows += "<td width='35'>";
                            noteRows += "<a href='javascript:showNoteImage(" + notes[i].id + ", \"" + notes[i].note + "\", \"" + notes[i].imageFileName + "\")'>";
                                
                                if(notes[i].imageFileName == null)
                                    var imageFileName = '{{ app('system')->imageFileName }}';
                                else
                                    var imageFileName = notes[i].imageFileName;
                                
                                noteRows += "<img width='30' hieght='30' src='" + imageFileName + "' alt=''></img>";
                            noteRows += "</a>";
                        noteRows += "</td>";
                    }
                    
                    noteRows += "<td width='25'><a href='javascript:updateRoomNote(" + notes[i].id + ")' id='noteRoomEditLink" + notes[i].id + "'>remove</a></td>";

                    noteRows += "</tr>";
                }

                $("#noteCount").html(notes.length);
                $("#roomNotesTableBody").append(noteRows);
        }
        /***********************************************************************/
        function noteOnFocus(id) {
            // alert("onfocus");
            
            $("#noteRoomEditLink" + id).html("save");
        }
        /***********************************************************************/
        function updateRoomNote(id) {

            if($("#noteRoomEditLink" + id).html() == "remove") {
                removeNote(id, refreshNotedForRoom);
            } else{
            
                var formData = new FormData();	

                    formData.append('id', id);
                    formData.append('note', $('#noteID' + id).val());
                    formData.append('systemID', {{ app('system')->id }});
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var resp = xmlhttp.responseText; // return values go here
                            
                            // alert("respone from update note php " + resp);
                            
                            if(resp == "success"){
                                refreshNotedForRoom(id);
                            
                            } else {
                                alert(resp);
                            }
                        } //end if
                    } // end  function
        
                    xmlhttp.open("post","api/notes/update", true);	
                    xmlhttp.send(formData);

                    $("#noteRoomEditLink" + id).html("remove");
            }
        }

        /***********************************************************************/

        function refreshNotedForRoom() {
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSingleRoomData(selectedEntityID);

            }, 1000)
        }

        /***********************************************************************/        

        $('#noteSubmit').on('click', function() {
            // not really liking this solution but seems can't find a way to refresh
            // without calling from the note files - i'd rather trigger it from this file
            // if I could find a way to get a callback to the note fiel then that would work
            // untl then, this is a work around.
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSingleRoomData(selectedEntityID);

            }, 1000)
        });

        /***********************************************************************/        



    </script>
@endsection