<!DOCTYPE html>
<html>
<head>
<?php include_once('head.php') ?>
</head>
<body>
<?php include_once('navigation.php') ?>
<div class="container theme-showcase" role="main">
		<div class="spinner-feeds" style="text-align: center; margin-top: 200px;"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
		<div class="error-feeds alert alert-danger" style="display:none;margin: 0px;">Sorry seems like we are having some problems displaying the chat!!!</div>	
		<div class="panel panel-default" id="chat-window" style="display:none;">
		</div>

<div class="container content">
	<!-- Page Heading -->
    <div class="row">
        <div class="col-12">
    
            <table class="table stripe table display" id="mydata">
                <thead>
                    <tr> 
                        <th>Menu Name</th>
                        <th>Customer Name</th>
                        <th>Table No.</th>
                        <th>Order Qty</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
        </div>
    </div>
        
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/js/moment.min.js"></script>
	<script src="http://www.illengan.com:3000/socket.io/socket.io.js"></script>
<script>
if(typeof io=="undefined")
	{
		$('.spinner-feeds').hide();
		$('#chat-window').hide();
		$('.error-feeds').show();
	}
	else
	{
		var socket = io.connect('http://www.www.illengan.com:3000');
		var chefpage=socket.of('/chefpage')
			.on('connect_failed', function (reason) {
			$('.spinner-feeds').hide();
			$('#chat-window').hide();
			$('.error-feeds').show();
			console.error('unable to connect chefpage to namespace', reason);
			})
			.on('error',function(reason){
			//alert("in error func");
			$('.spinner-feeds').hide();
			$('#chat-window').hide();
			$('.error-feeds').show();
			$('#chat-window').html('');
			console.error('unable to connect chefpage to namespace', reason);
			})
			.on('reconnect_failed',function(){
			alert("in reconnect fail func");
			$('.spinner-feeds').hide();
			$('#chat-window').hide();
			$('.error-feeds').show();
			$('#chat-window').html('');
			})
			.on('connect', function () {
			console.info('sucessfully established a connection of chefpage with the namespace');
			chefpage.emit('senddata');
			});
		
		chefpage.on('chefdata',function(data){
			$('.error-feeds').hide();
			$('.spinner-feeds').hide();
			$('#chat-window').html('');
			$('#chat-window').show();
			var header='';
			var content='';
			var footer='';
			
			var cells='';
			if(data.orderdata)
			{
				for(n in data.orderdata)
				{
					console.log(data.orderdata[n].custName);
				}
			}
			
		});	
		// chefpage.on('showcomment',function(data){
		// 	$('#chat_block_list').append('<li class="media"><div class="media-body"><h4 class="media-heading">'+data.room_comment[0].username+'</h4><p>'+data.room_comment[0].comment+'</p></div></li>');
		// 	$('#msg_box').val('');
		// });

		// chefpage.on('removeuser',function(data){
		// 	$('#online-list span').each(function(index){
		// 		var user_id=$(this).find('.userId').val();
		// 		if(user_id==data.user_id)
		// 		{
		// 			$(this).remove();
		// 		}
		// 	});	
		// });
		// $('body').on("keypress",'#msg_box', function(e) {	
		// if (e.which == 13) {
		// 	$(this).blur();
		// 	var message = $(this).val();
		// 	if(message)
		// 	{
		// 		sendChat(message);
		// 	}
		// 	return false; // prevent the button click from happening
		// }
		// });	
		// $('body').on("click",'#msg_send', function(e) {	
		// 	var message = $('#msg_box').val();
		// 	if(message)
		// 	{
		// 		sendChat(message);
		// 	}
		// });
		// function sendChat(message)	
		// {
		// 	//var curr_date= moment().format("YYYY-MM-DDTHH:mm:ss.SSSZZ");
		// 	chefpage.emit('sendcomment', {msg:message,user_id:user_id,room_id:room_id});
		// }
	}
	function confirmExit()
	{
	 alert("exiting");
	 window.location.href='<? echo base_url();?>index.php';
	 return true;
	}
	window.onbeforeunload = confirmExit;

</script>

</body>
</html>