@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-dataTables.css') }}">
@endsection

@section('content')
<!-- task MENU -------------------------------------------------------------- -->
<div class="container-fluid entityContainer">
    <div class="container col-sm-7">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading" style="height: 50px; padding: 5px">
            
                        <div class="col-sm-2" style="height: 50px;">
                            <span class='dataTableHeaderTitle' id='taskTitle'>Tasks <span id='taskCount' class="badge"></span></span>
                        </div>

                        <div class="col-sm-7" style="height: 50px;">
                            <label for="tasksToggleShowClosedTasks">Show Closed</label>
                            <input type="checkbox" id="tasksToggleShowClosedTasks">
                        </div>                        

                        <div class="col-sm-3" style="height: 50px;">
                            <a href='/tasks/create' id='taskAddtask'>Add Task</a>
                      </div>

                </div>
                <table id="datatable" class="table table-bordered table-striped table-hover table-condensedv" cellpadding="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Task</th>
                            <th>Assigned To</th>
                            <th>Open Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>	

    <!-- task DETAIL -->
    <div class="container col-sm-5">
        <div class="row">
            <div class="panel panel-default panel-success">
                <div class="panel-heading col-sm-2" style="height: 50px; padding: 1px">
                    <a href='#' id="taskPhotoAnchor">					            	
                        <img class="companyLogo" id="taskPhoto" src="/image/{{app('system')->imageFileName}}" height='48' width='48'>
                    </a> 
                </div>
                <div class="panel-heading col-sm-8" style="height: 50px;">
                    <h4 id='tasksDetailTitle'>task Detail</h4> 
                </div>
                <div class="panel-heading col-sm-2" style="height: 50px;">
                    <span id='edittaskLink'></span> 
                    <span class='admin' id='deletetaskLink'></span> 
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="container col-sm-12" style="padding: 2px;">
                <div class="panel-group" id="taskAccordion" style="width: 100%;">
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" 
                                    data-parent="#taskAccordion" href="#taskCollapse1">Task Information</a>
                            </h4>
                        </div>
                        <div id="taskCollapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div id='taskDetail'>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a id="taskNotesTitle" class="accordion-toggle" data-toggle="collapse"
                                             data-parent="#taskAccordion" href="#taskCollapse2">task Notes <span id='noteCount' class="badge"></span></a>
                            </h4>
                        </div>
                        <div id="taskCollapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p><a href='#' data-toggle="modal" data-target="#noteModal">
                                    Add Note
                                </a></p>
                                <div id='taskNotesListing'>
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
                                        <table id="taskNotesTable">
                                            <tbody id="taskNotesTableBody">

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
                            <a id="taskAboutTitle" class="accordion-toggle" data-toggle="collapse" 
                                                data-parent="#taskAccordion" href="#taskCollapse3">About</a>
                            </h4>
                        </div>
                        
                        <div id="taskCollapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="seedBullet">
                                    <li>
                                        A task is a person that can utilize this application.							        					</li>
                                    <li>
                                        A task can have an Administrator role or a task role.							        					</li>
                                    <li>
                                        When a grow operation is registered, the initial task is setup as an Administrator
                                    </li>
                                    <li>
                                        An Administrator will have access to all menus and features while a task will have limited access.  Currently, Administrators can access the Settings menu and the tasks menu.
                                    </li>
                                    <li>
                                        To add a new task, click on the<a href='#' id='taskAddtask' data-toggle="modal" data-target="#taskModal"> Add task </a>link at the top of the task list.
                                    </li>
                                    <li>
                                        You can upload a photo for each task.  This works great from a tablet where you can take the picture at the time of entry.  A default photo (or the system logo setup in the Settings Menu) will display in the event a photo was not added. 
                                    </li>
                                    <li>
                                        Clicking on the tasks photo will show the photo in a pop-up window for better visibility.
                                    </li>
                                    <li>
                                        To edit a task, select the task from the list on the left, click the Edit link will appear at the top of the task Information section. 
                                    </li>
                                    <li>
                                        To delete a task, select the task from the list on the left, click the task link at the top of the task Information section. 
                                    </li>
                                    <li>
                                        The task Information section displays all of the details for the selected task. 
                                    </li>
                                    <li>
                                        The task Notes section enables you to enter in notes for the task.
                                    </li>
                                    <li>
                                        Only a task with Administrator role can access the task Menu.
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
        var selectedEntityType = "task"; 

        $('#taskPhotoAnchor').on('click', function() {
            //function showtaskImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', $('#taskPhoto').attr('src') + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html("ID " + selectedEntityID);
                $("#imagePopupFooterArea").html($('#tasksDetailTitle').html());
            //}
        });

        $(document).ready( function () {

            function getTaskParameters() {

                // seem like it should be the reverse and we should send 'closed' when the checkis checked - but in this case
                // the data query is selectin where the status is not 'closed' -  so just passing the text needed to execut the query
                var closed = ($('#tasksToggleShowClosedTasks').prop('checked')) ? 'zzzzzzzzzzzzzzzzzzzzzzzzzzzz' : 'closed';

                var obj = {
                    'systemID': {{ app('system')->id }},
                    'closed': closed
               };
               return obj;

            }

            
            var table = $('#datatable');
            
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.tasks.index') }}",
                    "type": "post",
                    "data": getTaskParameters
                },
                "columns": [
                    { "data": "id" },
                    { "data": "task" },
                    { "data": "name" },
                    { "data": "created_at" },
                    { "data": "status" }
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
                $("#taskCount").html($('#datatable').DataTable().data().count());	
                if($('#datatable').DataTable().data().count() != 0)
                    $('#datatable tbody tr:eq(0)').click();
            
            }, 500); 

            $("#tasksToggleShowClosedTasks").change(function() {
                if(this.checked) {
                    // table.ajax.reload();
                    $('#datatable').DataTable().ajax.reload();
    
                } else {
                    $('#datatable').DataTable().ajax.reload();
    
                }
            });
                    
        });
        /***********************************************************************/
        $('#datatable tbody').on('click', 'tr', function() {
                        
            selectedEntityID = $(this).find('td').html();
            getSingleTaskData(selectedEntityID);

            $('#datatable tr').removeClass('selected'); // de-highlight all in the table
            $(this).addClass('selected'); // highlight the select row - the row displayed in the use info section
        });
        /***********************************************************************/
        function getSingleTaskData(taskID) {
            if(taskID) {
                getSingleTaskDetail(taskID);
                $("#taskNotesTableBody").html("");
               var notes = getNotes(taskID, "task", showtaskNotes); // getNotes is from notes.model
        
            } else {

            }
        }
        /***********************************************************************/

        function getSingleTaskDetail (taskID) {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
					    // alert(resp);
                        
						if(resp != 0){
							resp = $.parseJSON(resp);
							showTaskDetail(resp);
						
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("GET","/api/tasks/" + taskID, false);
				xmlhttp.send();
        }
        /***********************************************************************/

        function showTaskDetail(task) {
            // somewhat of a hack since the task array passed in
            // has an integer string ("3") value as its key and we dont
            // always know what is is - but we should only
            // always have just one object 
            var key = Object.keys(task)[0];
            //alert(task[key].name);

            var taskId = task[key].id + " " + "<br>";
                $("#imagePopupName").html("TaskID: " + taskId);
                $("#tasksDetailTitle").html("TaskID: " + taskId);

                taskImg = '{{ app('system')->imageFileName }}';
                $("#taskPhoto").attr('src', taskImg + "?ghost=" + Math.random());
                            
                var myTable	= "<table class='table table-bordered table-condensed' >";
                    //myTable	+= "<tr>";
                        myTable	+= "<col class='col-sm-6'>";
                        myTable	+= "<col class='col-sm-6'>";

                    myTable	+= "<tr>";
                        myTable	+= "<th>Task Name</th>";
                        myTable	+= "<td id='taskTD'>" + task[key].task + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Status</th>";
                        myTable	+= "<td>" + task[key].status + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Assigned To</th>";
                        myTable	+= "<td>" + task[key].name + "</td>";
                    myTable	+= "</tr>";
                        myTable	+= "<tr>";
                        myTable	+= "<th>Open Date</th>";
                        myTable	+= "<td>" + task[key].created_at + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Close Date</th>";

                        if(!task[key].closed_at) {
                            myTable += "<td><a href='javascript:updateTaskCloseDate(" + task[key].id + ", 1 )'>Update with todays date</a></td>";	
                        } else {
                            myTable	+= "<td>" + task[key].closed_at + "<a href='javascript:updateTaskCloseDate(" + task[key].id + ", 0)'> remove date</a></td>";
                        }
        
                    myTable	+= "</tr>";

                myTable	+= "</table>";  
            
            $("#taskDetail").html(myTable);
            $("#edittaskLink").html("<a href='/tasks/edit/" + task[key].id + "'>edit</a>");
            $("#deletetaskLink").html("<a href='/tasks/destroy/" + task[key].id + "'>delete</a>");
            
            $("#tasknameTD").focus();
        } // end showtaskDetail

        /***************************************************************/
        function updateTaskCloseDate(tID, action) {
            // if(confirm("Are you sure you want to close this Task?")) {

                var formData = new FormData();	

                formData.append('id', tID);
                formData.append('action', action); // update or remove
                formData.append('operatorUserName', '{{ Auth::user()->username }}');
                formData.append('systemID', {{ app('system')->id }});
                //  formData.append('_token', '{{ csrf_token() }}');
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
						
						// alert("respone from updateTaskCloseDate php " + resp);
						
						if(resp == 'success'){
							//getTasks();
							getSingleTaskData(tID);
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("post","/api/tasks/updateCloseDate", true);	
				
				xmlhttp.send(formData);
	        // } // if confirm
        }

        /***********************************************************************/
        

        $("#deletetaskLink").click( function(e) {
            if(!confirm("Are you sure you want to delete this task?"))
                e.preventDefault();
        });

        
        /***********************************************************************/

        function showtaskNotes(notes) {

            //alert(taskNotes);
	
            $("#taskNotesTableBody").html("");
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
                    
                    noteRows += "<td width='25'><a href='javascript:updatetaskNote(" + notes[i].id + ")' id='notetaskEditLink" + notes[i].id + "'>remove</a></td>";

                    noteRows += "</tr>";
                }

                $("#noteCount").html(notes.length);
                $("#taskNotesTableBody").append(noteRows);
        }
        /***********************************************************************/
        function noteOnFocus(id) {
            // alert("onfocus");
            
            $("#notetaskEditLink" + id).html("save");
        }
        /***********************************************************************/
        function updatetaskNote(id) {

            if($("#notetaskEditLink" + id).html() == "remove") {
                removeNote(id, refreshNotedFortask);
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
                                refreshNotedFortask(id);
                            
                            } else {
                                alert(resp);
                            }
                        } //end if
                    } // end  function
        
                    xmlhttp.open("post","api/notes/update", true);	
                    xmlhttp.send(formData);

                    $("#notetaskEditLink" + id).html("remove");
            }
        }

        /***********************************************************************/

        function refreshNotedFortask() {
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSingleTaskData(selectedEntityID);

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
                getSingleTaskData(selectedEntityID);

            }, 1000)
        });

        /***********************************************************************/        

        

    </script>
@endsection