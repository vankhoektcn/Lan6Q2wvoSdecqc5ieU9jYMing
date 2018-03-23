                                <div class="list-offer">
									<div class="list-offer-left">
										<div class="list-offer-front">
									
											<div class="list-offer-photo">
												<img src="{{ $project->getFirstAttachment("custom", 270, 180) }}" alt="" />
												<div class="type-container">
													<!-- <div class="estate-type">apartment</div> -->
													<div class="transaction-type">{{$project->projectType->name}}</div>
												</div>
											</div>
											<div class="list-offer-params">
												<div class="list-area">
													<img src="/frontend/images/area-icon.png" alt="" />...<sup>.</sup>
												</div>
												<div class="list-rooms">
													<img src="/frontend/images/rooms-icon.png" alt="" />...
												</div>
												<div class="list-baths">
													<img src="/frontend/images/bathrooms-icon.png" alt="" />...
												</div>							
											</div>	
										</div>
										<div class="list-offer-back">
											<div id="list-map1" class="list-offer-map"></div>
										</div>
									</div>
									<a class="list-offer-right" href="{{$project->getLink()}}">
										<div class="list-offer-text">
											<div class="list-offer-h4"><h4 class="">{{$project->name}}</h4></div>
											<div class="clearfix"></div>
											<div class="list-offer-h4">
											<h4 class="list-offer-title"><smail><i class="fa fa-map-marker list-offer-localization hidden-xs"></i> {{$project->addressFull()}}</smail></h4></div>
											<div class="clearfix"></div>
											{{$project->summary}}
											<div class="clearfix"></div>
										</div>
										<div class="price-list-cont">
											<div class="list-price">
												Chi tiết
											</div>	
										</div>
									</a>
									<div class="clearfix"></div>
								</div>

								<div class="clearfix"></div>