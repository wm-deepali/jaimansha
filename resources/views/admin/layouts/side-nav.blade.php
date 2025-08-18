    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
<img src="{{ asset('adminpannel/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Mansha</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminpannel/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Jai Mansha</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
<li class="nav-item">
  <a href="{{ route('admin.dashboard') }}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>Dashboard</p>
  </a>
</li>


<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-copy"></i>
    <p>Content Management<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.content.header')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Header Setting</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.footer.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Footer Setting</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.awards.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Awards & Certificates</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.socialmedia.view')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Social Media</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.sliders.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Slider Management</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.aboutus.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>About Us</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.vision.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Vision & Mission</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.objectives.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Our Objectives</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.managementcommittee.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Management Committee</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.team.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Our Team</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.certifications.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Reports & Legal</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.legal.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Legal</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.scholastics.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Scholastics</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.co_scholastics.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Co-Scholastic</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.brochures.index') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>E-Brochures</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.news.index') }}" class="nav-link"><i class="nav-icon fas fa-newspaper"></i><p>News Management</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.donation.index') }}" class="nav-link"><i class="nav-icon fas fa-hands-helping"></i><p>Account Details </p></a></li>
    <li class="nav-item"><a href="{{ route('admin.donate.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Donation Page</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.sponsorship.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Sponsorship</p></a></li>
     
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-graduation-cap"></i>
    <p>Scholarship<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.scholarship_content.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Scholarship Content</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.scholarships.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Scholarship Management</p></a></li>
  </ul>
</li>


<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-graduation-cap"></i>
    <p>Event Management<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.events.event.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Events</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.events.registation.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Event Registation</p></a></li>
  </ul>
</li>


<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-graduation-cap"></i>
    <p>Manage Introduction<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.manageintroduction.introduction.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Introduction</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.manageintroduction.feature.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Features</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-user-friends"></i>
    <p>Membership<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.membership.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Membership Page Content</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.membership.packages.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Packages</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.membership.enquiry.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Membership Enquiries</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.membership.registered.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Registered Members</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.notifications.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Notifications to Members</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-book-open"></i>
    <p>E-Magazine<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.emagazine.categories.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Categories</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.emagazine.authors.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Authors</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.emagazine.publication.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Publications</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-newspaper"></i>
    <p>Publications<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.publications.categories.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Categories</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.publications.authors.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Authors</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.publications.publication.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Articles</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-hand-holding-heart"></i>
    <p>Donations<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
     <li class="nav-item"><a href="{{ route('admin.donation-category.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Donation Categories</p></a></li>
      <li class="nav-item"><a href="{{route('admin.donation-cases.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>DonationCase</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.donations.donors.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Donors Data</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.donations.transactions.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Donations Transactions</p></a></li>
       <li class="nav-item">
        <a href="{{ route('admin.donations.sauses.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Donation Causes</p>
        </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a href="{{ route('admin.program.index') }}" class="nav-link">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>Our Program</p>
  </a>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-hand-holding-heart"></i>
    <p>Enquiries<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.newsletters.index') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>News Letter</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.form_requests.index') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Form Request Details</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.contacts.index') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Contact Details</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.become_volunteers.index') }}" class="nav-link"><i class="nav-icon fas fa-hands-helping"></i><p>Become Volunteers</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.scholarshipenquiries.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Scholarship Enquiries</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.sponsorship_registation.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Sponsorship Enquiry</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-photo-video"></i>
    <p>Gallery<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{route('admin.gallery.categories.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Category</p></a></li>
    <li class="nav-item"><a href="{{route('admin.gallery.media.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manage Images & Video's</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-chalkboard-teacher"></i>
    <p>Our Courses<i class="fas fa-angle-left right"></i></p></a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.courses.categories.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Course Category</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.courses.content.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Course Content</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.courses.admissionenquiries.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Admission Enquiries</p></a></li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-blog"></i>
    <p>Blogs & FAQ<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.blogs.categories.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Blogs Category</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.blogs.contents.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Blogs Content</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.blogs.faqs.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>FAQ Management</p></a></li>
  </ul>
</li>


<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-hand-holding-heart"></i>
    <p>Feedback & Suggestions<i class="fas fa-angle-left right"></i></p></a>
  <ul class="nav nav-treeview">
    <li class="nav-item"><a href="{{ route('admin.feedback.index') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Feedback</p></a></li>
    <li class="nav-item"><a href="{{ route('admin.complaints.index') }}" class="nav-link"><i class="nav-icon fas fa-exclamation-circle"></i><p>Complaints & Suggestions</p></a></li>
    
     </ul>
</li>


<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cogs"></i>
    <p>Settings<i class="fas fa-angle-left right"></i></p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.settings.account') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i><p>Account Setting</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.settings.profile') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i><p>Profile Setting</p>
      </a>
    </li>
  </ul>
</li>

