<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('admin/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link rel="icon" href="{{asset('logo_chot.ico')}}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- viết jquery add class active -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        
        $('table.display').dataTable( {
            "aLengthMenu": [[5,10,20,50,-1], [5,10,20,50, "All"]],
            "pageLength": 5,
            } );
        $('#dataTable').dataTable( {
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
            } );
        
        });

    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- navbar content -->
                 @include('admin.layout.header')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" nếu bạn muốn kết thúc phiên đăng nhập</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('admin.logout')}}">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('admin/assets/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('admin/assets/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('admin/assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('admin/assets/js/demo/chart-bar-demo.js')}}"></script>
    <script src="{{asset('admin/assets/js/demo/datatables-demo.js')}}"></script> 
   
</body>

</html>




