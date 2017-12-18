<h4 class="sidebar-title">Danh mục<span class="special-color">.</span></h4>
<div class="title-separator-primary"></div>
<div class="margin-top-30"></div>
<ul class="blue-ul">
@if(isset($newArticleType))
	@foreach($parentArticleCategories as $pACategory)
	<li><span class="custom-ul-bullet"></span><a href="{{$pACategory->getLink()}}">{{$pACategory->name}}</a></li>
		@if($pACategory->hasChildrens())
		<li class="ap-submenu">
			<ul class="blue-ul">
				@foreach($pACategory->childrens as $aCategory)
				<li><span class="custom-ul-bullet"></span><a href="{{$aCategory->getLink()}}">{{$aCategory->name}}</a></li>
				@endforeach
			</ul>
		</li>
		@endif
	@endforeach
@endif
</ul>