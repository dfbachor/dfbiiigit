@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-dataTables.css') }}">
@endsection

@section('content')
<!-- Plant MENU -------------------------------------------------------------- -->
<div class="container-fluid entityContainer">
    <div class="container col-sm-7">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading" style="height: 50px; padding: 5px">
            
                    <div class="col-sm-9" style="height: 50px;">
                        <span class='dataTableHeaderTitle' id='plantTitle'>Plants <span id='plantCount' class="badge"></span></span>
                    </div>
                    <div class="col-sm-3" style="height: 50px;">
                        <a href='/plants/create' id='plantAddPlant'>Add plant</a>
                    </div>

                </div>
                <table id="datatable" class="table table-bordered table-striped table-hover table-condensedv" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Batch</th>
                            <th>Room</th>
                            <th>Strain</th>
                            <th>Stage</th>
                            <th>Days in Stage</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>	

    <!-- plant DETAIL -->
    <div class="container col-sm-5">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading col-sm-2" style="height: 50px; padding: 1px">
                    <a href='#' id="plantPhotoAnchor">					            	
                        {{-- <img class="companyLogo" id="plantPhoto" src="{{ route('system.image', ['filename' => app('system')->imageFileName]) }}" height='48' width='48'> --}}
                        <img class="companyLogo" id="plantPhoto" src="{{ route('image', ['filename' => app('system')->imageFileName]) }}" height='48' width='48'>
                    </a> 
                </div>
                <div class="panel-heading col-sm-8" style="height: 50px;">
                    <h4 id='plantsDetailTitle'>Plant Detail</h4> 
                </div>
                <div class="panel-heading col-sm-2" style="height: 50px;">
                    <span id='editPlantLink'></span> 
                    <span class='admin' id='deletePlantLink'></span> 
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="container col-sm-12" style="padding: 2px;">
                <div class="panel-group" id="plantAccordion" style="width: 100%;">
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" 
                                    data-parent="#plantAccordion" href="#plantCollapse1">Plant Information</a>
                            </h4>
                        </div>
                        <div id="plantCollapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id='plantDetail'>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a id="plantNotesTitle" class="accordion-toggle" data-toggle="collapse"
                                             data-parent="#plantAccordion" href="#plantCollapse2">Plant Notes <span id='noteCount' class="badge"></span></a>
                            </h4>
                        </div>
                        <div id="plantCollapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p><a href='#' data-toggle="modal" data-target="#noteModal">
                                    Add Note
                                </a></p>
                                <div id='plantNotesListing'>
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
                                        <table id="plantNotesTable">
                                            <tbody id="plantNotesTableBody">

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
                            <a id="plantAboutTitle" class="accordion-toggle" data-toggle="collapse" 
                                                data-parent="#plantAccordion" href="#plantCollapse3">About</a>
                            </h4>
                        </div>
                        
                        <div id="plantCollapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="seedBullet">
                                    <li>
                                        A plant is a person that can utilize this application.							        					</li>
                                    <li>
                                        A plant can have an Administrator role or a plant role.							        					</li>
                                    <li>
                                        When a grow operation is registered, the initial plant is setup as an Administrator
                                    </li>
                                    <li>
                                        An Administrator will have access to all menus and features while a plant will have limited access.  Currently, Administrators can access the Settings menu and the plants menu.
                                    </li>
                                    <li>
                                        To add a new plant, click on the<a href='#' id='plantAddplant' data-toggle="modal" data-target="#plantModal"> Add plant </a>link at the top of the plant list.
                                    </li>
                                    <li>
                                        You can upload a photo for each plant.  This works great from a tablet where you can take the picture at the time of entry.  A default photo (or the system logo setup in the Settings Menu) will display in the event a photo was not added. 
                                    </li>
                                    <li>
                                        Clicking on the plants photo will show the photo in a pop-up window for better visibility.
                                    </li>
                                    <li>
                                        To edit a plant, select the plant from the list on the left, click the Edit link will appear at the top of the plant Information section. 
                                    </li>
                                    <li>
                                        To delete a plant, select the plant from the list on the left, click the plant link at the top of the plant Information section. 
                                    </li>
                                    <li>
                                        The plant Information section displays all of the details for the selected plant. 
                                    </li>
                                    <li>
                                        The plant Notes section enables you to enter in notes for the plant.
                                    </li>
                                    <li>
                                        Only a plant with Administrator role can access the plant Menu.
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
        var selectedEntityType = "plant"; 

        $('#plantPhotoAnchor').on('click', function() {
            //function showplantImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', $('#plantPhoto').attr('src') + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html("ID " + selectedEntityID);
                $("#imagePopupFooterArea").html($('#plantsDetailTitle').html());
            //}
        });

        $(document).ready( function () {
            
            var table = $('#datatable');
            
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.plants.index') }}",
                    "type": "post",
                    "data": {
                        "systemID": {{ app('system')->id }}
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "batchName" },
                    { "data": "roomName" },
                    { "data": "strainName" },
                    { "data": "stageName" },
                    { "data": "daysInStage" },
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
                $("#plantCount").html($('#datatable').DataTable().data().count());	
                $('#datatable tbody tr:eq(0)').click();
            
            }, 500); 
        });

        /***********************************************************************/
        $('#datatable tbody').on('click', 'tr', function() {
                        
            selectedEntityID = $(this).find('td').html();
            getSinglePlantData(selectedEntityID);

            $('#datatable tr').removeClass('selected'); // de-highlight all in the table
            $(this).addClass('selected'); // highlight the select row - the row displayed in the use info section
        });
        /***********************************************************************/
        function getSinglePlantData(plantID) {
            if(plantID) {
                getSinglePlantDetail(plantID);
                $("#plantNotesTableBody").html("");
               var notes = getNotes(plantID, "plant", showPlantNotes); // getNotes is from notes.model
        
            } else {

            }
        }
        /***********************************************************************/

        function getSinglePlantDetail (plantID) {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
					    // alert(resp);
                        
						if(resp != 0){
							resp = $.parseJSON(resp);
							showPlantDetail(resp);
						
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("GET","/api/plants/" + plantID, false);
				xmlhttp.send();
        }
        /***********************************************************************/

        function showPlantDetail(plant) {
            // somewhat of a hack since the plant array passed in
            // has an integer string ("3") value as its key and we dont
            // always know what is is - but we should only
            // always have just one object   
            var key = Object.keys(plant)[0];
            //alert(plant[key].name);

            var plantId = plant[key].id + " " + "<br>";

                $("#imagePopupName").html("plantID: " + plantId);
                $("#plantsDetailTitle").html("plantID: " + plantId);

                var plantImg;
                if(plant[key].imageFileName == null)
                    plantImg = '/image/' + '{{ app('system')->imageFileName }}';
                    
                else 
                    plantImg = '/image/' + plant[key].imageFileName;

               
                $("#plantPhoto").attr('src', plantImg + "?ghost=" + Math.random());
                            
                var myTable	= "<table class='table table-bordered table-condensed' >";
                    //myTable	+= "<tr>";
                        myTable	+= "<col class='col-sm-6'>";
                        myTable	+= "<col class='col-sm-6'>";

                    myTable	+= "<tr>";
                        myTable	+= "<th>ID</th>";
                        myTable	+= "<td id='plantTD'>" + plant[key].id + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Type</th>";
                        myTable	+= "<td>" + plant[key].type + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Room</th>";
                        myTable	+= "<td>" + plant[key].roomName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Plant Type</th>";
                        myTable	+= "<td>" + plant[key].strainName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Stage</th>";
                        myTable	+= "<td>" + plant[key].stageName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Medium</th>";
                        myTable	+= "<td>" + plant[key].mediumName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                            myTable	+= "<th>Start Date</th>";
                            myTable	+= "<td>" + plant[key].startDate + "</td>";
                    myTable	+= "</tr>";
                    // myTable	+= "<tr>";
                    //         myTable	+= "<th>Cycle Change Date</th>";
                    //         myTable	+= "<td>" + plant[key].cycleChangeDate + "</td>";
                    // myTable	+= "</tr>";
                    // myTable	+= "<tr>";
                    //         myTable	+= "<th>Harvest Date</th>";
                    //         myTable	+= "<td>" + plant[key].harvestDate + "</td>";
                    // myTable	+= "</tr>";
                    myTable	+= "<tr>";
                            myTable	+= "<th>Complete Date</th>";
                            myTable	+= "<td>" + plant[key].completeDate + "</td>";
                    myTable	+= "</tr>";
                    // myTable	+= "<tr>";
                    //         myTable	+= "<th>Yield</th>";
                    //         myTable	+= "<td>" + plant[key].yield + "</td>";
                    // myTable	+= "</tr>";                    
            
                myTable	+= "</table>";  
            
            $("#plantDetail").html(myTable);
            $("#editPlantLink").html("<a href='/plants/edit/" + plant[key].id + "'>edit</a>");
            $("#deletePlantLink").html("<a href='/plants/destroy/" + plant[key].id + "'>delete</a>");
            
            $("#plantnameTD").focus();
        } // end showplantDetail

        /***********************************************************************/
        

        $("#deletePlantLink").click( function(e) {
            if(!confirm("Are you sure you want to delete this plant?"))
                e.preventDefault();
        });

        
        /***********************************************************************/

        function showPlantNotes(notes) {

            //alert(plantNotes);
	
            $("#plantNotesTableBody").html("");
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
                        
                        noteRows += "<td width='25'><a href='javascript:updatePlantNote(" + notes[i].id + ")' id='notePlantEditLink" + notes[i].id + "'>remove</a></td>";

                    noteRows += "</tr>";
                }

                $("#noteCount").html(notes.length);
                $("#plantNotesTableBody").append(noteRows);
        }
        /***********************************************************************/
        function noteOnFocus(id) {
            // alert("onfocus");
            
            $("#notePlantEditLink" + id).html("save");
        }
        /***********************************************************************/
        function updatePlantNote(id) {

            if($("#notePlantEditLink" + id).html() == "remove") {
                removeNote(id, refreshNotedForPlant);
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
                                refreshNotedForPlant(id);
                            
                            } else {
                                alert(resp);
                            }
                        } //end if
                    } // end  function
        
                    xmlhttp.open("post","api/notes/update", true);	
                    xmlhttp.send(formData);

                    $("#notePlantEditLink" + id).html("remove");
            }
        }

        /***********************************************************************/

        function refreshNotedForPlant() {
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSinglePlantData(selectedEntityID);

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
                getSinglePlantData(selectedEntityID);

            }, 1000)
        });

        /***********************************************************************/        



    </script>
@endsection