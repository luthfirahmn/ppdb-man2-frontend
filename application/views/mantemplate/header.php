<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item"><a class="navbar-brand" href="../../../html/ltr/horizontal-menu-template/index.html">
                    <h2 class="brand-text mb-0">MAN 2 KOTA BANDUNG</h2>
                </a></li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">

        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                        data-feather="moon"></i></a></li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"></div><span class="avatar"><img class="round"
                            src="<?= FT_APP_ASSETS . 'images/user.png' ?>" alt="avatar" height="40" width="40"><span
                            class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <!-- <a class="dropdown-item" href="<?php echo base_url('login_peserta/change_password') ?>"><i class="mr-50" data-feather="key"></i> Ganti Password</a> -->
                    <a class="dropdown-item" href="<?php echo base_url('login_peserta/logout') ?>"><i class="mr-50"
                            data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
