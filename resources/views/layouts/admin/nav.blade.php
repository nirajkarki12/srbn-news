<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::guard('admin')->user()->picture){{Auth::guard('admin')->user()->picture}} @else {{asset('images/placeholder.jpg')}} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href="{{route('admin.profile')}}">{{Auth::guard('admin')->user()->email}}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li id="setting">
              <a href="{{route('admin.config')}}">
                <i class="fa fa-cogs"></i> <span>Settings</span>
              </a>
            </li>

            <li id="dashboard">
              <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <li id="rss-feed">
              <a href="{{route('admin.rss')}}">
                <i class="fa fa-rss"></i> <span>RSS Feed</span>
              </a>
            </li>

            <li id="quotes">
                <a href="{{route('admin.quote')}}">
                    <i class="fa fa-quote-right"></i> <span>Quotes</span>
                </a>
            </li>

            <li id="category-menu">
                <a href="{{route('admin.category')}}">
                    <i class="fa fa-folder-o"></i> <span>Categories</span>
                </a>
            </li>

            <li class="treeview" id="attribute">
                <a href="{{route('admin.lifehack')}}">
                    <i class="fa fa-life-ring"></i> <span>Life Hacks</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-attribute"><a href="{{route('admin.lifehack.create')}}"><i class="fa fa-plus"></i>Add Life Hack</a></li>
                    <li id="view-attribute"><a href="{{route('admin.lifehack')}}"><i class="fa fa-th-list"></i>List Life Hack</a></li>
                </ul>
            </li>

            <li class="treeview" id="attribute">
                <a href="{{route('admin.meme')}}">
                    <i class="fa fa-frown-o"></i> <span>Memes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-attribute"><a href="{{route('admin.meme.create')}}"><i class="fa fa-plus"></i>Add Meme</a></li>
                    <li id="view-attribute"><a href="{{route('admin.meme')}}"><i class="fa fa-th-list"></i>List Meme</a></li>
                </ul>
            </li>

            <li class="treeview" id="attribute">
                <a href="{{route('admin.vacancy')}}">
                    <i class="fa fa-tasks"></i> <span>Vacancy</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-attribute"><a href="{{route('jobs.category')}}"><i class="fa fa-list"></i>Category</a></li>
                    <li id="view-attribute"><a href="{{route('jobs.company')}}"><i class="fa fa-th-list"></i>Company</a></li>
                    <li id="view-attribute"><a href="{{route('admin.vacancy')}}"><i class="fa fa-th-list"></i>Jobs</a></li>
                </ul>
            </li>

            <li class="treeview" id="attribute">
                <a href="{{route('admin.meme')}}">
                    <i class="fa fa-star"></i> <span>Zodiacs/Horoscopes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-attribute"><a href="{{route('admin.horoscope.create')}}"><i class="fa fa-plus"></i>Add Zodiac Sign</a></li>
                    <li id="view-attribute"><a href="{{route('admin.horoscope')}}"><i class="fa fa-th-list"></i>List Zodiac Signs</a></li>
                    <li id="add-attribute"><a href="{{route('admin.prediction.create')}}"><i class="fa fa-plus"></i>Add Prediction</a></li>
                    <li id="view-attribute"><a href="{{route('admin.prediction')}}"><i class="fa fa-th-list"></i>List Predictions</a></li>
                </ul>
            </li>

            <li class="treeview" id="post">
                <a href="{{route('admin.post')}}">
                    <i class="fa fa-newspaper-o"></i> <span>Post</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-post"><a href="{{route('admin.post.create')}}"><i class="fa fa-plus"></i>Add Post</a></li>
                    <li id="view-post"><a href="{{route('admin.post')}}"><i class="fa fa-th-list"></i>List Posts</a></li>
                </ul>
            </li>

            <li class="treeview" id="adgroups">
                <a href="{{route('admin.adgroup')}}">
                    <i class="fa fa-picture-o"></i> <span>Adgroup</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-post"><a href="{{route('admin.adgroup.create')}}"><i class="fa fa-plus"></i>Add a Ads</a></li>
                    <li id="view-post"><a href="{{route('admin.adgroup')}}"><i class="fa fa-th-list"></i>List Adgroup</a></li>
                </ul>
            </li>

        </ul>

    </section>

    <!-- /.sidebar -->

</aside>
