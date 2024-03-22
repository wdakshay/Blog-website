<!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i data-feather="airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="#categories" data-toggle="collapse">
                                    <i data-feather="list"></i>
                                    <span> Categories </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="categories">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add-category') }}">Add New</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin-categories') }}">All Categories</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#blogs" data-toggle="collapse">
                                    <i data-feather="list"></i>
                                    <span> Posts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="blogs">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('add-blog') }}">Add New</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin-blogs') }}">All Posts</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="{{ route('admin-comments') }}">
                                    <i data-feather="message-square"></i>
                                    <span> Comments </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin-users') }}">
                                    <i data-feather="users"></i>
                                    <span> Users </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->