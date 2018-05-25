@extends('layouts.app')

<?php

    include(realpath(__DIR__) . '/../../../app/dfbLIbrary.php');

?>

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dfb-community.css') }}" />
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Community</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif 

                    <?php $noteCounter = 0 ?>

                    @foreach($notes as $note)
                        <table class="table table-bordered">
                            <tr>
                                <td><img class="communityNoteUserImage img-circle" src="{{$note->userImageFileName}}" />
                                    <small>{{ timeAgo($note->updated_at) }}</small>
                                <br /> 
                                {{ $note->note}} </td>
                            </tr>

                            {{--  note the image if there is one  --}}
                            @if($note->imageFileName != 'img/default.png')
                                <tr style="text-align: center">
                                    <td><img    class="communityNoteImage" 
                                                src="{{$note->imageFileName}}"
                                                alt="{{$note->note}}">
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td style="text-align: center">

                                <?php
                                    if(Auth::user()->id != $note->liked) {
                                            $likeSpan = '<span class="glyphicon glyphicon-thumbs-up"></span> like';
                                            $likeAttr = 'unliked';
                                    } else {
                                            $likeSpan = '<span class="glyphicon glyphicon-thumbs-down"></span> unlike';
                                            $likeAttr = 'liked';
                                    }
                                ?>
                                    <button liked={{$likeAttr}} class="likeButton" noteliked="{{$note->liked}}" userID="{{Auth::user()->id}}" noteID='{{$note->id}}' type="button" class="btn btn-default btn-sm">
                                        <?= $likeSpan ?>
                                    </button>
                                </td>
                            </tr>

                            <?php
                                // loop thru the comments to the current note
                                $comments = DB::select('select 
                                                            c.*,
                                                            u.imageFileName as userImageFileName
                                                        from 
                                                            comments c,
                                                            users u 
                                                        where 
                                                            c.userID = u.id and
                                                            c.noteID = :id', ['id' => $note->id]);
                            ?>
                            <?php $commentCount = 0; ?>
                            @foreach($comments as $comment)
                                
                                @if((count($comments) - $commentCount++) > 5)
                                    <tr style="display: none">
                                @else
                                    <tr>
                                @endif
                                        <td><img class="communityNoteUserImage img-circle" src="{{$comment->userImageFileName}}" /> {{ $comment->comment }}</td>
                                    </tr>
                            @endforeach

                            <?php $noteCounter++; ?>
                            <tr id='{{$noteCounter . 'noteCounterTR'}}'>
                                <td>
                                    <input type="text" id='{{$noteCounter . 'noteCounterInput'}}' userID="{{Auth::user()->id}}" noteID="{{$note->id}}" class="communityCommentOnThisnote" placeholder="comment on this Note" />
                                </td>
                            </tr>
                        </table>            
                    @endforeach
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('imageModel')

@section('javascripts')

    <script>
        
        $('.likeButton').on('click', function() {
            if($(this).attr('liked') == 'liked')
                unlike(this);
            else
                like(this);
        });
        
        function like(currentLikeButton) {
                
                //alert($(currentLikeButton).attr('noteID'));
                
                var formData = new FormData();	

                formData.append('userID', $(currentLikeButton).attr('userID')); 
                formData.append('noteID', $(currentLikeButton).attr('noteID'));
                // formData.append('_token', '{{ csrf_token() }}');
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText; // return values go here
                        
                        //alert("respone from saveNote php: " + resp);
                        
                        if(resp == "success"){
                            $(currentLikeButton).attr('liked', 'liked');
                            $(currentLikeButton).html('<span class="glyphicon glyphicon-thumbs-down"></span> unlike');
                                                            
                        // getUserNotes(currentUser[0].ID);
                        } else {
                            alert("failure " + resp);
                        }
                    } //end if
                } // end  function
            
                xmlhttp.open("post", "/api/notes/like", true);
                xmlhttp.send(formData);         
        }


         function unlike(currentLikeButton) {
                
                //alert($(currentLikeButton).attr('noteID'));
                // alert($(this).attr('class'));
                // alert($(this).children().attr('class'));
                
                var formData = new FormData();	

                formData.append('userID', $(currentLikeButton).attr('userID')); 
                formData.append('noteID', $(currentLikeButton).attr('noteID'));
                // formData.append('_token', '{{ csrf_token() }}');
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var resp = xmlhttp.responseText; // return values go here
                        
                        //alert("respone from saveNote php: " + resp);
                        
                        if(resp == "success"){
                            $(currentLikeButton).attr('liked', 'unliked');
                            $(currentLikeButton).html('<span class="glyphicon glyphicon-thumbs-up"></span> like');
                            
                        // getUserNotes(currentUser[0].ID);
                        } else {
                            //alert("failure " + resp);
                        }
                    } //end if
                } // end  function
            
                xmlhttp.open("post", "/api/notes/unlike", true);
                xmlhttp.send(formData);        
        }

        $('.communityNoteImage').on('click', function() {
            //function showplantImage(id, note, imageName) {
                $("#showImage").modal('show');
                $("#imagePopupImage").attr('src', this.src + "?ghost=" + Math.random()); // set the image popup
                $("#imagePopupName").html(this.alt);
                // $("#imagePopupFooterArea").html($('#plantsDetailTitle').html());
            //}
        });

        $('.communityCommentOnThisNote').on('keypress', function(e) {
            if(e.which === 13 && $(this).val() != "") {
                // alert($(this).val());
                //alert( $(this).attr('id'));
                var id = $(this).attr('id')
                var comment = $(this).val();

                var formData = new FormData();	
        
                formData.append('userID', $(this).attr('userID')); 
                formData.append('noteID', $(this).attr('noteID'));
                formData.append('comment', $(this).val());
                formData.append('_token', '{{ csrf_token() }}');
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            var resp = xmlhttp.responseText; // return values go here
                            
                            //alert("respone from saveNote php: " + resp);
                            
                            if(resp == "success"){
                                //alert("success " + resp);
                                
                                insertLastComment(id, comment);
                                
                            // getUserNotes(currentUser[0].ID);
                            } else {
                                alert("failure " + resp);
                            }
                        } //end if
                    } // end  function
            
                xmlhttp.open("post", "/api/notes/comment", true);
                xmlhttp.send(formData); 
                $(this).val("");
            } // end if 13
        });

        function insertLastComment(elementID, comment) {

                var noteNumber = parseInt(elementID);
                var tr = "";
            
                tr += "<tr>";
                        tr += "<td><img class='communityNoteUserImage img-circle' src='{{Auth::user()->imageFileName}}' /> " + comment + " </td>";
                        //tr += "<td>test</td>";
                tr += "</tr>";

                $(tr).insertBefore('#' + noteNumber + 'noteCounterTR');

        }
    </script>
@endsection