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

            <li class="treeview" id="attribute">
                <a href="{{route('admin.category')}}">
                    <i class="fa fa-folder-o"></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-attribute"><a href="{{route('admin.category.create')}}"><i class="fa fa-plus"></i>Add Category</a></li>
                    <li id="view-attribute"><a href="{{route('admin.category')}}"><i class="fa fa-th-list"></i>List Categories</a></li>
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

            <li class="treeview" id="poll">
                <a href="{{route('admin.poll')}}">
                    <i class="fa fa-bar-chart"></i> <span>Polls</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-poll"><a href="{{route('admin.poll.create')}}"><i class="fa fa-plus"></i>Add Poll</a></li>
                    <li id="view-poll"><a href="{{route('admin.poll')}}"><i class="fa fa-th-list"></i>List Polls</a></li>
                </ul>
            </li>

        </ul>

    </section>

    <!-- /.sidebar -->

</aside>