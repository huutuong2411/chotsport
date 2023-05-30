@extends('admin.layout.main')
@section('content')
	
 <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">THỐNG KÊ - BÁO CÁO</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                Doanh thu tháng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($Monthrevenue, 0, '.', ',')}} đ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-success text-uppercase mb-1">
                                                 Doanh thu năm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($Yearrevenue, 0, '.', ',')}} đ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <a href="{{route('admin.product')}}">
                                  <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-info text-uppercase mb-1">
                                                Sản phẩm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allproduct}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-shoe-prints fa-2x text-gray-300"></i>
                                            
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <a href="{{route('admin.order')}}">
                                  <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-warning text-uppercase mb-1">
                                                Đơn hàng mới</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$neworder}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-truck fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                         <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <a href="{{route('admin.user')}}">
                                  <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-secondary text-uppercase mb-1">
                                                Thành viên</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customer}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                         <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <a href="{{route('admin.blog')}}">
                                  <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-danger text-uppercase mb-1">
                                                Bài viết</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allblog}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-newspaper fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                         
                         
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ doanh thu</h6>
                                         <!-- doanh thu theo từng năm -->
                                        <span>Thống kê theo năm:</span>
                                        
                                            <select class="form-control form-control-sm col-2" name="" id="changeYear">
                                                               @foreach($listyears as $value)
                                                               <option value="{{$value->year}}">{{$value->year}}</option>
                                                               @endforeach
                                            </select>                 
                                         <!-- doanh thu theo từng tháng -->
                                        <span>Thống kê theo tháng:</span>
                                        
                                            <select class="form-control form-control-sm col-2" name="" id="changeMonth">
                                                                <option value="">--Chọn--</option>
                                                                <option value="january">Tháng 1</option>
                                                                <option value="february">Tháng 2</option>
                                                                <option value="march">Tháng 3</option>
                                                                <option value="april">Tháng 4</option>
                                                                <option value="may">Tháng 5</option>
                                                                <option value="june">Tháng 6</option>
                                                                <option value="july">Tháng 7</option>
                                                                <option value="august">Tháng 8</option>
                                                                <option value="september">Tháng 9</option>
                                                                <option value="october">Tháng 10</option>
                                                                <option value="november">Tháng 11</option>
                                                                <option value="december">Tháng 12</option>
                                        </select>
                                       
                                                           
                                    
                                    <!-- kết thúc doanh thu theo từng tháng -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Trạng thái đơn hàng</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Đơn hàng mới
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Đang giao
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Đã hoàn thành
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Đã huỷ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                   
                    <!-- Bar Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Top 10 sản phẩm bán chạy nhất</h6>
                            <span>Thống kê theo năm:</span>
                                        
                                            <select class="form-control form-control-sm col-2" name="" id="bestsellerYear">
                                                               @foreach($listyears as $value)
                                                               <option value="{{$value->year}}">{{$value->year}}</option>
                                                               @endforeach
                                            </select>                 
                                         <!-- doanh thu theo từng tháng -->
                                        <span>Thống kê theo tháng:</span>
                                        
                                            <select class="form-control form-control-sm col-2" name="" id="bestsellerMonth">
                                                                <option value="">--Chọn--</option>
                                                                <option value="01">Tháng 1</option>
                                                                <option value="02">Tháng 2</option>
                                                                <option value="03">Tháng 3</option>
                                                                <option value="04">Tháng 4</option>
                                                                <option value="05">Tháng 5</option>
                                                                <option value="06">Tháng 6</option>
                                                                <option value="07">Tháng 7</option>
                                                                <option value="08">Tháng 8</option>
                                                                <option value="09">Tháng 9</option>
                                                                <option value="10">Tháng 10</option>
                                                                <option value="11">Tháng 11</option>
                                                                <option value="12">Tháng 12</option>
                                        </select>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>   
                        </div>
                    </div>
                    <!-- end barchart -->
                    <div class="row">

                        <!-- Content Column -->
                       

                        <div class="col-lg-8 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Đơn hàng chờ xử lý 7 ngày gần nhất</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="display: none">id</th>
                                            <th  class="col-1">Mã đơn hàng</th>
                                            <th class="col-1">Khách hàng</th>
                                            <th class="col-1">Số điện thoại</th>
                                            <th class="col-2">Phương thức thanh toán</th>
                                            <th class="col-1">Trạng thái</th>
                                            <th class="col-1">Ngày đặt</th>
                                            <th class="col-2" style="text-align: center;">Xử lý</th>
                                            <th class="col-1" style="text-align: center">Chi tiết</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                      @foreach($orderofweek as $value)  
                                        <tr>   
                                            <td class="id_order" style="display: none">{{$value->id}}</td>
                                            <th scope="row" >{{$value->order_code}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td class="name">{{$value->phone}}</td>
                                            <td class="name">{{$value->payment_status==0?"Thanh toán sau khi nhận hàng":"Thanh toán online"}}</td>
                                            <td class="name">
                                              @if($value->status==0)
                                                <span class="badge badge-info">Chờ xác nhận</span>
                                              @elseif($value->status==1)
                                                <span class="badge badge-warning">Đã xác nhận</span>
                                              @elseif($value->status==2)
                                                <span class="badge badge-success">Đã nhận hàng</span>
                                              @elseif($value->status==3)
                                                <span class="badge badge-danger">Đã huỷ</span>
                                              @endif
                                            </td>
                                            <td class="name" data-sort="{{$value->created_at}}">{{$value->created_at}}</td>
                                            <td class="name">
                                                <form action="{{route('admin.order.change',['id'=>$value->id])}}" method="post">
                                                    @csrf
                                                        <select class="form-select form-control" name="status" id="speed" onchange="this.form.submit()">
                                                            <option class="btn btn-info"  value="0" {{$value->status==0?'selected':''}}>Chờ xác nhận</option>
                                                            <option class="btn btn-warning"  value="1" {{$value->status==1?'selected':''}}>Xác nhận đơn hàng</option>
                                                            <option class="btn btn-danger"  value="3" {{$value->status==3?'selected':''}}>Huỷ đơn hàng</option>
                                                            <option class="btn btn-success"  value="2" {{$value->status==2?'selected':''}}>Đã giao hàng</option>
                                                        </select>
                                                </form>
                                            </td>
                                           
                                            <td style="text-align: center">
                                                <a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm showorder" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>





<script type="text/javascript">
 
$(document).ready(function(){
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Đơn hàng mới","Đang giao","Đã hoàn thành","Đã huỷ"],
        datasets: [{
          data: [{{$neworder}},{{$pendingorder}},{{$successorder}},{{$cancelorder}}],
          backgroundColor: ['#36b9cc','#f6c23e','#1cc88a','#e74a3b'],
          hoverBackgroundColor: ['#2c9faf','#f4b619','#17a673','#e02d1b'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });




    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
        datasets: [{
          label: "Doanh thu",
          lineTension: 0.3,
          backgroundColor: "rgba(246,194,62, 0.05)",
          borderColor: "rgba(246,194,62,1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(246,194,62,1)",
          pointBorderColor: "rgba(246,194,62,1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(246,194,62,1)",
          pointHoverBorderColor: "rgba(246,194,62,1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: {!! json_encode($monthEarn) !!},
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 31
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              minTicksLimit:1,
              min: 0,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return  number_format(value)+'đ';
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ':' + number_format(tooltipItem.yLabel)+'đ';
            }
          }
        }
      }
    });


    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels:{!! json_encode($listproduct) !!},
            datasets: [{
              label: "Đã bán",
              backgroundColor: "#1cc88a",
              hoverBackgroundColor: "#17a673",
              borderColor: "#1cc88a",
              data: {!! json_encode($soldqty) !!},
               maxBarThickness: 20,
          }],
      },
    options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        yAxes: [{
            time: {
              unit: 'month'
          },
          gridLines: {
              display: false,
              drawBorder: false
          },
          ticks: {
              maxTicksLimit: 9,
              min:0
          },
         
        }],

        xAxes: [{
            ticks: {
              min: 0,
              maxTicksLimit: 5,
              stepSize: 1,
              padding: 10,
                      // Include a dollar sign in the ticks
                      callback: function(value, index, values) {
                        return value;
                    }
                },
                gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
              }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel+':'  + tooltipItem.xLabel;
                }
            }
        },
    }
    });



    // xử lý thống kê theo năm
      $('#changeYear').change(function(){
        var year=$(this).val();
        $('#changeMonth').val("");
        // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('admin.dashboard.earning') }}', // đường dẫn đến controller
            method: 'GET', // phương thức POST
            data: { // dữ liệu gửi đi
                year: year, // giá trị value Year
            },
            success: function(data){ // nhận kết quả trả về
                myLineChart.data.datasets[0].data = data;
                myLineChart.data.labels= ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                myLineChart.update();
            }
        }); // đấu đóng ajax
      });

    // xử lý thống kê theo tháng trong năm
      $('#changeMonth').change(function(){
        var month=$(this).val();
        var year=$('#changeYear').val();
        // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('admin.dashboard.earning') }}', // đường dẫn đến controller
            method: 'GET', // phương thức GET
            data: { // dữ liệu gửi đi
                month: month, // giá trị value month
                year: year, // giá trị value Year
            },
            success: function(data){ // nhận kết quả trả về
                console.log(data);
                if(data.listday){
                myLineChart.data.datasets[0].data = data.dayEarn;
                myLineChart.data.labels= data.listday;
                }else{ // nếu không chọn month thì dữ liệu sẽ trả về doanh thu năm
                  myLineChart.data.datasets[0].data = data;
                  myLineChart.data.labels= ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];  
                }

                myLineChart.update();
            }
        }); // đấu đóng ajax
        
      });

    


      // xử lý bán chạy theo năm
    $('#bestsellerYear').change(function(){
        var year=$(this).val();
        $('#bestsellerMonth').val("");
        // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('admin.dashboard.bestseller') }}', // đường dẫn đến controller
            method: 'GET', // phương thức GET
            data: { // dữ liệu gửi đi
                year: year, // giá trị value Year
            },
            success: function(data){ // nhận kết quả trả về
                myBarChart.data.datasets[0].data = data.soldqty;
                myBarChart.data.labels= data.listproduct;

                myBarChart.update();
            }
        }); // đấu đóng ajax
        
        });



     // xử lý bán chạy theo tháng trong năm
      $('#bestsellerMonth').change(function(){
        var month=$(this).val();
        var year=$('#bestsellerYear').val();
        // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('admin.dashboard.bestseller') }}', // đường dẫn đến controller
            method: 'GET', // phương thức GET
            data: { // dữ liệu gửi đi
                month: month, // giá trị value month
                year: year, // giá trị value Year
            },
            success: function(data){ // nhận kết quả trả về
                console.log(data);
                myBarChart.data.datasets[0].data = data.soldqty;
                myBarChart.data.labels= data.listproduct;

                myBarChart.update();
            }
        }); // đấu đóng ajax
        
       
      });


    //xử lý show order_detail
    $('.showorder').click(function(){
        var id_order=$(this).closest('tr').find('td.id_order').text();
        // Bắt đầu gửi AJAX
        $.ajax({
            url:"{{ route('admin.order') }}" + '/' + id_order,
            method: 'GET', // phương thức GET
            data: { // dữ liệu gửi đi
               
            },
            success: function(data){ // nhận kết quả trả về
                console.log(data);
            }
        }); // đấu đóng ajax
        
    });




}); // dấu đóng hàm ready

</script>
@endsection