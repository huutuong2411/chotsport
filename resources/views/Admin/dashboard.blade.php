@extends('admin.layout.main')
@section('title')
Thống kê - Báo Cáo
@endsection
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
                                            <i class="fas fa-solid fa-coins fa-2x text-gray-300"></i>
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
                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Đơn hàng chờ xử lý 7 ngày gần nhất</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="mytable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="display: none">id</th>
                                            <th  class="col-1">Mã đơn hàng</th>
                                            <th class="col-1">Khách hàng</th>
                                            <th class="col-1">Số điện thoại</th>
                                            <th class="col-2">Phương thức thanh toán</th>
                                            <th class="col-1">Trạng thái</th>
                                            <th class="col-1">Ngày đặt</th>
                                            @if(Auth::user()->id_role==1)
                                            <th class="col-2" style="text-align: center;">Xử lý</th>
                                            @endif
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
                                            <td class="name" data-sort="{{$value->created_at}}">{{date('d/m/Y', strtotime($value->created_at))}}</td>
                                            @if(Auth::user()->id_role==1)
                                            <td class="name">
                                                <form action="{{route('admin.order.change',['id'=>$value->id])}}" method="post">
                                                    @csrf
                                                        <select class="form-select form-control" name="status" id="speed" onchange="this.form.submit()">
                                                            <option selected class="btn">---chọn---</option>
                                                             @if($value->status==0)
                                                                <option class="btn btn-warning" value="1">Xác nhận đơn hàng</option>
                                                                <option class="btn btn-danger"  value="3">Huỷ đơn hàng</option>
                                                              @elseif($value->status==1)
                                                                <option class="btn btn-success" value="2">Đã giao hàng</option>
                                                                <option class="btn btn-danger" value="3">Huỷ đơn hàng</option>
                                                              @endif
                                                        </select>
                                                </form>
                                            </td>
                                            @endif
                                            <td style="text-align: center">
                                                <a type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-info btn-circle btn-sm showorder" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tài khoản 7 ngày gần nhất</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center">ID</th>
                                            <th class="col-2" style="text-align: center">Tên</th>
                                            <th class="col-1" style="text-align: center">Avatar</th>
                                            <th class="col-2" style="text-align: center">Email</th>
                                            <th class="col-2" style="text-align: center">Vai trò</th>
                                            <th class="col-2" style="text-align: center">Trạng thái</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($userofweek as $value)  
                                        <tr>   
                                            <th scope="row" style="text-align: center">{{$value->id}}</th>
                                            <td class="name" style="text-align: center">{{$value->name}}</td>
                                            <td class="name" style="text-align: center">
                                            @if($value->id_role==1)
                                               <img style="width: 90%" src="{{asset('admin/assets/img/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @else
                                                <img style="width: 90%" src="{{asset('user/assets/images/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @endif
                                            </td>
                                            <td class="name" style="text-align: center">{{$value->email}}</td>
                                            <td class="name" style="text-align: center">
                                                @if($value->id_role==1)
                                                <span class="badge badge-success">Quản trị viên</span>
                                                @elseif($value->id_role==2)
                                                 <span class="badge badge-warning">Người dùng</span>
                                                @elseif($value->id_role==3)
                                                 <span class="badge badge-info">Nhân viên</span>
                                                @endif
                                            </td>
                                             <td class="name" style="text-align: center">
                                                @if($value->status==0)
                                                <span class="badge badge-success">Kích hoạt</span>
                                                @else
                                                <span class="badge badge-danger">Vô hiệu hoá</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a href="{{route('admin.user.show',['id'=>$value->id])}}" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                @if(Auth::user()->id_role==1)
                                                @if($value->status==0)
                                                <a href="{{route('admin.user.disable',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%" title="Vô hiệu hoá"><i class="fas fa-sharp fa-solid fa-ban"></i></a>
                                                @else
                                                <a href="{{route('admin.user.enable',['id'=>$value->id])}}" class="btn btn-success btn-circle btn-sm" style="margin-left:2%" title="kích hoạt"><i class="fas fa-solid fa-check"></i></a>
                                                @endif
                                                @endif
                                            </td>
                                        </tr>
                                      @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

