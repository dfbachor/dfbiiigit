<!-- Note Modal Popup ---------------------------------------------
this window will not show until requested from the edit note link item -->

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="noteEntityName">Add Note</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="noteForm"> 
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="noteTextarea" class="control-label col-sm-2">Note:</label> 
                        <div class="col-sm-10">
                            <textarea id='noteTextarea' rows='4' cols='55' maxlength='1056' onkeydown="if (event.keyCode == 13) document.getElementById('noteSubmit').click()"></textarea>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="noteImageFileName" class="control-label col-sm-2">Image File Name:</label> 
                        <div class="col-sm-10">	
                            <input class="form-control" type="file" id="noteImageFileName" name="noteImageFileName" placeholder="Image File Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="publish" class="control-label col-sm-2">Publish:<strong style="color:darkred;">*</strong></label>
                        <div class="col-sm-10">	
                            <select class="form-control" id="publish" name="publish">
                                <option value="No">No</option>
                                <option value="Followers">Followers</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                    </div>
                </form>				
            </div>

            <div class="modal-footer">
                    <br>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="noteSubmit" class="btn btn-primary" onclick="saveNote()">Save Note</button>
            </div>
        </div>
  </div>
</div>
@include('imageModel')

<script>

        //  $(document).on('show.bs.modal', '.modal', function () {
        //      alert("model");
        //  });


        function saveNote() {

            var formData = new FormData();	

            var imageFile = document.getElementById("noteImageFileName").files[0];

            if(imageFile)
                formData.append('noteImageFileName', imageFile, imageFile.name);
    
            formData.append('entityID', selectedEntityID); // needs to be set by the entiry
            formData.append('note', $("#noteTextarea").val());
            formData.append('publish', $("#publish").val());
            formData.append('systemID', {{ app('system')->id }});
            formData.append('editingUserID', '{{ Auth::user()->id }}');
            formData.append('entityType', selectedEntityType);
            formData.append('imageFileName', '{{ app('system')->imageFileName }}');
            formData.append('_token', '{{ csrf_token() }}');
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText; // return values go here
                        
                        // alert("respone from saveNote php: " + resp);
                        
                        if(resp == "success"){
                            $('#noteTextarea').val("");
                            $('#publish').val("No");
                            $('#noteModal').modal('hide');
                            // getUserNotes(currentUser[0].ID);
    
                        } else {
                            alert(resp);
                        }
                    } //end if
                } // end  function
        
            xmlhttp.open("post", "/api/notes", false);

            xmlhttp.send(formData); 
        }

        function getNotes(entityID, entityType, callback) {

            //alert(entityID + " " + entityType);            

            var formData = new FormData();	

            formData.append('entityID', entityID);
            formData.append('entityType', entityType);
            formData.append('systemID', {{ app('system')->id }});

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText; // return values go here
                        
                        // alert("respone from getNotes php " + resp);
                        
                        if(resp != 0){
                            resp = $.parseJSON(resp);
                            callback(resp);
                        
                        } else {// no results
                            //$("#userNotesTitle").html("User Notes (0)");
                            //$("#userNotesTableBody").html("");
                            // alert(resp);
                        }
                    } //end if
                } // end  function
            
            xmlhttp.open("post","/api/notes/get", true);	 // false to make it syncronous
            
            xmlhttp.send(formData);
            
        }
        

        function showNoteImage(id, note, imageName) {
            $("#showImage").modal('show');
            $("#imagePopupImage").attr('src', imageName + "?ghost=" + Math.random()); // set the image popup
            $("#imagePopupName").html("ID " + id + "<br>");
            $("#imagePopupFooterArea").html(note);
        }

        function removeNote(noteID, callback) {
            if(confirm("Are you sure you want to delete this note?")) {

                var formData = new FormData();	

                formData.append('id', noteID);
                //formData.append('imageFileName', noteImageName);
                formData.append('systemID', {{ app('system')->id }});
                formData.append('_token', '{{ csrf_token() }}');
                
                var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                var resp = xmlhttp.responseText; // return values go here
                                
                                // alert("respone from remove note php " + resp);
                                
                                if(resp == "success"){
                                    callback();
                                
                                } else {
                                    alert(resp);
                                }
                            } //end if
                        } // end  function
            
                        xmlhttp.open("post","api/notes/delete", true);	
                        xmlhttp.send(formData);
            }
        }
        
        function updateNote(id ) { // not operational yet

            var formData = new FormData();	

            formData.append('note', $("#noteTextarea").val());
            formData.append('systemID', {{ app('system')->id }});
            formData.append('editingUserID', '{{ Auth::user()->id }}');
            formData.append('imageFileName', '{{ app('system')->imageFileName }}');
            formData.append('_token', '{{ csrf_token() }}');
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText; // return values go here
                        
                        alert("respone from updateNote php: " + resp);
                        
                        if(resp == "success"){
                            $('#noteTextarea').val("");
                            $('#publish').val("No");
                            $('#noteModal').modal('hide');
                            // getUserNotes(currentUser[0].ID);
    
                        } else {
                            alert(resp);
                        }
                    } //end if
                } // end  function
        
            xmlhttp.open("post", "/api/notes/update", false);

            xmlhttp.send(formData); 
        }


</script>
<!--  end  Note Modal Popup -->