
    <div class="sb-slidebar sb-left" style="overflow-x:hidden">
        <div class="row">
            <div class="col-xs-12 sidebar-offcanvas" id="sidebar" role="navigation">

                <br>

                <div class="container" style="margin-bottom: 10px;">
                    <form action="#" class="form-inline" id="search-form">
                        <div class="input-group">
                            <input type="text" name="q" placeholder="Cari produk" class="form-control">
                            <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                        </div>
                    </form>
                </div>

                <!-- <div class="container marketing">
                    <span class="text-muted">Halo <small>edyuty@gmail.com</small></span>
                </div> -->

                <ul class="left-menu">
                    <!-- <li class="">
                        <a href="#" data-toggle="modal" data-target="#redeem-modal" id="trigger-reedem">
                                    Punya Kode Voucher?
                                </a>
                    </li> -->

                    <li role="separator" class="divider"></li>

                    <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> HOME</a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="#">Product Terlaris</a></li>

                    <li><a href="#">Promo</a></li>

                    <li><a href="#">Diskon</a></li>

                    <li><a href="#">Sould Out</a></li>

                    <li><a href="#">Ready Stock</a></li>

                    <li><a href="#">All Product</a></li>

                    <!-- <li><a href="#" onclick="#">Sale, Sale, Sale &rsaquo;</a></li>
 -->
                    <li role="separator" class="divider"></li>
                    <li class=""><a href="index.php"><span class="glyphicon glyphicon-list-alt"></span> CATEGORY BRAND</a></li>
                    <li role="separator" class="divider"></li>
                    <?php
                    $sql_category_brand="select * from brand";
                    $sql_category_brand_result=mysql_query($sql_category_brand);
                    while($data_category_brand=mysql_fetch_array($sql_category_brand_result)){
                    ?>
                     <li><a href="#"><?php echo $data_category_brand['brand_name']; ?></a></li>
                    <?php
                    }
                    ?>

                    <li role="separator" class="divider"></li>
                    <li class=""><a href="index.php"><span class="glyphicon glyphicon-th-list"></span> CATEGORY WARNA HIJAB </a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown  ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-question-sign"></span> Pusat Bantuan <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-custom" role="menu">

                            <li><a href="cara-pemesanan.html">Cara Pemesanan</a></li>
                            <li><a href="persyaratan-dan-ketentuan.html">Persyaratan & Ketentuan</a></li>
                            <li><a href="kebijakan-privasi.html">Kebijakan Privasi</a></li>

                        </ul>

                    </li>
                    <li role="separator" class="divider"></li>
                    <li class=""><a href="tentang-kami.html"><span class="glyphicon glyphicon-tags"></span> TENTANG KAMI </a></li>
                    <li role="separator" class="divider"></li>
                    <li class=""><a href="contact-kami.html"><span class="glyphicon glyphicon-phone-alt"></span> CONTACT KAMI </a></li>
                    <li role="separator" class="divider"></li>

                </ul>

                <p>&nbsp;</p>

            </div>
        </div>
    </div>