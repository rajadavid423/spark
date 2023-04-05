<!--    Sidebar-->
<div class="vertical-nav" id="sidebar">
    <ul class="nav navbar-nav  mb-0">
        <li class="nav-item nav_border_style_logo">
            <a href="#" class="nav-link text-light">
                <h4 class="text-white mb-0 mx-2 py-2" style="font-weight: 100;">Step By Step Learning</h4>
            </a>
        </li>
        <li class="nav-item nav_border_style p-2">
            <a href="{{route('home')}}" class="nav-link text-light " aria-selected="false">
                <img src="{{ url('images/dashboard (1)@2x.png') }}" class="mr-2" width="15px"/>Dashboard
            </a>
        </li>
        @can('Sales')
            <li class="nav-item nav_border_style p-2">
                <a href="{{route('sale.index')}}" class="nav-link text-light " aria-selected="false">
                    <img src="{{ url('images/icons8-bill-32.png') }}" class="mr-2" width="15px"/>Sales
                </a>
            </li>
        @endcan
        @canany(['Create Customer', 'View Customer', 'Edit Customer', 'Delete Customer'])
        <li class="nav-item nav_border_style p-2">
            <a href="{{route('customer.index')}}" class="nav-link text-light" aria-selected="true">
                <img src="{{ url('images/customer (2)@2x.png') }}" class="mr-2" width="15px"/>Customers
            </a>
        </li>
        @endcan
        @can('Product')
            <li class="nav-item nav_border_style p-2">
                <a href="{{route('product.index')}}" class="nav-link text-light " aria-selected="false">
                    <img src="{{ url('images/file1(3)@2x.png') }}" class="mr-2" width="15px"/>Products
                </a>
            </li>
        @endcan
        @can('Product Category')
            <li class="nav-item nav_border_style p-2">
                <a href="{{route('product-category.index')}}" class="nav-link text-light " aria-selected="false">
                    <img src="{{ url('images/idea@2x.png') }}" class="mr-2" width="15px"/>Product Categories
                </a>
            </li>
        @endcan
        @can('Employee')
        <li class="nav-item nav_border_style p-2">
            <a href="{{route('employee.index')}}" class="nav-link text-light " aria-selected="false">
                <img src="{{ url('images/icons8-employee-64.png') }}" class="mr-2" width="15px"/>Employees
            </a>
        </li>
        @endcan

        @canany(['Leave Report', 'Permission Report', 'Call Details Report', 'Allotment Report', 'Sales Report', 'Service Report', 'Employee Report'])
        <li class="nav-item nav_border_style p-2">
            <a href="#" class="nav-link text-light" data-toggle="collapse"
               data-target="#Report" id="triggerReport">
                <img src="{{ url('images/report (1)@2x.png') }}" class="mr-2" width="15px">Reports<i
                    class="fa-solid fa-angle-down ml-4 pl-2"></i>
            </a>
            <div id="Report" class="collapse">
                <ul class="nav flex-column mb-0 mx-4">

                    @can('Sales Report')
                    <li class="nav-item">
                        <a href="{{ route('reports.salesReport')}}" class="nav-link text-light">
                            Sales
                        </a>
                    </li>
                    @endcan
                    @can('Employee Report')
                    <li class="nav-item">
                        <a href="{{ route('reports.employeeReport')}}" class="nav-link text-light">
                            Employee
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        @endcan

        <li class="nav-item nav_border_style p-2">
            <a href="#" class="nav-link text-light" data-toggle="collapse"
               data-target="#Settings">
                <img src="{{ url('images/settings (2)@2x.png') }}" class="mr-2" width="15px"/>Settings<i
                    class="fa-solid fa-angle-down ml-4 pl-2"></i>
            </a>
            <div id="Settings" class="collapse">
                <ul class="nav flex-column mb-0 mx-4">
{{--                    @can('Product')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('product.index')}}" class="nav-link text-light">--}}
{{--                            Products--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @endcan--}}
                    @can('Role')
                    <li class="nav-item">
                        <a href="{{ route('role.index')}}" class="nav-link text-light">
                            Roles
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
    </ul>
</div>

<!--    Sidebar end-->
