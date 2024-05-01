<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-image" style="line-height: unset; margin-top: 0">MANDABA</span>
        <span class="brand-text font-weight-light"><strong>MAN 2 KOTA BANDUNG</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url("dashboard") ?>" class="nav-link <?= ((empty($this->uri->segment(1)) or $this->uri->segment(1) == 'dashboard') ? 'active' : '') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?= get_menu($this->session->userdata('email')) ?>
                <?php echo get_menu($this->session->userdata('username')); ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>