@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-dataTables.css') }}">
@endsection

@section('content')
<!-- strain MENU -------------------------------------------------------------- -->
<div class="container-fluid entityContainer">
    <div class="container col-sm-7">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading" style="height: 50px; padding: 5px">
            
                        <div class="col-sm-9" style="height: 50px;">
                            <span class='dataTableHeaderTitle' id='strainTitle'>Plant Types <span id='strainCount' class="badge"></span></span>
                        </div>
                        <div class="col-sm-3" style="height: 50px;">
                            <a href='/strains/create' id='strainAddStrain'>Add Plant Type</a>
                      </div>

                </div>
                <table id="datatable" class="table table-bordered table-striped table-hover table-condensedv" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Plant Type</th>
                            <th>Plants</th>
                            <th>Flowering Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>	

    <!-- strain DETAIL -->
    <div class="container col-sm-5">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading col-sm-2" style="height: 50px; padding: 1px">
                    <a href='#' id="strainPhotoAnchor">					            	
                        {{-- <img class="companyLogo" id="strainPhoto" src="{{ app('system')->imageFileName }}" height='48' width='48'> --}}
                        <img class="companyLogo" id="strainPhoto" src="{{ route('image', ['filename' => app('system')->imageFileName]) }}" height='48' width='48'>
                    </a> 
                </div>
                <div class="panel-heading col-sm-8" style="height: 50px;">
                    <h4 id='strainsDetailTitle'>Plant Type Detail</h4> 
                </div>
                <div class="panel-heading col-sm-2" style="height: 50px;">
                    <span id='editStrainLink'></span> 
                    <span class='admin' id='deleteStrainLink'></span> 
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="container col-sm-12" style="padding: 2px;">
                <div class="panel-group" id="strainAccordion" style="width: 100%;">
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" 
                                    data-parent="#strainAccordion" href="#strainCollapse1">Plant Type Information</a>
                            </h4>
                        </div>
                        <div id="strainCollapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id='strainDetail'>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a id="strainNotesTitle" class="accordion-toggle" data-toggle="collapse"
                                             data-parent="#strainAccordion" href="#strainCollapse2">Plant Type Notes <span id='noteCount' class="badge"></span></a>
                            </h4>
                        </div>
                        <div id="strainCollapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p><a href='#' data-toggle="modal" data-target="#noteModal">
                                    Add Note
                                </a></p>
                                <div id='strainNotesListing'>
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
                                        <table id="strainNotesTable">
                                            <tbody id="strainNotesTableBody">

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
                            <a id="strainAboutTitle" class="accordion-toggle" data-toggle="collapse" 
                                                data-parent="#strainAccordion" href="#strainCollapse3">About</a>
                            </h4>
                        </div>
                        
                        <div id="strainCollapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="seedBullet">
                                    <li>
                                        Info about plant type goes here.
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
        var selectedEntityType = "strain"; 

        $('#strainPhotoAnchor').on('click', function() {
            //function showstrainImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', $('#strainPhoto').attr('src') + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html("ID " + selectedEntityID);
                $("#imagePopupFooterArea").html($('#strainsDetailTitle').html());
            //}
        });

        $(document).ready( function () {
            
            var table = $('#datatable');
            
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.strains.index') }}",
                    "type": "post",
                    "data": {
                        "systemID": {{ app('system')->id }}
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "strainName" },
                    { "data": "plants" },
                    { "data": "floweringTimeInDays" },
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
                $("#strainCount").html($('#datatable').DataTable().data().count());	
                $('#datatable tbody tr:eq(0)').click();
            
            }, 500); 
                        

        });
        /***********************************************************************/
        $('#datatable tbody').on('click', 'tr', function() {
                        
            selectedEntityID = $(this).find('td').html();
            getSingleStrainData(selectedEntityID);

            $('#datatable tr').removeClass('selected'); // de-highlight all in the table
            $(this).addClass('selected'); // highlight the select row - the row displayed in the use info section
        });
        /***********************************************************************/
        function getSingleStrainData(strainID) {
            if(strainID) {
                getSingleStrainDetail(strainID);
                $("#strainNotesTableBody").html("");
               var notes = getNotes(strainID, "strain", showStrainNotes); // getNotes is from notes.model
        
            } else {

            }
        }
        /***********************************************************************/

        function getSingleStrainDetail (strainID) {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
					    // alert(resp);
                        
						if(resp != 0){
							resp = $.parseJSON(resp);
							showStrainDetail(resp);
						
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("GET","/api/strains/" + strainID, false);
				xmlhttp.send();
        }
        /***********************************************************************/

        function showStrainDetail(strain) {
            // somewhat of a hack since the strain array passed in
            // has an integer string ("3") value as its key and we dont
            // always know what is is - but we should only
            // always have just one object 
            var key = Object.keys(strain)[0];
            //alert(strain[key].name);

            var strainId = strain[key].id + " " + "<br>";
                $("#imagePopupName").html("strainID: " + strainId);
                $("#strainsDetailTitle").html("strainID: " + strainId);

                //strainImg = '{{ app('system')->imageFileName }}';
                //$("#strainPhoto").attr('src', strainImg + "?ghost=" + Math.random());
                            
                var myTable	= "<table class='table table-bordered table-condensed' >";
                    //myTable	+= "<tr>";
                        myTable	+= "<col class='col-sm-6'>";
                        myTable	+= "<col class='col-sm-6'>";

                    myTable	+= "<tr>";
                        myTable	+= "<th>strain Name</th>";
                        myTable	+= "<td id='strainTD'>" + strain[key].strainName + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Testing Status</th>";
                        myTable	+= "<td>" + strain[key].testingStatus + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                            myTable	+= "<th>Flowering Time In Days</th>";
                            myTable	+= "<td>" + strain[key].floweringTimeInDays + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                            myTable	+= "<th>Genetics</th>";
                            myTable	+= "<td>" + strain[key].genetics + "</td>";
                    myTable	+= "</tr>";
                    
            
                myTable	+= "</table>";  
            
            $("#strainDetail").html(myTable);
            $("#editStrainLink").html("<a href='/strains/edit/" + strain[key].id + "'>edit</a>");
            $("#deleteStrainLink").html("<a href='/strains/destroy/" + strain[key].id + "'>delete</a>");
            
            $("#strainnameTD").focus();
        } // end showstrainDetail

        /***********************************************************************/
        

        $("#deleteStrainLink").click( function(e) {
            if(!confirm("Are you sure you want to delete this plant type?"))
                e.preventDefault();
        });

        
        /***********************************************************************/

        function showStrainNotes(notes) {

            //alert(strainNotes);
	
            $("#strainNotesTableBody").html("");
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
                    
                    noteRows += "<td width='25'><a href='javascript:updateStrainNote(" + notes[i].id + ")' id='noteStrainEditLink" + notes[i].id + "'>remove</a></td>";

                    noteRows += "</tr>";
                }

                $("#noteCount").html(notes.length);
                $("#strainNotesTableBody").append(noteRows);
        }
        /***********************************************************************/
        function noteOnFocus(id) {
            // alert("onfocus");
            
            $("#noteStrainEditLink" + id).html("save");
        }
        /***********************************************************************/
        function updateStrainNote(id) {

            if($("#noteStrainEditLink" + id).html() == "remove") {
                removeNote(id, refreshNotedForStrain);
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
                                refreshNotedForStrain(id);
                            
                            } else {
                                alert(resp);
                            }
                        } //end if
                    } // end  function
        
                    xmlhttp.open("post","api/notes/update", true);	
                    xmlhttp.send(formData);

                    $("#noteStrainEditLink" + id).html("remove");
            }
        }

        /***********************************************************************/

        function refreshNotedForStrain() {
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSingleStrainData(selectedEntityID);

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
                getSingleStrainData(selectedEntityID);

            }, 1000)
        });

        /***********************************************************************/        



    </script>
@endsection