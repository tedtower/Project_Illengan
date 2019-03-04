<html>
<head>
<title>Realtime Notification using Socket.IO in Codeigniter</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
h3{
font-family: Verdana;
font-size: 18pt;
font-style: normal;
font-weight: bold;
color:red;
text-align: center;
}
 
</style>
<h3>Realtime Notification using Socket.IO in Codeigniter</h3>
 
<?php echo form_open('message/send',array('name'=>'message','method'=>'post')); ?>
 
<div class="container">
<divstyle="float:right;"><p><h4>Messages: <b><spanid="msgcount"></span></b></h4></p></div>
<divclass="col-md-3">
<p><inputtype="text"placeholder="Type Here..."class="form-control"size="20px"id="message"name="message" /></p>
</div>
<divclass="col-md-3"><inputtype="button"class="btn btn-primary"id="send"name="send"value="Send"/></div>
<divclass="col-md-3"></div>
<divclass="col-md-3"></div>
<tableclass="table">
<thead>
<tr>
<th>Date</th>
<th>Message</th>
</tr>
</thead>
<tbody id="message-tbody">
<?php foreach($allMsgs as $row){ ?>
<tr><td><?php echo $row['date']; ?></td><td><?php echo $row['msg']; ?></td></tr>
<?php } ?>
</tbody>
</table>
</div>
 
<?php echo form_close();?>
 
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/chef/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
<script>
$(document).ready(function(){
$(document).on("click","#send",function() {
var dataString = {
message : $("#message").val()
};
 
$.ajax({
type: "POST",
url: "<?php echo base_url('message/send');?>",
data: dataString,
dataType: "json",
cache : false,
success: function(data){
 
if(data.success ==true){
var socket = io.connect( 'http://'+window.location.hostname+':3000' );
socket.emit('new_message', {
message: data.message,
date: data.date,
msgcount: data.msgcount
});
}
} ,error: function(xhr, status, error) {
alert(error);
},
});
});
});
var socket = io.connect( 'http://'+window.location.hostname+':3000' );
socket.on( 'new_message', function( data ) {
$("#message-tbody").prepend('<tr><td>'+data.date+'</td><td>'+data.message+'</td></tr>');
$("#msgcount").text(data.msgcount);
});
</script>
</body>
</html>