<div class="container-fluid">
	<div class="col-lg-12">
	<form action="" id="book-flight">
		<input type="hidden" name="flight_id" value="<?php echo $_GET['id'] ?>">
		<input type="hidden" name="Flight_Number" value="<?php echo rand(1000000000, 9999999999)?>">
		<div class="form-group row" id="qty">
			<div class="col-md-3">
			<label for="" class="control-label">Person/s</label>
			<input type="number" class="form-control text-right" min='1' value="1" id="count" max="1">
			</div>
			<div class="col-md-2">
			<label for="" class="control-label">&nbsp;</label>
			<button class="btn btn-primary btn-block" type="button" id="go">Go</button>
			</div>
			<div class="col-md-2">
			<label for="" class="control-label">&nbsp;</label>
			<button class="btn btn-secondary btn-block" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<div id="row-field" style="display: none">
			<div class="row ">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary btn-sm " >Saves</button>
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
		
	</form>
	</div>
</div>
<script>
	$('#go').click(function(){
		start_load()
		$.ajax({
			url:"get_fields.php?count="+$('#count').val(),
			success:function(resp){
				if(resp){
					$('#row-field').prepend(resp)
					$('#qty').hide()
					$('#row-field').show()
					end_load()
				}
			}

		})
	})
	$('#book-flight').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=book_flight',
			method:"POST",
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1 ){
					$('.modal').modal('hide')
					end_load()
					alert_toast("Flight successfully booked.","success")
					window.open("receipt.php", "_blank");
				}
			}
		})
	})
</script>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>