@extends('branch_pastor.reports.app')

@section('content')
    <div class="container pt-2">
        <!-- Page Title -->
        <div class="row mb-4 text-center">
            {{-- <div class="col-6 col-md-4 col-lg-2"> --}}
            <h2 class="fw-bold h2 text-primary">Branch Analytics & Reports</h2>
            <p class="text-muted h5">Monitor your Services, Members, Expenditures and Inflow here.</p>
            {{-- </div> --}}
        </div>
        <!-- Filters Section -->
        <div class="container">
            <div class="row mb-2 g-4# p-2 d-flex justify-content-center text-center form-control">
                <div class="col-12 col-md-6 col-lg-3 fs-4 text-success">
                    <p class="">Filter By:</p>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label class="label" for="duration">Duration</label>
                    <select id="dateFilter" class="form-select" required>
                        <option selected value="">-- Select Duration --</option>
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option selected value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="this_year">This Year</option>
                        <option value="custom_range">Custom Range</option>
                    </select>
                    <div class="dateDiv">
                        <input type="date" id="startDate" class="form-control rounded d-none bg-success text-light mt-2"
                            placeholder="Start Date">
                        <input type="date" id="endDate" class="form-control rounded d-none bg-success text-light mt-2"
                            placeholder="End Date">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-2">
                    <label for="category">Category</label>
                    <select class="form-select onReport" name="category" id="category" required>
                        {{-- <option value="">-- Select Category --</option> --}}
                        <option selected value="inflow">Inflow</option>
                        <option value="services">Services</option>
                        <option value="members">Members</option>
                        <option value="tithes">Tithes</option>
                        <option value="expenditures">Expenditures</option>
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    {{-- <input type="text" class="form-control" placeholder="Search by ID or Name"> --}}
                    <label for="serviceCategory">Service Category</label>
                    <select class="form-select onReport" name="serviceCategory" id="serviceCategory" required>
                        <option selected value="0">All</option>
                        @foreach ($serviceCategories as $serviceCategory)
                            <option value="{{ $serviceCategory->id }}">{{ $serviceCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- Summary Cards -->
        <div class="row mb-2 g-4 justify-content-center text-center">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Average <br> Attendance</h6>
                        <hr>
                        <h3 id="averageAttendance" class="mt-2 fw-bold text-danger">fetching...</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Total <br> Inflow</h6>
                        <hr>
                        <h3 id="totalInflow" class="mt-2 fw-bold text-primary">fetching...</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Total <br> Expenditures</h6>
                        <hr>
                        <h3 id="totalExpenditures" class="mt-2 fw-bold text-warning">fetching...</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title">Total <br> Balance</h6>
                        <hr>
                        <h3 id="totalBalance" class="mt-2 fw-bold text-success">fetching...</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Section -->
        <div class="row mb-2 g-4 justify-content-center text-center">
            <div class="col-12">
                <div class="table-responsive reportTable">
                    <i>Table will appear here!!!</i>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        {{-- <div class="row mb-4 g-4 justify-content-center text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title" id="chartHead">Fetching...</h6>
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <script>
        $(document).ready(function() {
            // var transactionChart = null;
            $('.dateDiv').addClass('hidden');
            var serviceCategory = $('#serviceCategory').val();
            var selectedServiceCategory = $('#serviceCategory').find(':selected').text();
            var category = $('#category').val();
            var selectedCategoryName = $('#category').find(':selected').text();
            const today = new Date();
            const startOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
                .getDay());
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            const startOfLastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            const endOfLastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
            const startOfYear = new Date(today.getFullYear(), 0, 1);

            $(document).ready(function() {
                $('#dateFilter').trigger('change');
            });

            //CAPTURE CATEGORY & MEDICINES FILTERS
            $('#category').on('change', function() {
                category = $(this).val();
                selectedCategoryName = $(this).find(':selected').text();
                $('#dateFilter').trigger('change');
            });

            $('#serviceCategory').on('change', function() {
                serviceCategory = $(this).val();
                selectedServiceCategory = $(this).find(':selected').text();
                $('#dateFilter').trigger('change');
            });

            // Handle filter changes
            $('#dateFilter').on('change', function() {
                const value = $(this).val();
                // console.log(value);
                $('#startDate, #endDate').addClass('d-none');

                switch (value) {
                    case 'today':
                        // console.log('Filtering for Today');
                        filterData(formatDate(today), formatDate(today), category, serviceCategory);
                        break;
                    case 'this_week':
                        // console.log('Filtering for This Week');
                        filterData(formatDate(startOfWeek), formatDate(new Date()), category,
                            serviceCategory);
                        break;
                    case 'this_month':
                        // console.log('Filtering for This Month');
                        filterData(formatDate(startOfMonth), formatDate(new Date()), category,
                            serviceCategory);
                        break;
                    case 'last_month':
                        // console.log('Filtering for Last Month');
                        filterData(formatDate(startOfLastMonth), formatDate(endOfLastMonth), category,
                            serviceCategory);
                        break;
                    case 'this_year':
                        // console.log('Filtering for This Year');
                        filterData(formatDate(startOfYear), formatDate(new Date()), category,
                            serviceCategory);
                        break;
                    case 'custom_range':
                        // console.log('Custom Range Selected');
                        $('.dateDiv').removeClass('hidden');
                        $('#startDate, #endDate').removeClass('d-none');
                        break;
                }
            });

            // Listen for custom date range inputs
            $('#startDate, #endDate').on('change', function() {
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                if (startDate && endDate) {
                    // console.log(`Filtering from ${startDate} to ${endDate}`);
                    filterData(startDate, endDate, category, serviceCategory);
                }
            });
            // Format date to YYYY-MM-DD
            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            // Example filterData function
            function filterData(start, end, category, serviceCategory) {
                $('#loader-overlay').show(); // show loader initially
                // var transactionChart = null;
                // Add your AJAX request or data filtering logic here
                $.ajax({
                    url: '/branch_pastor/reports/filter',
                    method: 'GET',
                    data: {
                        start: start,
                        end: end,
                        category: category,
                        serviceCategory: serviceCategory
                    },
                    dataType: 'json',
                    success: function(response) {
                        //capture response type
                        if (response.success) {
                            console.log(response);
                            // Update the summary cards with 0 decimal points
                            $('#averageAttendance').text(new Intl.NumberFormat().format(response
                                .averageAttendance));

                            $('#totalInflow').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalInflow));

                            $('#totalExpenditures').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalExpenditures));

                            $('#totalBalance').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalBalance));

                            //place the table into block with id="reportsTable", use returned data on bases of category filtered
                            //start with table when category if inflow
                            //     var salesTable = `
                        //         <table class="table table-striped table-bordered table-hover reportsTable">
                        //             <thead>
                        //                 <tr>
                        //                     <th>#</th>
                        //                     <th>Date</th>
                        //                     <th>Medicine</th>
                        //                     <th>Quantity</th>
                        //                     <th>Total Sales</th>
                        //                     <th>Total profit</th>
                        //                 </tr>
                        //             </thead>
                        //             <tbody>
                        //                 ${response.sales.map((sale, index) => `
                            //                                                                                                             <tr>
                            //                                                                                                                 <td>${index + 1}</td>
                            //                                                                                                                 <td>${sale.date}</td>
                            //                                                                                                                 <td class="text-left">${sale.item['name']}</td>
                            //                                                                                                                 <td>${sale.quantity}</td>
                            //                                                                                                                 <td>${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(sale.quantity*sale.stock['selling_price'])}</td>
                            //                                                                                                                 <td>${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(sale.quantity*(sale.stock['selling_price']-sale.stock['buying_price']))}</td>
                            //                                                                                                             </tr>
                            //                                                                                                         `).join('')}
                        //                     ${response.sales.length == 0 ? ` <tr> <td colspan="6" class="text-center">No data found</td> </tr> ` : ''}
                        //             </tbody>
                        //         </table>
                        //     `;

                            //     //lets implement table when category is stocks, the stocks table should list (serial number(#), Batch number, stocked quantity, remained quantity, total sales amount made, total profit made, and total expired loss amount)
                            //     var stocksTable = `
                        //         <table class="table table-striped table-bordered table-hover reportsTable">
                        //             <thead>
                        //                 <tr>
                        //                     <th>#</th>
                        //                     <th>Batch Number</th>
                        //                     <th>Medicine</th>
                        //                     <th>Stocked Quantity</th>
                        //                     <th>Remained Quantity</th>
                        //                     <th>Total Sales</th>
                        //                     <th>Total Profit</th>
                        //                     <th>Expired Loss</th>
                        //                 </tr>
                        //             </thead>
                        //             <tbody>
                        //                 ${response.stocks.map((stock, index) => `
                            //                                                                                                             <tr>
                            //                                                                                                                 <td>${index + 1}</td>
                            //                                                                                                                 <td>${stock.batch_number}</td>
                            //                                                                                                                 <td class="text-left">${stock.item['name']}</td>
                            //                                                                                                                 <td>${stock.quantity}</td>
                            //                                                                                                                 <td>${stock.remain_Quantity}</td>
                            //                                                                                                                 <td>${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(stock.selling_price*(stock.quantity-stock.remain_Quantity))}</td>
                            //                                                                                                                 <td>${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format((stock.quantity-stock.remain_Quantity)*(stock.selling_price-stock.buying_price))}</td>
                            //                                                                                                                 ${stock.expire_date < today ? `<td>${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(stock.buying_price*stock.remain_Quantity)}</td>`:`<td>0</td>`}
                            //                                                                                                             </tr>`).join('')}
                        //                     ${response.stocks.length == 0 ? `<tr><td colspan="8" class="text-center">No data found</td></tr>` : ''}
                        //             </tbody>
                        //         </table>
                        //     `;


                            //     //place the table into block with id="reportsTable", use returned data on bases of category filtered
                            //     if (category == 'sales') {
                            //         $('.reportTable').html(salesTable);
                            //         //append footer with total profit to the table after the tbody
                            //         //capture the table body object to append the footer
                            //         var tableBody = $('.reportTable').find('tbody');
                            //         //append the footer to the table
                            //         tableBody.after(`
                        //         <tfoot>
                        //             <tr>
                        //                 <td colspan="4" class="text-end fw-bolder fs-5">Total Profit</td>
                        //                 <td colspan="1" class="text-center fw-bolder" id="">${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(response.totalSales)}</td>
                        //                 <td colspan="1" class="text-center fw-bolder" id="">${new Intl.NumberFormat('en-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(response.totalProfit)}</td>
                        //             </tr>
                        //         </tfoot>
                        //     `);
                            //     } else if (category == 'stocks') {
                            //         $('.reportTable').html(stocksTable);
                            //     }
                        } else {
                            // Update the summary cards with 0 decimal points
                            $('#averageAttendance').text(new Intl.NumberFormat().format(response
                                .averageAttendance));

                            $('#totalInflow').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalInflow));

                            $('#totalExpenditures').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalExpenditures));

                            $('#totalBalance').text(new Intl.NumberFormat('en-TZ', {
                                style: 'currency',
                                currency: 'TZS',
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }).format(response.totalBalance));
                            console.log(response);
                        }

                        // Initialize DataTable, but count the number of rows in the table first, if it is greater than 0, then destroy the table and reinitialize it, otherwise skip the initialization
                        if (response.rows > 0) {
                            $('.reportsTable').DataTable().destroy(); // Destroy the old table
                            $('.reportsTable').DataTable({
                                paging: true, // Enable paging
                                searching: true, // Enable search bar
                                ordering: true, // Enable column sorting
                                info: true, // Enable information display
                                dom: 'Bfrtip', // Add Buttons to the table
                                buttons: [{
                                        extend: 'csvHtml5',
                                        title: 'Reports',
                                        text: 'Download CSV',
                                        className: 'btn btn-primary reportsDownloadButton'
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        title: 'Reports',
                                        text: 'Download PDF',
                                        className: 'btn btn-secondary reportsDownloadButton',
                                        orientation: 'portrait', // Landscape orientation for PDF
                                        pageSize: 'A4' // A4 page size
                                    }
                                ],
                                error: function(settings, helpPage, message) {
                                    console.error('DataTables Error:',
                                        message); // Log the error to the console
                                    // Optionally handle specific errors here
                                }
                            });
                        }
                    },
                    complete: function() {
                        $('#loader-overlay').hide(); // Hide loader
                    },
                    error: function() {
                        $('#loader-overlay').hide(); // Hide loader
                        alert('Failed to filter Reports.');
                    }
                });



            }
        });
    </script>
@endsection
