        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget">
                            <div class="dash-widgetimg">
                                <span><img src="public/admin/icon/dash1.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5><span class="counters" data-count="<?php echo $data['tongdon']; ?>"></span> đơn</h5>
                                <h6>Số đơn trong tháng</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash1">
                            <div class="dash-widgetimg">
                                <span><img src="public/admin/icon/dash2.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5><span class="counters" data-count="<?php echo $data['doanhthu'][0]['total_sum']; ?>"></span> VNĐ</h5>
                                <h6>Danh thu trong tháng</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash2">
                            <div class="dash-widgetimg">
                                <span><img src="public/admin/icon/dash4.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5><span class="counters" data-count="<?php if($data['don_hang'] < 0){
                                    echo 0;
                                }else{
                                    echo $data['don_hang'];
                                }  ?>"></span> đơn</h5>
                                <h6>Đơn hàng tăng so với tháng trước</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash3">
                            <div class="dash-widgetimg">
                                <span><img src="public/admin/icon/dash3.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5><span class="counters" data-count="<?php if($data['don_hang'] < 0){
                                    echo abs($data['don_hang']);
                                }else{
                                    echo 0;
                                } ?>"></span> đơn</h5>
                                <h6>Đơn hàng giảm so với tháng trước</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count">
                            <div class="dash-counts">
                                <h4><?php echo $data['sanpham_saphet']; ?></h4>
                                <h5>Sản phẩm sắp hết</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1">
                            <div class="dash-counts">
                                <h4><?php echo $data['sanpham_dahet']; ?></h4>
                                <h5>Sản phẩm đã hết</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Ngăn chặn người sử dụng không có quyền truy cập vào quyền quản lý -->
                    <?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['xl_donhang'])){ ?>
                        <div class="col-lg-3 col-sm-6 col-12 d-flex">
                            <div class="dash-count das2">
                                <div class="dash-counts">
                                    <h4><?php echo $data['donhang_canxuly']; ?></h4>
                                    <h5><a href="index.php?c=order&a=hum" style="color:white;">Đơn hàng đang chờ duyệt</a></h5>
                                </div>
                                <div class="dash-imgs">
                                    <i data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 d-flex">
                            <div class="dash-count das3">
                                <div class="dash-counts">
                                    <h4><?php echo $data['donhang_huy'] ?></h4>
                                    <h5><a href="index.php?c=order&a=humdele" style="color:white;">Đơn hàng đã huỷ</a></h5>
                                </div>
                                <div class="dash-imgs">
                                    <i data-feather="file"></i>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="col-lg-7 col-sm-12 col-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Bán chạy & Bán chậm</h5>
                                <div class="graph-sets">
                                    <ul>
                                        <li>
                                            <span>Bán chạy</span>
                                        </li>
                                        <li>
                                            <span>Bán chậm</span>
                                        </li>
                                    </ul>
                                    <div class="dropdown">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            2022 <img src="public/admin/icon/dropdown.svg" alt="img" class="ms-2">
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="sales_charts"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Ngăn chặn người dùng không có quyền quản lý sản phẩm -->
                    <div class="col-lg-5 col-sm-12 col-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Những sản phẩm bán chạy</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive dataview">
                                    <table class="table datatable ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng bán</th>
                                                <th>Tổng giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($data['product'] AS $pro){ ?>
                                            <tr>
                                                <td><?php echo $pro['id']; ?></td>
                                                <td class="productimgname">
                                                    <a href="index.php?product_detail&a=show&id=<?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['ql_san_pham'])){ echo $pro['id']; }?>" class="product-img">
                                                        <img src="public/uploads/<?php echo $pro['img']; ?>" alt="product">
                                                    </a>
                                                    <a href="index.php?product_detail&a=show&id=<?php if ($_SESSION['account']['level'] == 1 || isset($_SESSION['Quyen']['ql_san_pham'])){ echo $pro['id']; }?>"><?php echo $pro['namePro']; ?></a>
                                                </td>
                                                <td><?php echo number_format($pro['total_quanity']); ?></td>
                                                <td><?php echo number_format($pro['total_price']); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>