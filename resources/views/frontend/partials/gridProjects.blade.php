                <div class="featured-offer-col">
					<div class="featured-offer-front">
						<div class="featured-offer-photo">
							<img src="{{ $project->getFirstAttachment("custom", 360, 270) }}" alt="" />
							<div class="type-container">
								<!-- <div class="estate-type">{{$project->name}}</div> -->
								<div class="transaction-type">{{$project->name}}</div>
							</div>
						</div>
						<div class="featured-offer-text">
							<h4 class="featured-offer-title" style="color: #ee7e23"><i class="fa fa-map-marker mrgr05" aria-hidden="true"></i>{{$project->addressFull()}}</h4>
							<p>{{$project->summary}}</p>
						</div>
						<!-- <div class="featured-offer-params">
							<div class="featured-area">
								<img src="/frontend/images/area-icon.png" alt="" />54m<sup>2</sup>
							</div>
							<div class="featured-rooms">
								<img src="/frontend/images/rooms-icon.png" alt="" />3
							</div>
							<div class="featured-baths">
								<img src="/frontend/images/bathrooms-icon.png" alt="" />1
							</div>							
						</div> -->
						<div class="featured-price">
							{{$project->price_description}}
						</div>
					</div>
					<div class="featured-offer-back">
						<div id="featured-map1" class="featured-offer-map"></div>
						<div class="button">	
							<a href="{{$project->getLink()}}" class="button-primary">
								<span>Xem thêm</span>
								<div class="button-triangle"></div>
								<div class="button-triangle2"></div>
								<div class="button-icon"><i class="fa fa-search"></i></div>
							</a>
						</div>
					</div>
				</div>