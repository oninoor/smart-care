<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <?php
    $uri = service('uri');
    ?>

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?= lang('Files.Menu') ?></li>

                <li>
                    <a href="/">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?= lang('Files.Dashboard') ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps"><?= lang('Files.Apps') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?= base_url('apps/simrs-credential') ?>">
                                <span data-key="t-simrs-credential"><?= lang('Files.Simrs_Credential') ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('apps/my-credential') ?>">
                                <span data-key="t-my-credential"><?= lang('Files.My_Credential') ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-api-requests-sent">
                                <span data-key="t-api-requests-sent"><?= lang('Files.Api_Requests_Sent') ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-api-requests-accepted">
                                <span data-key="t-api-requests-accepted"><?= lang('Files.Api_Requests_Accepted') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="user"></i>
                        <span data-key="t-profile"><?= lang('Files.Profile') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= base_url('profile/my-profile') ?>" data-key="t-my-profile"><?= lang('Files.My_Profile') ?></a></li>
                    </ul>
                </li>

                <li class="menu-title mt-2" data-key="t-admin"><?= lang('Files.Admin') ?></li>

                <li class="<?= in_array($uri->setSilent()->getSegment(2), ['edit-hospital']) ? 'mm-active' : '' ?>">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="briefcase"></i>
                        <span data-key="t-hospital"><?= lang('Files.Hospital') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li class="<?= in_array($uri->setSilent()->getSegment(2), ['edit-hospital']) ? 'mm-active' : '' ?>"><a href="<?= base_url('admin/show-hospital') ?>" data-key="t-show-hospital"><?= lang('Files.Show_Hospital') ?></a></li>
                        <li><a href="ui-add-hospital" data-key="t-add-hospital"><?= lang('Files.Add_Hospital') ?></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-users"><?= lang('Files.Users') ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-all-users" data-key="t-all-users"><?= lang('Files.All_Users') ?></a></li>
                        <li><a href="extended-add-user" data-key="t-range-slider"><?= lang('Files.Add_User') ?></a></li>
                        <li><a href="extended-edit-user" data-key="t-edit-user"><?= lang('Files.Edit_User') ?></a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->