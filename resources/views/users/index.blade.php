@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-dataTables.css') }}">
@endsection

@section('content')
    <!-- USER MENU -------------------------------------------------------------- -->
    <div class="container-fluid entityContainer">
        <div class="container col-sm-7">
            <div class="row">
                <div class="panel panel-default panel-success">
                    <div class="panel-heading" style="height: 50px; padding: 5px">
                
                            <div class="col-sm-9" style="height: 50px;">
                                <span class='dataTableHeaderTitle' id='userTitle'>Users <span id='userCount' class="badge"></span></span>
                            </div>
                            <div class="col-sm-3" style="height: 50px;">
                                <a href='/users/create' id='userAdduser'>Add User</a>
                        </div>

                    </div>
                    <table id="datatable" class="table table-bordered table-striped table-hover table-condensedv" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>	

        <!-- User DETAIL -->
        <div class="container col-sm-5">
            <div class="row">
                <div class="panel panel-default panel-success">
                    <div class="panel-heading col-sm-2" style="height: 50px; padding: 1px">
                        <a href='#' id="userPhotoAnchor">					            	
                            <img class="companyLogo" id="userPhoto" src="/image/{{app('system')->imageFileName}}" height='48' width='48' />
                        </a> 
                    </div>
                    <div class="panel-heading col-sm-8" style="height: 50px;">
                        <h4 id='usersDetailTitle'>User Detail</h4> 
                    </div>
                    <div class="panel-heading col-sm-2" style="height: 50px;">
                        <span id='editUserLink'></span> 
                        <span class='admin' id='deleteUserLink'></span> 
                    </div>
                </div>        
            </div>
            <div class="row">
                <div class="container col-sm-12" style="padding: 2px;">
                    <div class="panel-group" id="userAccordion" style="width: 100%;">
                        
                        <div class="panel panel-default panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" 
                                        data-parent="#userAccordion" href="#userCollapse1">User Information</a>
                                </h4>
                            </div>
                            <div id="userCollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div id='userDetail'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-default panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a id="userNotesTitle" class="accordion-toggle" data-toggle="collapse"
                                                data-parent="#userAccordion" href="#userCollapse2">User Notes <span id='noteCount' class="badge"></span></a>
                                </h4>
                            </div>
                            <div id="userCollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p><a href='#' data-toggle="modal" data-target="#noteModal">
                                        Add Note
                                    </a></p>
                                    <div id='userNotesListing'>
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
                                            <table id="userNotesTable">
                                                <tbody id="userNotesTableBody">

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
                                <a id="userAboutTitle" class="accordion-toggle" data-toggle="collapse" 
                                                    data-parent="#userAccordion" href="#userCollapse3">About</a>
                                </h4>
                            </div>
                            
                            <div id="userCollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="seedBullet">
                                        <li>
                                            A User is a person that can utilize this application.							        					</li>
                                        <li>
                                            A User can have an Administrator role or a User role.							        					</li>
                                        <li>
                                            When a grow operation is registered, the initial User is setup as an Administrator
                                        </li>
                                        <li>
                                            An Administrator will have access to all menus and features while a User will have limited access.  Currently, Administrators can access the Settings menu and the Users menu.
                                        </li>
                                        <li>
                                            To add a new User, click on the<a href='#' id='userAdduser' data-toggle="modal" data-target="#userModal"> Add User </a>link at the top of the User list.
                                        </li>
                                        <li>
                                            You can upload a photo for each user.  This works great from a tablet where you can take the picture at the time of entry.  A default photo (or the system logo setup in the Settings Menu) will display in the event a photo was not added. 
                                        </li>
                                        <li>
                                            Clicking on the Users photo will show the photo in a pop-up window for better visibility.
                                        </li>
                                        <li>
                                            To edit a User, select the User from the list on the left, click the Edit link will appear at the top of the User Information section. 
                                        </li>
                                        <li>
                                            To delete a User, select the User from the list on the left, click the User link at the top of the User Information section. 
                                        </li>
                                        <li>
                                            The User Information section displays all of the details for the selected User. 
                                        </li>
                                        <li>
                                            The User Notes section enables you to enter in notes for the User.
                                        </li>
                                        <li>
                                            Only a User with Administrator role can access the User Menu.
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
    <script type="text/javascript">
        //global
        var selectedEntityID = null; 
        var selectedEntityType = "user"; 

        $(document).on('show.bs.modal', '.modal', function () {
            $(this).find('form').trigger('reset');
        });

        $('#userPhotoAnchor').on('click', function() {
            //function showUserImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', $('#userPhoto').attr('src') + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html("ID " + selectedEntityID);
                $("#imagePopupFooterArea").html($('#usersDetailTitle').html());
            //}
        });
        
        $(document).ready( function () {
            
            var table = $('#datatable');
            
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.users.index') }}",
                    "type": "post",
                    "data": {
                        "systemID": {{ app('system')->id }}
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "username" },
                    { "data": "email" },
                    { "data": "role" }
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
                $("#userCount").html($('#datatable').DataTable().data().count());	
                $('#datatable tbody tr:eq(0)').click();
            
            }, 500); 
                        

        });
        /***********************************************************************/
        $('#datatable tbody').on('click', 'tr', function() {
                        
            selectedEntityID = $(this).find('td').html();
            getSingleUserData(selectedEntityID);

            $('#datatable tr').removeClass('selected'); // de-highlight all in the table
            $(this).addClass('selected'); // highlight the select row - the row displayed in the use info section
        });
        /***********************************************************************/
        function getSingleUserData(userID) {
            if(userID) {
                getSingleUserDetail(userID);
                $("#userNotesTableBody").html("");
               var notes = getNotes(userID, "user", showUserNotes); // getNotes is from notes.model
        
            } else {

            }
        }
        /***********************************************************************/

        function getSingleUserDetail (userID) {
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						var resp = xmlhttp.responseText; // return values go here
						//alert(resp);
                        
						if(resp != 0){
							resp = $.parseJSON(resp);
							showUserDetail(resp);
						
						} else {
							alert(resp);
						}
					} //end if
				} // end  function
	
				xmlhttp.open("GET","/api/users/" + userID, false);
				xmlhttp.send();
        }
        /***********************************************************************/

        function showUserDetail(user) {
            // somewhat of a hack since the user array passed in
            // has an integer string ("3") value as its key and we dont
            // always know what is is - but we should only
            // always have just one object 
            var key = Object.keys(user)[0];
            //alert(user[key].name);

            var myUser = user[key].name + " " + "<br>";
                $("#imagePopupName").html(myUser);
                $("#usersDetailTitle").html(myUser);

                var userImg;
                if(user[key].imageFileName == null)
                    userImg = '/image/' + "{{app('system')->imageFileName}}";
                else 
                    userImg = '/image/' + user[key].imageFileName;
               
                $("#userPhoto").attr('src', userImg + "?ghost=" + Math.random());
                            
                var myTable	= "<table class='table table-bordered table-condensed' >";
                    //myTable	+= "<tr>";
                        myTable	+= "<col class='col-sm-6'>";
                        myTable	+= "<col class='col-sm-6'>";

                    myTable	+= "<tr>";
                        myTable	+= "<th>User name</th>";
                        myTable	+= "<td id='usernameTD'>" + user[key].username + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Name</th>";
                        myTable	+= "<td>" + user[key].name + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Role</th>";
                            if(user[key].role == 'u') 
                                urole = "User";
                            else if(user[key].role == 'a') 
                                urole = "Admin";
                        myTable	+= "<td>" + urole + "</td>";
                    myTable	+= "</tr>";
                    myTable	+= "<tr>";
                        myTable	+= "<th>Email Address</th>";
                        myTable	+= "<td>" + user[key].email + "</td>";
                    myTable	+= "</tr>";

                myTable	+= "</table>";  
            
            $("#userDetail").html(myTable);
            $("#editUserLink").html("<a href='/users/edit/" + user[key].id + "'>edit</a>");
            $("#deleteUserLink").html("<a href='/users/destroy/" + user[key].id + "'>delete</a>");
            
            $("#usernameTD").focus();
        } // end showUserDetail

        /***********************************************************************/


        $("#deleteUserLink").click( function(e) {
            if(!confirm("Are you sure you want to delete this user?"))
                e.preventDefault();
        });

        
        /***********************************************************************/

        function showUserNotes(notes) {

            //alert(userNotes);
	
            $("#userNotesTableBody").html("");
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
                                    var imageFileName = '{{app('system')->imageFileName}}';
                                else
                                    var imageFileName = notes[i].imageFileName;
                                
                                noteRows += "<img width='30' hieght='30' src='/image/" + imageFileName + "' alt=''>";
                            noteRows += "</a>";
                        noteRows += "</td>";
                    }
                    
                    noteRows += "<td width='25'><a href='javascript:updateUserNote(" + notes[i].id + ")' id='noteUserEditLink" + notes[i].id + "'>remove</a></td>";

                    noteRows += "</tr>";
                }

                $("#noteCount").html(notes.length);
                $("#userNotesTableBody").append(noteRows);
        }
        /***********************************************************************/
        function noteOnFocus(id) {
            // alert("onfocus");
            
            $("#noteUserEditLink" + id).html("save");
        }
        /***********************************************************************/
        function updateUserNote(id) {

            if($("#noteUserEditLink" + id).html() == "remove") {
                removeNote(id, refreshNotedForUser);
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
                                refreshNotedForUser(id);
                            
                            } else {
                                alert(resp);
                            }
                        } //end if
                    } // end  function
        
                    xmlhttp.open("post","api/notes/update", true);	
                    xmlhttp.send(formData);

                    $("#noteUserEditLink" + id).html("remove");
            }
        }

        /***********************************************************************/

        function refreshNotedForUser() {
            setTimeout(function() {
                selectedEntityID = $('.selected').find('td').html();
                getSingleUserData(selectedEntityID);

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
                getSingleUserData(selectedEntityID);

            }, 1000)
        });

        /***********************************************************************/        


    </script>
@endsection

