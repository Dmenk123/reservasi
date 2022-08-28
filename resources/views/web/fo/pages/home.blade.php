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
								{{-- <h6 class="text-muted mb-0">Trending Jobs</h6>
								<h2 class="ft-bold">All Popular Listed jobs</h2> --}}
								<p class="mb-2"><strong>Apakah di mata priamu kamu adalah wanita tercantik dan paling berharga dalam hidupnya? </strong>Jika iya, biarlah priamu berkorban mahal dengan menanam dan mengabadikan momen persembahan cintanya di atas tanah yang tercantik dan termahal se Indonesia.</p>
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

			<!-- ======================= About Start ============================ -->
			<section class="middle">
				<div class="container">

					<div class="row align-items-center justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="m-spaced">
								<div class="position-relative text-center">
									<div class="mb-1"><span class="theme-bg-light theme-cl px-2 py-1 rounded">About Us</span></div>
									{{-- <h2 class="ft-bold mb-3">Create and Build Your<br>Attractive Profile</h2> --}}
									<img src="{{ asset('assets/fo/img/intro.png') }}" width="200">
									<p class="mb-2">Di Indonesia, kota yang termahal dan tercantik penataannya adalah Surabaya. Paling premiumnya adalah Surabaya Barat. Di sana, kawasan yang memiliki tanah terluas adalah Citraland, dimana cluster termahalnya adalah yang di atas 1000m2 per unit dengan row jalan terlebar. Jadi tanah ini yang tercantik di cluster termahal di kota terbesar, termahal, dan tercantik se Indonesia, satu-satunya di dunia yang melambangkan SATU TUJUan.</p>
									<img src="{{ asset('assets/fo/img/intro.png') }}" width="200">
									<p class="mb-4">Jika identitas di mata priamu kamu adalah wanita tercantik dan paling berharga dalam hidupnya, maka biarlah priamu berkorban. Biarlah ia menanam di tanah tercantik dan termahal, yaitu menanam pengakuan identitas bahwa engkau adalah wanita yang paling berharga dan tercantik dalam hidupnya dan diabadikan dalam potret di atas tanah tercantik dan termahal karena manusia berasal dari tanah.</p>
								</div>

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
								<h2 class="ft-bold tulisan-custom">PEMESANAN TIKET</h2>
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
                                        <span class="text-muted">{{rupiah($harga->nominal_m_harga)}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="cats-wrap text-center">
                                <a href="{{ url('booking/jadwal?type=kredit') }}" class="cats-box d-block rounded bg-white px-2 py-4">
                                    <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle"><img src="{{ asset('assets/fo/flaticon/debit-card.png') }}" width="100"></div>
                                    <div class="cats-box-caption">
                                        <h2 class="fs-md mb-0 ft-medium m-catrio" style="color: #000000!important;">Ngecup</h2>
                                        <span class="text-muted">{{rupiah($harga->nominal_cicilan)}}</span>
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


			<!-- ============================ Pricing End ==================================== -->


			<!-- ======================= Blog Start ============================ -->


			<!-- ========================== Download App Section =============================== -->


			<!-- ======================= Newsletter Start ============================ -->
@endsection

