<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
				<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
				<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
				<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="start active ">
						<a href="{{asset('/home')}}">
						<i class="icon-home"></i>
						<span class="title">Dashboard</span>
						<span class="selected"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('users') }}">
						<i class="icon-user"></i>
						<span class="title">Users</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('customers') }}">
						<i class="icon-user"></i>
						<span class="title">Customer</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('category') }}">
						<i class="icon-basket"></i>
						<span class="title">Category</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('subCategories') }}">
						<i class="icon-basket"></i>
						<span class="title">Sub-Category</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('products') }}">
						<i class="icon-basket"></i>
						<span class="title">Product</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('taxRules') }}">
						<i class="icon-basket"></i>
						<span class="title">Tax Rule</span>
						<span class="arrow"></span>
						</a>
					</li>
					<li>
						<a href="{{ URL::to('orders') }}">
						<i class="icon-basket"></i>
						<span class="title">Order</span>
						<span class="arrow "></span>
						</a>
					</li>
					<!-- <li>
						<a href="cart.html">
						<i class="icon-basket"></i>
						<span class="title">Cart</span>
						<span class="arrow"></span>
						</a>
					</li> -->
					<li>
						<a href="{{ URL::to('discounts') }}">
						<i class="icon-basket"></i>
						<span class="title">Discount</span>
						<span class="arrow "></span>
						</a>
					</li>
					<li>
						<a href="#">
						<i class="icon-basket"></i>
						<span class="title">Report</span>
						<span class="arrow"></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="{{ URL::to('report/transactionReport') }}">
								Transaction Report</a>
							</li>
							<li>
								<a href="{{ URL::to('report/itemSale') }}">
								Item Sale</a>
							</li>
							<li>
								<a href="{{ URL::to('report/orderReport') }}">
								Order Report</a>
							</li>
							<li>
								<a href="categorySale">
								Category Sale</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="{{ URL::to('tables') }}">
						<i class="icon-basket"></i>
						<span class="title">Table</span>
						<span class="arrow"></span>
						</a>
					</li>
					
					
				<!-- END SIDEBAR MENU -->
			</div>