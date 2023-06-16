<aside class="main-sidebar sidebar-dark-primary elevation-4 flex-column sticky-top">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="index.php" class="d-block"> <?php echo ($_SESSION['name']); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2 side-nav">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item" id= "1">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item " id= "2">
                            <a href="order.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Orders
                                </p>
                            </a>
                        </li>

                        <!-- Tables for customers -->
                        <li class="nav-item"  id= "3">
                            <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-table"></i>
                              <p>
                                Tables
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                              
                              <li class="nav-item">
                                <a href="customers.php" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Customers</p>
                                </a>
                              </li>
                             
                            </ul>
                        </li>

                        <!-- Mail for the admin -->
                        <li class="nav-item" id= "4">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Mailbox
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inbox</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/compose.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compose</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Read</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- For the category section -->
                        <li class="nav-item " id= "5">
                            <a href="#" class="nav-link">
                                <i class="nav-icon "><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg></i>
                                <p>
                                    Category
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="category_add.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add a new category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="category_show.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Show all Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Products module to  -->
                        <li class="nav-item " id= "6">
                            <a href="#" class="nav-link">
                                <i class="nav-icon "><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg></i>
                                <p>
                                    Products
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="product_add.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add a new product</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="product_show.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Show all products</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Contact Us-->
                        <li class="nav-item" id="7">
                            <a href="pages/examples/contact-us.html" class="nav-link">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                                <p>Contact us</p>
                            </a>
                        </li>

                        <!-- Coupon Moduleo -->
                        <li class="nav-item" id="7">
                            <a href="coupon.php" class="nav-link">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <p>Create Coupon</p>
                            </a>
                        </li>
                            

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <script>
            var currentUrl = window.location.pathname.slice(1); 
            const links = document.querySelectorAll('.side-nav li a');
            // console.log(links,"links");
           
            
            for (var i = 0; i < links.length; i++) {
                var link = links[i];
                
                if (link.href.slice(-link.href.length + window.location.origin.length + 1) === currentUrl) {
                   
                    link.classList.add('active');
                    break;
                }  
            }
            const navLinks = document.querySelectorAll('.nav-item');

            // Loop through each nav link
            for (let i = 0; i < links.length; i++) {
                var navLink = links[i];
                var xyz = document.getElementById(i);
                // console.log(xyz.className);
                // console.log(navLink.parentNode.classList)
                var navItem = navLink.parentElement
                // Check if the current nav link has the "active" class
                if (navLink.classList.contains('active')) {
                    console.log(navItem);
                    // console.log("active",navItem.classList);
                // Add the "menu-open" class to the nav link's class list
                loca
                navItem.classList.add('menu-open');
                navItem.classList.add('menu-is-opening');
                navItem.classList.add('menu-open');
                }
            }
            </script>