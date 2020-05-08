<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class="topnav rtl-ps-none" id="" data-perfect-scrollbar="" data-suppress-scroll-x="true">
                <ul class="menu float-left">
                    <li>
                        <div>
                            <div>
                                <label class="toggle">Dashboard</label><a href="{{ url('/') }}"><i class="nav-icon mr-2 i-Bar-Chart"></i> Dashboard</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <label class="toggle" for="drop-2">Master Data</label><a href="#"><i class="nav-icon mr-2 i-Files"></i> Master Data</a>
                                <input id="drop-2" type="checkbox" />
                                <ul>
                                    <li><a href="{{ url('/users') }}"><i class="nav-icon mr-2 i-Add-User"></i><span class="item-name">Users List</span></a></li>
                                    <li><a href="{{ url('/company') }}"><i class="nav-icon mr-2 i-Building"></i><span class="item-name">Company List</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <label class="toggle" for="drop-2">Billing</label><a href="#"><i class="nav-icon mr-2 i-Money-2"></i> Billing</a>
                                <input id="drop-2" type="checkbox" />
                                <ul>
                                    <li><a href="{{ url('/pricing') }}"><i class="nav-icon mr-2 i-Full-Cart"></i><span class="item-name">Pricing Management</span></a></li>
                                    <li><a href="{{ url('/paymentrequest') }}"><i class="nav-icon mr-2 i-Checkout"></i><span class="item-name">Payment Request</span></a></li>
                                    <li><a href="{{ url('/paymentstatus') }}"><i class="nav-icon mr-2 i-Newspaper"></i><span class="item-name">Payment Status</span></a></li>
                                    <li><a href="{{ url('/invoice') }}"><i class="nav-icon mr-2 i-Receipt-3"></i><span class="item-name">Invoice</span></a></li>
                                    <li><a href="{{ url('/receipt') }}"><i class="nav-icon mr-2 i-Receipt"></i><span class="item-name">Receipt</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <div>
                                <label class="toggle" for="drop-2">Sevices</label><a href="#"><i class="nav-icon mr-2 i-Security-Settings"></i> Sevices</a>
                                <input id="drop-2" type="checkbox" />
                                <ul>
                                    <li><a href="{{ url('/payment') }}"><i class="nav-icon mr-2 i-Money-2"></i><span class="item-name">Payment</span></a></li>
                                    <li><a href="{{ url('/token') }}"><i class="nav-icon mr-2 i-Lock"></i><span class="item-name">Token</span></a></li>
                                    <li><a href="{{ url('/pulldata') }}"><i class="nav-icon mr-2 i-Big-Data"></i><span class="item-name">Pull Data</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
