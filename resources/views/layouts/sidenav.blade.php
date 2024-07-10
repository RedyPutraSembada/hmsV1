<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="/dashboard" id="preventLink">
            <img src="{{ asset('assets/assets/img/Logo-Pw.png') }}" class="h-200" alt="main_logo" style="width: 60px; max-height: 60px; margin-left: -10px; margin-top: -10px">
            <span class="font-weight-bold" style="font-size: 18px; margin-top: 10px">Dashboard</span>
        </a>
    </div>

    <div class="pt-3">
        @can('Front.room.view')
        <p>
            <h5 class="d-flex align-items-center justify-content-start font-weight-bold" style="margin-left: 33px">
                Front Desk
            </h5>
        </p>
        @endcan
        <ul class="navbar-nav">
            @can('Front.room.view')
            {{--  <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/room-view') == true ? 'active' : '' }}" href="/front-office/room-view">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building-gear me-2"></i>
                        <span class="nav-link-text ms-1">Room View</span>
                    </div>
                </a>
            </li>  --}}
            @endcan

            @can('Front.stay.view')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/stay-view') == true ? 'active' : '' }}" href="/front-office/stay-view">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building-gear me-2"></i>
                        <span class="nav-link-text ms-1">Stay View</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Front.reservation')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/reservation') == true ? 'active' : '' }}" href="/front-office/reservation">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-house-gear-fill me-2"></i>
                        <span class="nav-link-text ms-1">Reservation</span>
                    </div>
                </a>
            </li>
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/registrasion') == true ? 'active' : '' }}" href="/front-office/registrasion">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-house-gear-fill me-2"></i>
                        <span class="nav-link-text ms-1">Expected Arrival</span>
                    </div>
                </a>
            </li>
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/departure') == true ? 'active' : '' }}" href="/front-office/departure">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-house-gear-fill me-2"></i>
                        <span class="nav-link-text ms-1">Expected Departure</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Front.transaction')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'front-office/Transaction') == true ? 'active' : '' }}" href="/front-office/Transaction">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-clipboard-data me-2"></i>
                        <span class="nav-link-text ms-1">Transaction</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('Front.transaction')
            <li>
                <a class="nav-link {{ request()->is('front-office/past-Transaction') ? 'active' : '' }}" href="/front-office/past-Transaction">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-clipboard2-pulse-fill me-2"></i>
                        <span class="nav-link-text ms-1">Transaction History</span>
                    </div>
                </a>
            </li>
            @endcan
        </ul>
    </div>

    <div class="pt-3">
        @can('pos')
        <p>
            <h5 class="d-flex align-items-center justify-content-start font-weight-bold" style="margin-left: 33px">
                POS
            </h5>
        </p>
        @endcan
        <ul class="navbar-nav">
            @can('pos')
            <li>
                <a class="nav-link {{ request()->is('pos/product') ? 'active' : '' }}" href="/pos/product">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                        <span class="nav-link-text ms-1">Product</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('pos')
            <li>
                <a class="nav-link {{ request()->is('pos/product-for-buying') ? 'active' : '' }}" href="/pos/product-for-buying">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-cart3"></i>
                        <span class="nav-link-text ms-1">Products For Buying</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('pos')
            <li>
                <a class="nav-link {{ request()->is('pos/Transaction') ? 'active' : '' }}" href="/pos/Transaction">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-clipboard2-data-fill"></i>
                        <span class="nav-link-text ms-1">POS Transaction</span>
                    </div>
                </a>
            </li>
            @endcan
        </ul>
    </div>

    <div class="pt-3">
        <p>
            <h5 class="d-flex align-items-center justify-content-start font-weight-bold" style="margin-left: 33px">
                Master Data
            </h5>
        </p>
        <ul class="navbar-nav">
            @can('master.additional.item')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/additional-item') == true ? 'active' : '' }}" href="/master-data/additional-item">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-box me-2"></i>
                        <span class="nav-link-text ms-1">Additional Item</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.breakfest')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/breakfast') == true ? 'active' : '' }}" href="/master-data/breakfast">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-check2-square text-dark text-sm opacity-10 me-2" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Breakfast</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.user.role')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/role') == true ? 'active' : '' }}" href="/master-data/role">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-person-lock me-2"></i>
                        <span class="nav-link-text ms-1"> User Role</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.floor')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/floor') == true ? 'active' : '' }}" href="/master-data/floor">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-layers text-dark text-sm opacity-10 me-2" aria-hidden="true"></i>
                        <span class="nav-link-text ms-1">Floor</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.room')
            <li>
                <a class="nav-link {{ request()->is('master-data/room') ? 'active' : '' }}" href="/master-data/room">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building me-2"></i>
                        <span class="nav-link-text ms-1">Room</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.type.room')
            <li>
                <a class="nav-link {{ request()->is('master-data/room-type') ? 'active' : '' }}" href="/master-data/room-type">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building-gear me-2"></i>
                        <span class="nav-link-text ms-1">Type Room</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.status.room')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/status-room') == true ? 'active' : '' }}" href="/master-data/status-room">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building-gear me-2"></i>
                        <span class="nav-link-text ms-1">Status Room</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.price')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/status-rate-type') == true ? 'active' : '' }}" href="/master-data/status-rate-type">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-building-gear me-2"></i>
                        <span class="nav-link-text ms-1">Status Rate Type</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.price')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/price-rate-type') == true ? 'active' : '' }}" href="/master-data/price-rate-type">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-tags me-2"></i>
                        <span class="nav-link-text ms-1">Price Rate Type</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.occupation')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/occupation') == true ? 'active' : '' }}" href="/master-data/occupation">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-person-fill-gear me-2"></i>
                        <span class="nav-link-text ms-1">Occupation</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.travel.agent')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/travel-agent') == true ? 'active' : '' }}" href="/master-data/travel-agent">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-luggage me-2"></i>
                        <span class="nav-link-text ms-1">Travel Agent</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.source.travel.agent')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/source-travel-agent') == true ? 'active' : '' }}" href="/master-data/source-travel-agent">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-luggage-fill me-2"></i>
                        <span class="nav-link-text ms-1">Source Travel Agent</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.price')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/rate-code') == true ? 'active' : '' }}" href="/master-data/rate-code">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-gear me-2"></i>
                        <span class="nav-link-text ms-1">Rate Code</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.user')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/users') == true ? 'active' : '' }}" href="/master-data/users">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-person-exclamation me-2"></i>
                        <span class="nav-link-text ms-1">User</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('master.guest')
            <li>
                <a class="nav-link {{ str_contains(request()->url(), 'master-data/guest') == true ? 'active' : '' }}" href="/master-data/guest">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-person me-2"></i>
                        <span class="nav-link-text ms-1">Guest</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('accounting')
            <li>
                <a class="nav-link" href="#">
                    <div class="text-center d-flex align-items-center justify-content-center" style="margin-left: 8px">
                        <i class="bi bi-calculator me-2"></i> <i style="font-weight: 450; font-size: 15px">Accounting</i>
                    </div>
                </a>
            </li>
            @endcan

        </ul>
    </div>

    <div class="pt-3">
        @can('inventory')
        <p>
            <a class="d-flex align-items-center justify-content-start font-weight-bold" href="/iventory" style="margin-left: 33px">
                Inventory
            </a>
        </p>
        @endcan
    </div>
</aside>
