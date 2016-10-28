<div class="col-xs-12" >
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-12">
				<div id="receive">
    	<div style="overflow-x:auto;">
	<table class="table table-responsive">
		<caption>System Members</caption>
		<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email Address</th>
				<th>Username</th>
				<th>Password</th>
				<th>Registration Time</th>
				<th>Activated</th>
				<th>Image</th>
			</tr>
			
		</thead>
		<tbody>
			<?php foreach ($user as $usr) { ?>
				<tr>
					<td><?=$usr->firstname?></td>
					<td><?=$usr->lastname?></td>
					<td><?=$usr->email?></td>
					<td><?=$usr->username?></td>
					<td><?=$usr->password?></td>
					<td><?=$usr->reg_time?></td>
					<td><?=$usr->activated?></td>
					<td><?=$usr->image?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
	</div><br/>
	<button type="submit" class="btn btn-success" value="Edit/Delete" id="eddelu">Edit/Delete &nbsp;<i class="glyphicon glyphicon-edit"></i></button>
			<p id="show"></p>
			<!--Button to display the forms -->
	      	<div id="eddel" style="display: none;">
	      		<form>
	      			<caption>User ID</caption>
	      			<div class="form-group">
	      				<input type="text" name="userid" id="userid" class="form-control"/>
	      			</div>
	      			<div class="form-group">
	      				<button type="submit" class="btn btn-success" value="Edit" id="edit">Edit &nbsp;<i class="glyphicon glyphicon-edit"></i></button>
	      				<button type="submit" class="btn btn-danger" value="Delete" id="delete">Delete &nbsp;<i class="glyphicon glyphicon-remove"></i></button>
	      				<button type="submit" class="btn btn-info" value="Cancel" id="hide">Cancel</button>
	      			</div>
	      		</form>
			</div><br/>
			
			<!-- Edit question form -->
			<div id="edits" style="display: none;">
				<form>
					<caption>Edit user details below:</caption>
					<div class="form-group">
						<label for="userid"> User ID</label>
						<input type="text" name="edituserid" id="edituserid" class="form-control" readonly />
					</div>
					<div class="form-group">
						<label for="firstname"> Firstname </label>
						<input type="text" name="editfirstname" id="editfirstname" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="lastname"> Lastname</label>
						<input type="text" name="editlastname" id="editlastname" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="username"> Username</label>
						<input type="text" name="editusername" id="editusername" class="form-control"/>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" value="Update" id="update">Update &nbsp;<i class="glyphicon glyphicon-plus"></i></button>
						<button type="submit" class="btn btn-info" value="Cancel" id="cancel">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	  </div>	
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
<script type="text/javascript">

//delete user
$(document).ready(function() {
  
    $("#delete").click(function(event) {
  event.preventDefault();
    var userid = $("input#userid").val();
    jQuery.ajax({ 
                method: "GET",
                url: "<?php echo site_url('Dashboard/delete'); ?>",
                dataType: 'JSON',
                data: {userid: userid},
  success: function(data) {
    $("#receive").load(location.href + " #receive");
    $("#show").html(userid + " has been deleted");
    $("#show").show().fadeOut(3000);
  }
  }); 
 });
});

//edit user
$(document).ready(function() {
    $("#edit").click(function(event) {
  event.preventDefault();
    var userid = $("input#userid").val();
    jQuery.ajax({
                 method: "GET",
                 url: "<?php echo site_url('Dashboard/edit'); ?>",
                 dataType: 'JSON',
                 data: {userid: userid},
    success: function(data) {
        $.each(data,function(
    userID, 
    firstname,  
    lastname, 
    username)  {
       $("#edits").show();
       $("input#edituserid").val(userid);
       $("input#editfirstname").val(firstname[0]); 
       $("input#editlastname").val(firstname[1]);
       $("input#editusername").val(firstname[2]);
     });
    }        
  });
 });
});

//update
$(document).ready(function() {
    $("#update").click(function(event) {
    event.preventDefault();
    var edituserid = $("input#edituserid").val();
    var editfirstname = $("input#editfirstname").val();
    var editlastname = $("input#editlastname").val();
    var editusername = $("input#editusername").val();
    $.ajax({
            method: "POST",
            url: "<?php echo site_url('Dashboard/edit'); ?>",
            dataType: 'JSON',
            data: {
        edituserid: edituserid, 
        editfirstname: editfirstname,
        editlastname: editlastname, 
        editusername: editusername
        },
  success: function(data) {
        $("#receive").load(location.href + " #receive");
        $("#edits").hide();
      $("#show").html("User " + edituserid + " has been updated");
      $("#show").show().fadeOut(3000);
   }
  });
 });
});

$(document).ready(function() {
    $("#cancel").click(function(event) {
    event.preventDefault();
    $.ajax({
         success: function(html) {
           $("#edits").hide();
   }
  });
 });
});

$(document).ready(function() {
    $("#eddelu").click(function(event) {
    event.preventDefault();
    $.ajax({
          success: function(html) {
            $("#eddel").show();
   }
  });
 });
});

$(document).ready(function() {
    $("#hide").click(function(event) {
    event.preventDefault();
    $.ajax({
          success: function(html) {
             $("#eddel").hide();
   }
  });
 });
});
</script>  