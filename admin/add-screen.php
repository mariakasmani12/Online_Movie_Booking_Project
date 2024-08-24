<?php
include("admin-layouts/header.php");
?>
	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
			<div class="row">
				<!-- main title -->
				<div class="col-12">
					<div class="main__title">
						<h2>Add screen</h2>
					</div>
				</div>
				<!-- end main title -->

				<!-- form -->
				<div class="col-12">
					<form action="#" class="sign__form sign__form--add">
						<div class="row">
							<div class="col-12 col-xl-7">
								<div class="row">
									

									<div class="col-12">
										<div class="sign__group">
											<select class="sign__selectjs" id="sign__genre" multiple>
												<option value="Action">Action</option>
												<option value="Animation">Animation</option>
												<option value="Comedy">Comedy</option>
												<option value="Crime">Crime</option>
												<option value="Drama">Drama</option>
												<option value="Fantasy">Fantasy</option>
												<option value="Historical">Historical</option>
												<option value="Horror">Horror</option>
												<option value="Romance">Romance</option>
												<option value="Science-fiction">Science-fiction</option>
												<option value="Thriller">Thriller</option>
												<option value="Western">Western</option>
												<option value="Otheer">Otheer</option>
											</select>
										</div>
									</div>

									<div class="col-12 col-md-6 col-xl-4">
								<div class="sign__group">
									<select class="sign__selectjs" id="sign__director" multiple>
										<option value="Matt Jones">Matt Jones</option>
										<option value="Gene Graham">Gene Graham</option>
										<option value="Rosa Lee">Rosa Lee</option>
										<option value="Brian Cranston">Brian Cranston</option>
										<option value="Tess Harper">Tess Harper</option>
										<option value="Eliza Josceline">Eliza Josceline</option>
										<option value="Otto Bree">Otto Bree</option>
										<option value="Kathie Corl">Kathie Corl</option>
										<option value="Georgiana Patti">Georgiana Patti</option>
										<option value="Cong Duong">Cong Duong</option>
										<option value="Felix Autumn">Felix Autumn</option>
										<option value="Sophie Moore">Sophie Moore</option>
									</select>
								</div>
							</div>
									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Running time">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<div class="sign__group">
											<input type="text" class="sign__input" placeholder="Premiere date">
										</div>
									</div>

								</div>
							</div>

							
								

							<div class="col-12">
								<button type="button" class="sign__btn sign__btn--small"><span>Publish</span></button>
							</div>
						</div>
					</form>
				</div>
				<!-- end form -->
			</div>
		</div>
	</main>
	<!-- end main content -->

	<!-- JS -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/slimselect.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/admin.js"></script>
</body>

<!-- Mirrored from hotflix.volkovdesign.com/admin/add-item.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:51:43 GMT -->
</html>