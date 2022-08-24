@extends('web.layout.app')

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
@section('content')
			<!-- ======================= Home Banner ======================== -->
			<div class="home-banner margin-bottom-0" style="background: url({{ asset('assets/fo/img/Gheader.jpg') }}) no-repeat;" data-overlay="5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12">
						
							{{-- <div class="banner_caption text-center mb-5">
								<h1 class="banner_title ft-bold mb-1"><span class="count">72412</span> jobs Listed Here!</h1>
								<p class="fs-md ft-medium">Your Dream Jobs is Waiting</p>
							</div> --}}
							
							{{-- <form class="bg-white rounded p-1">
								<div class="row no-gutters">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
										<div class="form-group mb-0 position-relative">
											<input type="text" class="form-control lg left-ico" placeholder="Job Title, Keyword or Company" />
											<i class="bnc-ico lni lni-search-alt"></i>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
										<div class="form-group mb-0 position-relative">
											<input type="text" class="form-control lg left-ico" placeholder="Location or Zip Code" />
											<i class="bnc-ico lni lni-target"></i>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
										<div class="form-group mb-0 position-relative">
											<select class="custom-select lg b-0">
											  <option value="1">Choose Categories</option>
											  <option value="2">Information Technology</option>
											  <option value="3">Cloud Computing</option>
											  <option value="4">Engineering Services</option>
											  <option value="5">Healthcare/Pharma</option>
											  <option value="6">Telecom/ Internet</option>
											  <option value="7">Finance/Insurance</option>
											</select>
										</div>
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
										<div class="form-group mb-0 position-relative">
											<button class="btn full-width custom-height-lg theme-bg text-white fs-md" type="button">Find Job</button>
										</div>
									</div>
									
								</div>
							</form> --}}
							
							{{-- <div class="text-center align-items-center justify-content-center mt-5">
								<a href="javascript:void(0);" class="btn bg-white hover-theme ft-regular mr-1"><i class="lni lni-user mr-1"></i>Create Account</a>
								<a href="javascript:void(0);" class="btn bg-dark hover-theme text-light ft-regular ml-1"><i class="lni lni-upload mr-1"></i>Upload Resume</a>
							</div> --}}
							
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Home Banner ======================== -->
			
			<!-- ======================= Job List ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-5">
								<h6 class="text-muted mb-0">Trending Jobs</h6>
								<h2 class="ft-bold">All Popular Listed jobs</h2>
							</div>
						</div>
					</div>
					
					<!-- row -->
					<div class="row align-items-center">
					
						
						
					</div>
					<!-- row -->
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="position-relative text-center">
								<a href="job-search-v1.html" class="btn btn-md theme-bg-light rounded theme-cl hover-theme">Explore More Jobs<i class="lni lni-arrow-right-circle ml-2"></i></a>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Job List ======================== -->
			
			<!-- ======================= All category ======================== -->
			<section class="space gray">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-5">
								<h6 class="text-muted mb-0">Ayo mulai</h6>
								<h2 class="ft-bold tulisan-custom">PILIH JENIS PEMBAYARAN</h2>
							</div>
						</div>
					</div>
					
					<!-- row -->
					<div class="row align-items-center text-center align-content-center" style="justify-content: center;">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="cats-wrap text-center">
                                <a href="{{ url('booking/jadwal?type=lunas') }}" class="cats-box d-block rounded bg-white px-2 py-4">
                                    <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle"><img src="{{ asset('assets/fo/flaticon/money.png') }}" width="100"></div>
                                    <div class="cats-box-caption">
                                        <h2 class="fs-md mb-0 ft-medium m-catrio" style="color: #000000!important;">Lunas</h2>
                                        <span class="text-muted">&nbsp;</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="cats-wrap text-center">
                                <a href="{{ url('booking/jadwal?type=kredit') }}" class="cats-box d-block rounded bg-white px-2 py-4">
                                    <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle"><img src="{{ asset('assets/fo/flaticon/debit-card.png') }}" width="100"></div>
                                    <div class="cats-box-caption">
                                        <h2 class="fs-md mb-0 ft-medium m-catrio" style="color: #000000!important;">Angsuran</h2>
                                        <span class="text-muted">&nbsp;</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                      
						
					</div>
					<!-- /row -->
					
					{{-- <div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="position-relative text-center">
								<a href="browse-category.html" class="btn btn-md bg-dark rounded text-light hover-theme">Browse All Categories<i class="lni lni-arrow-right-circle ml-2"></i></a>
							</div>
						</div>
					</div> --}}
					
				</div>
			</section>
			<!-- ======================= All category ======================== -->
			
			<!-- ======================= About Start ============================ -->
			<section class="space">
				<div class="container">
					
					<div class="row align-items-center justify-content-between">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
							<div class="m-spaced">
								<div class="position-relative">
									<div class="mb-1"><span class="theme-bg-light theme-cl px-2 py-1 rounded">About Us</span></div>
									<h2 class="ft-bold mb-3">Create and Build Your<br>Attractive Profile</h2>
									<p class="mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
									<p class="mb-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. </p>
								</div>
								<div class="position-relative row">
									<div class="col-lg-4 col-md-4 col-4">
										<h3 class="ft-bold theme-cl mb-0">10k+</h3>
										<p class="ft-medium">Active Jobs</p>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<h3 class="ft-bold theme-cl mb-0">12k+</h3>
										<p class="ft-medium">Resumes</p>
									</div>
									<div class="col-lg-4 col-md-4 col-4">
										<h3 class="ft-bold theme-cl mb-0">07k+</h3>
										<p class="ft-medium">Employers</p>
									</div>
									<div class="col-lg-12 col-md-12 col-12 mt-3">
										<a href="javascript:void(0);" class="btn btn-md theme-bg-light rounded theme-cl hover-theme">See Details<i class="lni lni-arrow-right-circle ml-2"></i></a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
							<div class="position-relative">
								<img src="https://via.placeholder.com/900x1000" class="img-fluid" alt="" />
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= About Start ============================ -->
			

			<!-- ============================ Pricing End ==================================== -->
			
			<!-- ======================= Blog Start ============================ -->
			<section class="space min gray">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-4">
								<h6 class="text-muted mb-0">Latest News</h6>
								<h2 class="ft-bold">Pickup New Updates</h2>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-center">
						
						<!-- Single Item -->
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="blg_grid_box">
								<div class="blg_grid_thumb">
									<a href="blog-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid" alt=""></a>
								</div>
								<div class="blg_grid_caption">
									<div class="blg_tag"><span>Marketing</span></div>
									<div class="blg_title"><h4><a href="blog-detail.html">How To Register &amp; Enrolled on SkillUp Step by Step?</a></h4></div>
									<div class="blg_desc"><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum</p></div>
								</div>
								<div class="crs_grid_foot">
									<div class="crs_flex d-flex align-items-center justify-content-between br-top px-3 py-2">
										<div class="crs_fl_first">
											<div class="crs_tutor">
												<div class="crs_tutor_thumb"><a href="instructor-detail.html"><img src="https://via.placeholder.com/500x500" class="img-fluid circle" width="35" alt=""></a></div>
											</div>
										</div>
										<div class="crs_fl_last">
											<div class="foot_list_info">
												<ul>
													<li><div class="elsio_ic"><i class="fa fa-eye text-success"></i></div><div class="elsio_tx">10k Views</div></li>
													<li><div class="elsio_ic"><i class="fa fa-clock text-warning"></i></div><div class="elsio_tx">10 July 2021</div></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Item -->
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="blg_grid_box">
								<div class="blg_grid_thumb">
									<a href="blog-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid" alt=""></a>
								</div>
								<div class="blg_grid_caption">
									<div class="blg_tag"><span>Business</span></div>
									<div class="blg_title"><h4><a href="blog-detail.html">Let's Know How Skillup Work Fast and Secure?</a></h4></div>
									<div class="blg_desc"><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum</p></div>
								</div>
								<div class="crs_grid_foot">
									<div class="crs_flex d-flex align-items-center justify-content-between br-top px-3 py-2">
										<div class="crs_fl_first">
											<div class="crs_tutor">
												<div class="crs_tutor_thumb"><a href="instructor-detail.html"><img src="https://via.placeholder.com/500x500" class="img-fluid circle" width="35" alt=""></a></div>
											</div>
										</div>
										<div class="crs_fl_last">
											<div class="foot_list_info">
												<ul>
													<li><div class="elsio_ic"><i class="fa fa-eye text-success"></i></div><div class="elsio_tx">10k Views</div></li>
													<li><div class="elsio_ic"><i class="fa fa-clock text-warning"></i></div><div class="elsio_tx">10 July 2021</div></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Item -->
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="blg_grid_box">
								<div class="blg_grid_thumb">
									<a href="blog-detail.html"><img src="https://via.placeholder.com/1200x800" class="img-fluid" alt=""></a>
								</div>
								<div class="blg_grid_caption">
									<div class="blg_tag"><span>Accounting</span></div>
									<div class="blg_title"><h4><a href="blog-detail.html">How To Improove Digital Marketing for Fast SEO</a></h4></div>
									<div class="blg_desc"><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum</p></div>
								</div>
								<div class="crs_grid_foot">
									<div class="crs_flex d-flex align-items-center justify-content-between br-top px-3 py-2">
										<div class="crs_fl_first">
											<div class="crs_tutor">
												<div class="crs_tutor_thumb"><a href="instructor-detail.html"><img src="https://via.placeholder.com/500x500" class="img-fluid circle" width="35" alt=""></a></div>
											</div>
										</div>
										<div class="crs_fl_last">
											<div class="foot_list_info">
												<ul>
													<li><div class="elsio_ic"><i class="fa fa-eye text-success"></i></div><div class="elsio_tx">10k Views</div></li>
													<li><div class="elsio_ic"><i class="fa fa-clock text-warning"></i></div><div class="elsio_tx">10 July 2021</div></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Blog Start ============================ -->
			
			<!-- ========================== Download App Section =============================== -->
			<section>
				<div class="container">
					<div class="row align-items-center">
						
						<div class="col-lg-6 col-md-12 col-sm-12 content-column">
							<div class="content_block_2 pr-3 py-4">
								<div class="content-box">
									<div class="sec-title light">
										<p class="theme-cl px-3 py-1 rounded bg-light-success d-inline-flex">Download apps</p>
										<h2 class="ft-bold">Get the Workplex Job<br>Search App</h2>
									</div>
									<div class="text">
										<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto accusantium.</p>
									</div>
									<div class="btn-box clearfix mt-5">
										<a href="index.html" class="download-btn play-store mb-1 d-inline-flex"><img src="assets/img/ios.png" width="200" alt="" /></a>
										<a href="index.html" class="download-btn play-store ml-2 mb-1 d-inline-flex"><img src="assets/img/and.png" width="200" alt="" /></a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-12 col-sm-12 image-column">
							<div class="image-box">
								<figure class="image"><img src="assets/img/app.png" class="img-fluid" alt=""></figure>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- ========================== Download App Section =============================== -->
			
			<!-- ======================= Newsletter Start ============================ -->
			<section class="space bg-cover" style="background:#03343b url(assets/img/landing-bg.png) no-repeat;">
				<div class="container py-5">
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center mb-5">
								<h6 class="text-light mb-0">Subscribr Now</h6>
								<h2 class="ft-bold text-light">Get All New Job Notification</h2>
							</div>
						</div>
					</div>
					
					<div class="row align-items-center justify-content-center">
						<div class="col-xl-7 col-lg-10 col-md-12 col-sm-12 col-12">
							<form class="bg-white rounded p-1">
								<div class="row no-gutters">
									<div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
										<div class="form-group mb-0 position-relative">
											<input type="text" class="form-control lg left-ico" placeholder="Enter Your Email Address">
											<i class="bnc-ico lni lni-envelope"></i>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4">
										<div class="form-group mb-0 position-relative">
											<button class="btn full-width custom-height-lg theme-bg text-light fs-md" type="button">Subscribe</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Newsletter Start ============================ -->
@endsection
			
		