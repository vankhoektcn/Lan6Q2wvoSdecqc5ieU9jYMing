                    <div class="sidebar">
                        @if(isset($tinDuAnMoiNhat) && count($tinDuAnMoiNhat) > 0)
						<div class="sidebar-title-cont mrgt2x">
							<h4 class="sidebar-title">Tin dự án mới<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-featured-cont">
						@foreach($tinDuAnMoiNhat as $key=>$article)
							<div class="sidebar-featured">
								<a class="sidebar-featured-image" href="{{$article->getLink()}}">
									<img src="{{$article->getFirstAttachment('custom', 97, 87)}}" alt="{{$article->name}}" />
									<!-- <div class="sidebar-featured-type">
										<div class="sidebar-featured-estate">A</div>
										<div class="sidebar-featured-transaction">S</div>
									</div> -->
								</a>
								<div class="sidebar-featured-title"><a href="{{$article->getLink()}}">{{$article->name}}</a></div>
								<div class="sidebar-featured-price">{{$article->project->name}}</div>
								<div class="clearfix"></div>					
							</div>
						@endforeach
						</div>
                        @endif
                        @if(isset($tinDuAnXemNhieu) && count($tinDuAnXemNhieu) > 0)
						<div class="sidebar-title-cont">
							<h4 class="sidebar-title">Xem nhiều<span class="special-color">.</span></h4>
							<div class="title-separator-primary"></div>
						</div>
						<div class="sidebar-blog-cont">
						@foreach($tinDuAnXemNhieu as $key=>$article)
							<article>
								<a href="blog-right-sidebar.html"><img src="{{$article->getFirstAttachment('custom', 97, 87)}}" alt="{{$article->name}}" class="sidebar-blog-image" /></a>
								<div class="sidebar-blog-title"><a href="{{$article->getLink()}}">{{$article->name}}</a></div>
								<div class="sidebar-blog-date"><i class="fa fa-calendar-o"></i>28/09/15</div>
								<div class="clearfix"></div>					
							</article>
						@endforeach
						</div>
                        @endif
					</div>