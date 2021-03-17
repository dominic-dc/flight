<hr>
<div class="row">
	<div class="form-group col-md-12">
		<label class="control-label">Passenger Name</label>
		<input type="text" name="name[]" class="form-control">
	</div>
	<div class="col-md-6">
		<label class="control-label">Contact Number</label>
		<input type="text" name="contact[]" class="form-control">
	</div>
	
	<div class="col-md-6">
		<label class="control-label">Number Of Guest</label>
		<input type="number" name="guest[]" class="form-control">
	</div>
</div>

<!-- <div class="row">
</div> -->

<div class="row">
	<div class="form-group col-md-12">
		<label class="control-label">Address</label>
		<textarea name="address[]" id="" cols="30" rows="2" class="form-control"></textarea>	
	</div>
</div>
<?php for ($i = 0; $i < $_GET['count'] - 1; $i++) : ?>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<label class="control-label">Guest Name</label>
			<input type="text" name="name[]" class="form-control">
		</div>
		<div class="col-md-6">
			<label class="control-label">Contact Number</label>
			<input type="text" name="contact[]" class="form-control">
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-12">
			<label class="control-label">Address</label>
			<textarea name="address[]" id="" cols="30" rows="2" class="form-control"></textarea>
		</div>
	</div>

<?php endfor; ?>