<div class="modal bd-example-modal-lg" id="showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style='max-width: 80%;'>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Duyệt đơn hàng</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
 
$(document).ready(function(){
    $('#mytable').dataTable( {
            order: [[0, 'desc']],
            "aLengthMenu": [[5,10,20,50,-1], [5,10,20,50, "All"]],
            "pageLength": 5,
            "language": {
            "lengthMenu": "Hiển thị _MENU_ hàng",
            "zeroRecords": "Nothing found - sorry",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
           "search":         "Tìm kiếm:",
           "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       ">",
                    "previous":   "<"
                },
            },
    });

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
                if(data != ""){
                    var date = moment(data.order.created_at).format('DD/MM/YYYY'); // định dạng lại ngày
                    var sum_money = data.order.sum_money.toLocaleString('en-US');
                    var note = data.order.note !== null ? data.order.note : "Không";
                    var payment_status= data.order.payment_status==0? "Thanh toán sau khi nhận hàng":"Thanh toán online (đã thanh toán)";
                    $('#showdetail').find('.modal-body').html(
                        "<div class='card shadow mb-4'>"+
                            "<div class='card'>"+
                                "<div class='card-body'>"+
                                    "<h6>Mã đơn hàng:"+data.order.order_code+"</h6>"+
                                    "<article class='card mb-4 py-3 border-left-info'>"+
                                        "<div class='card-body row'>"+
                                            "<div class='col'> <strong>Ngày mua:</strong><br>"+date+"</div>"+
                                            "<div class='col'> <strong>Thôn tin nhận hàng</strong> <br>"+data.order.name+"  | <i class='fa fa-phone'></i>"+data.order.phone+"</div>"+
                                            "<div class='col'> <strong>Trạng thái:</strong> <br>"+
                                                "<span class='badge badge-info'>Chờ xác nhận</span>"+
                                            "</div>"+
                                            "<div class='col'> <strong>Phương thức thanh toán:</strong> <br>"+payment_status+"</div>"+
                                            "<div class='col'> <strong>Tổng tiền:</strong> <br>"+sum_money+"đ</div>"+
                                        "</div>"+
                                        "<div class='card-body row'>"+
                                            "<div class='col-12'> <strong>Địa chỉ nhận hàng:</strong>"+data.full_address+"</div>"+
                                            "<div class='col-12'> <strong>Ghi chú:</strong> "+note+"</div>"+
                                        "</div>"+
                                    "</article>"+
                                    "<hr>"+
                                    "<ul class='row' style='list-style-type:none;'>"+
                                    "</ul>"+
                                   "<hr>"+
                               "</div>"+     
                           "</div>"+
                       "</div>"
                        );
                    $.each(data.orderDetail, function(key, value) {
                        var price = value.price.toLocaleString('en-US');
                        var image = JSON.parse(value.image);
                        var URL="{{url('admin/assets/img/product/')}}"+"/"+value.id_product+"/"+image[0];
                            $('#showdetail').find('.modal-body').find('ul.row').append(
                                "<li class='col-md-6'>"+
                                            "<div class='row col-12'>"+
                                                "<div class='col-4'>"+
                                                    "<label><img src='"+URL+"' style='width:66%'><span>×"+value.qty+" </span></label>"+
                                                "</div>"+
                                                "<div class='col-8' style='padding:0'>"+value.product_name+
                                                   "<br>"+
                                                   "<span style='font-size: 13px'>Kích thước:"+value.size_name+"</span>"+
                                                   "<br>"+
                                                   "<span>"+price+"</span>"+
                                               "</div>"+
                                           "</div>"+
                                       "</li>"
                                );
                    
                    });
                }
               
            }
        }); // đấu đóng ajax
        
    });


}); // dấu đóng hàm ready

</script>
@endsection





                           
                            
