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
						<h2>Theater</h2>

						<span class="main__title-stat">14,452 Total</span>

						<div class="main__title-wrap">
							<a href="add-theater.php" class="main__title-link main__title-link--wrap">Add Theater</a>

							<select class="filter__select" name="sort" id="filter__sort">
								<option value="0">Date created</option>
								<option value="1">Rating</option>
								<option value="2">Views</option>
							</select>

							<!-- search -->
							<form action="#" class="main__title-form">
								<input type="text" placeholder="Find movie / tv series..">
								<button type="button">
									<i class="ti ti-search"></i>
								</button>
							</form>
							<!-- end search -->
						</div>
					</div>
				</div>
				<!-- end main title -->

				<!-- items -->
				<div class="col-12">
					<div class="catalog catalog--1">
						<table class="catalog__table">
							<thead>
								<tr>
									<th>ID</th>
									<th>TITLE</th>
									<th>RATING</th>
									<th>CATEGORY</th>
									<th>VIEWS</th>
									<th>STATUS</th>
									<th>CRAETED DATE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>
										<div class="catalog__text">11</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">I Dream in Another Language</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.9</div>
									</td>
									<td>
										<div class="catalog__text">Movie</div>
									</td>
									<td>
										<div class="catalog__text">1392</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">05.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">12</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">The Forgotten Road</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.1</div>
									</td>
									<td>
										<div class="catalog__text">Movie</div>
									</td>
									<td>
										<div class="catalog__text">1093</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--red">Hidden</div>
									</td>
									<td>
										<div class="catalog__text">05.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">13</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Whitney</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">6.3</div>
									</td>
									<td>
										<div class="catalog__text">TV Series</div>
									</td>
									<td>
										<div class="catalog__text">723</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">04.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">14</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Red Sky at Night</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">8.4</div>
									</td>
									<td>
										<div class="catalog__text">TV Series</div>
									</td>
									<td>
										<div class="catalog__text">2457</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">04.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								<tr>
									<td>
										<div class="catalog__text">15</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Into the Unknown</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.9</div>
									</td>
									<td>
										<div class="catalog__text">Movie</div>
									</td>
									<td>
										<div class="catalog__text">5092</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">03.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">16</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">The Unseen Journey</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.1</div>
									</td>
									<td>
										<div class="catalog__text">TV Series</div>
									</td>
									<td>
										<div class="catalog__text">2713</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--red">Hidden</div>
									</td>
									<td>
										<div class="catalog__text">03.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">17</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Savage Beauty</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">6.3</div>
									</td>
									<td>
										<div class="catalog__text">Cartoon</div>
									</td>
									<td>
										<div class="catalog__text">901</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">03.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">18</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Endless Horizon</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">8.4</div>
									</td>
									<td>
										<div class="catalog__text">Movie</div>
									</td>
									<td>
										<div class="catalog__text">8430</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">02.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								<tr>
									<td>
										<div class="catalog__text">19</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">The Lost Key</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.9</div>
									</td>
									<td>
										<div class="catalog__text">Movie</div>
									</td>
									<td>
										<div class="catalog__text">818</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--green">Visible</div>
									</td>
									<td>
										<div class="catalog__text">02.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="catalog__text">20</div>
									</td>
									<td>
										<div class="catalog__text"><a href="#">Echoes of Yesterday</a></div>
									</td>
									<td>
										<div class="catalog__text catalog__text--rate">7.1</div>
									</td>
									<td>
										<div class="catalog__text">Anime</div>
									</td>
									<td>
										<div class="catalog__text">1046</div>
									</td>
									<td>
										<div class="catalog__text catalog__text--red">Hidden</div>
									</td>
									<td>
										<div class="catalog__text">01.02.2023</div>
									</td>
									<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="#" class="catalog__btn catalog__btn--view">
												<i class="ti ti-eye"></i>
											</a>
											<a href="add-item.html" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--delete" data-bs-target="#modal-delete">
												<i class="ti ti-trash"></i>
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end items -->

				<!-- paginator -->
				<div class="col-12">
					<div class="main__paginator">
						<!-- amount -->
						<span class="main__paginator-pages">10 of 169</span>
						<!-- end amount -->

						<ul class="main__paginator-list">
							<li>
								<a href="#">
									<i class="ti ti-chevron-left"></i>
									<span>Prev</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>Next</span>
									<i class="ti ti-chevron-right"></i>
								</a>
							</li>
						</ul>

						<ul class="paginator">
							<li class="paginator__item paginator__item--prev">
								<a href="#"><i class="ti ti-chevron-left"></i></a>
							</li>
							<li class="paginator__item"><a href="#">1</a></li>
							<li class="paginator__item paginator__item--active"><a href="#">2</a></li>
							<li class="paginator__item"><a href="#">3</a></li>
							<li class="paginator__item"><a href="#">4</a></li>
							<li class="paginator__item"><span>...</span></li>
							<li class="paginator__item"><a href="#">29</a></li>
							<li class="paginator__item"><a href="#">30</a></li>
							<li class="paginator__item paginator__item--next">
								<a href="#"><i class="ti ti-chevron-right"></i></a>
							</li>
						</ul>
					</div>
				</div>
				<!-- end paginator -->
			</div>
		</div>
	</main>
	<!-- end main content -->

	<!-- status modal -->
	<div class="modal fade" id="modal-status" tabindex="-1" aria-labelledby="modal-status" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Status change</h4>

						<p class="modal__text">Are you sure about immediately change status?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Apply</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end status modal -->

	<!-- delete modal -->
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal__content">
					<form action="#" class="modal__form">
						<h4 class="modal__title">Item delete</h4>

						<p class="modal__text">Are you sure to permanently delete this item?</p>

						<div class="modal__btns">
							<button class="modal__btn modal__btn--apply" type="button"><span>Delete</span></button>
							<button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Dismiss</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end delete modal -->

	<!-- JS -->
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/slimselect.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/admin.js"></script>
</body>

<!-- Mirrored from hotflix.volkovdesign.com/admin/catalog.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Aug 2024 08:51:42 GMT -->
</html>