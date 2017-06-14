	<section class="content">
			<div class="container-fluid">
					<div class="block-header">
							<h2>Pemilu</h2>
					</div>
					<!-- Large modal -->


					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" onclick="addPemilu()">Tambah Pemilu</button>
					</br>
					</br>
					<div class="" id="messages">

					</div>

					<div class="row clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="card">
											<div class="header">
													<h2>
															Pemilu
													</h2>
											</div>

											<div class="body">
													<div class="row clearfix">
															<table class="table table-bordered" id="table_pemilu">
																<thead>
																	<th>NO</th>
																	<th>Pemilu</th>
																	<th>Aktif Sampai</th>
																	<th>Folower Minimal</th>
																	<th>Account Min Twitter</th>
																	<th>Action</th>
																</thead>
																<tbody>

																</tbody>
															</table>
													</div>
											</div>
									</div>
							</div>
					</div>
					<!-- #END# Input -->
			</div>
	</section>


	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Tambah Pemilu</h4>
				</div>
				<div class="modal-body">
					<div class="" id="message">

					</div>
					<form action="#" method="post" id="addPemiluForm">
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="id" id="id" hidden>
								<label for="">Pemilu</label>
								<input type="text" class="form-control" name="pemilu" placeholder="Nama Pemilu" id="pemilu" required>
							</div>
						</div>
						<div class="form-group">
								<div class="form-line">
										<label for="">Aktif Sampai</label>
										<input type="text" class="tanggal form-control" name="aktif" placeholder="Aktif Sampai" id="aktif" required>
								</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<label for="">Minimal Tanggal Akun</label>
								<input type="text" class="tanggal form-control" name="akun_min" placeholder="Minimal tanggal akun" id="akun_min" required>
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<label for="">Folower Minimal</label>
								<input type="text" class="form-control" name="folower_min" placeholder="Folower min" id="follower_min" required>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" onclick="save()" class="btn btn-primary">Send message</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deletePemilu" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <form class="" method="post" id="formdelete">
					<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="">Yakin Hapus data ?</h4>
		      </div>
		      <div class="modal-body">
						<input type="hidden" name="id" id="iddelete">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger" onclick="deletePem()">Delete</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!-- Input -->

	<script type="text/javascript">
	var managetable;
	$(document).ready(function() {
	    managetable=$('#table_pemilu').DataTable( {
					
	        "ajax": '<?php echo base_url('index.php/pemilu/list') ?>'
	    } );

	} );
	var save_method;
	var urlnya;

	function addPemilu(){
	  save_method="add";
	  $("#addPemiluForm")[0].reset();
	};

	function editPemilu(id){
		save_method="edit";
	  var url="<?php echo base_url('index.php/pemilu/edit/') ?>"+id;
	  $.ajax({
	    url:url,
	    type:"GET",
	    dataType:"JSON",
	    success:function(data){
	      $('#id').val(data.id);
	      $('#pemilu').val(data.pemilu);
	      $('#aktif').val(data.tanggal);
	      $('#akun_min').val(data.create_account_min);
	      $('#follower_min').val(data.follower_min_twitter);

	      $('#addModal').modal('show');
	    }
	  })

	}

	function getdelete(id){
	  var url="<?php echo base_url('index.php/pemilu/edit/') ?>"+id;
	  $.ajax({
	    url:url,
	    type:"GET",
	    dataType:"JSON",
	    success:function(data){
	      $('#iddelete').val(data.id);

	      $('#deletePemilu').modal('show');
	    }
	  })

	}

	function deletePem(){
		// $.ajax({
		// 	url:"<?php echo base_url('index.php/pemilu/delete') ?>",
		// 	type:"POST",
		// 	data: $("#formdelete").serialize(),
		// 	dataType:"JSON",
		// 	success:function(response){
				// $("#deletePemilu").modal("hide");
				// $("#messages").html("<button type='button' class='alert alert-danger' data-dismiss='alert' aria-label='Close' >"+
				// response.messages+"<span aria-hidden='true'>&times;</span>"+
				// "</button>");
				// managetable.ajax.reload();
		// 	}
		// })
		$.post( "<?php echo base_url('index.php/pemilu/delete') ?>", $( "#formdelete" ).serialize(),
			function(response){
				$("#deletePemilu").modal("hide");
				$("#messages").html("<button type='button' class='alert alert-danger' data-dismiss='alert' aria-label='Close' >"+
				response.messages+"<span aria-hidden='true'>&times;</span>"+
				"</button>");
				managetable.ajax.reload();
			});
	}

	function save(){
	  if (save_method=="add") {
	    urlnya="<?php echo base_url('index.php/pemilu/input') ?>"
	  }
	  else if (save_method=="edit") {
	      urlnya="<?php echo base_url('index.php/pemilu/update') ?>"
	  }

	  $.ajax({
	    url  : urlnya,
	    type : "POST",
	    data : $("#addPemiluForm").serialize(),
	    dataType : "JSON",
	    success : function(response){
	      //console.log(response.success);
	      if (response.success==true) {
	        $("#addModal").modal("hide");
	        $("#messages").html("<button type='button' class='alert alert-success' data-dismiss='alert' aria-label='Close' >"+
	        response.messages+"<span aria-hidden='true'>&times;</span>"+
	        "</button>");
					managetable.ajax.reload();
	      }
				else {
					$("#addModal").modal("hide");
	        $("#messages").html("<button type='button' class='alert alert-danger' data-dismiss='alert' aria-label='Close' >"+
	        response.messages+"<span aria-hidden='true'>&times;</span>"+
	        "</button>");
				}
	    }
	  });
	}

	</script>
