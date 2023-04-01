@extends('admin.master') @section('content') @include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
	@include('admin.include.sidebar')
	<!-- Page Content  -->
	<div id="content" class="p-4">
		<div class="row pb-3">
			<div class="col-md-12">
				<div class="faq-title">
					<div class="title">
						<h4 class="heading2 font-30 color-f58719">FAQs</h4>
					</div>
					<div class="input">
						<div class="input-group territories-input">
							<input
								type="text"
								class="form-control manage-input faq-input"
								placeholder="Find people and conversations"
							/>

							<div class="search-icon new-icon">
								<span>
									<i class="fa fa-search icon"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="accord-bg mt-5">
					<div class="accordion" id="accordionExample">
						<div class="card">
							<div class="card-header" id="headingOne">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link"
										data-toggle="collapse"
										data-target="#collapseOne"
									>
										<i class="fa fa-plus icon"></i>
										Integer ac interdum lacus. Nunc porta semper lacus a varius.
										Pellentesque habitant morbi tristique senectus et netus et
										malesuada fames ac turpis egestas. Nunc?
									</button>
								</p>
							</div>
							<div
								id="collapseOne"
								class="collapse show"
								aria-labelledby="headingOne"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>
										Etiam convallis elementum sapien, a aliquam turpis aliquam
										vitae. Praesent sollicitudin felis vel mi facilisis posuere.
										Nulla ultrices facilisis justo, non varius nisl semper vel.
										Interdum et malesuada fames ac ante ipsum primis in
										faucibus. Phasellus at ante mattis, condimentum velit et,
										dignissim nunc. Integer quis tincidunt purus. Duis dignissim
										mauris vel elit commodo, eu hendrerit leo ultrices. Nulla
										vehicula vestibulum purus at rutrum. Pellentesque habitant
										morbi tristique senectus et netus et malesuada fames ac
										turpis egestas. Curabitur dignissim massa nec libero
										scelerisque rutrum. Curabitur ac purus id elit hendrerit
										lacinia. Nullam sit amet sem efficitur, porta diam in,
										convallis tortor.
									</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingTwo">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseTwo"
									>
										<i class="fa fa-plus icon"></i> Second Tab
									</button>
								</p>
							</div>
							<div
								id="collapseTwo"
								class="collapse"
								aria-labelledby="headingTwo"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>
										Etiam convallis elementum sapien, a aliquam turpis aliquam
										vitae. Praesent sollicitudin felis vel mi facilisis posuere.
										Nulla ultrices facilisis justo, non varius nisl semper vel.
										Interdum et malesuada fames ac ante ipsum primis in
										faucibus. Phasellus at ante mattis, condimentum velit et,
										dignissim nunc. Integer quis tincidunt purus. Duis dignissim
										mauris vel elit commodo, eu hendrerit leo ultrices. Nulla
										vehicula vestibulum purus at rutrum. Pellentesque habitant
										morbi tristique senectus et netus et malesuada fames ac
										turpis egestas. Curabitur dignissim massa nec libero
										scelerisque rutrum. Curabitur ac purus id elit hendrerit
										lacinia. Nullam sit amet sem efficitur, porta diam in,
										convallis tortor.
									</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingThree">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseThree"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseThree"
								class="collapse"
								aria-labelledby="headingThree"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFour">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseFour"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseFour"
								class="collapse"
								aria-labelledby="headingFour"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFive">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseFive"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseFive"
								class="collapse"
								aria-labelledby="headingFive"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingSix">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseSix"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseSix"
								class="collapse"
								aria-labelledby="headingSix"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingSeven">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseSeven"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseSeven"
								class="collapse"
								aria-labelledby="headingFive"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingEight">
								<p class="mb-0">
									<button
										type="button"
										class="btn btn-link collapsed"
										data-toggle="collapse"
										data-target="#collapseEight"
									>
										<i class="fa fa-plus icon"></i> Third Tab
									</button>
								</p>
							</div>
							<div
								id="collapseEight"
								class="collapse"
								aria-labelledby="headingEight"
								data-parent="#accordionExample"
							>
								<div class="card-body">
									<p>Third Tab Content</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-7 col-md-12 mb-3">
				<div id="accordion2">
					@if( count($records) ) @foreach( $records as $record )
					<div class="card mb-3 faq-card-border">
						<div class="card-header" id="headingOne">
							<p
								class="mb-0 panel-title"
								data-toggle="collapse"
								data-target="#faq{{ $record->id }}"
								aria-expanded="false"
								aria-controls="faq{{ $record->id }}"
							>
								{{ $record->question }}
							</p>
						</div>
						<div
							id="faq{{ $record->id }}"
							class="collapse"
							data-parent="#accordion2"
						>
							<div class="card-body">
								{{ $record->answer }}
							</div>
						</div>
					</div>
					@endforeach @endif
				</div>
			</div>
			<div class="col-md-5 mb-3 text-center d-none d-lg-block">
				<img
					src="{{ asset('assets/images/help.png') }}"
					class="img-fluid"
					alt="FAQ Image"
				/>
				<h4 class="heading2 pt-3 font-30">How can we help you?</h4>
			</div>
		</div>
	</div>
</div>
@endsection
<script></script>
