 <div class="navbar navbar-inverse navbar-fixed-top sb-slide" role="navigation" style="margin-bottom: 0px;">
        <div class="container">
            <div class="navbar-header" style="width: 100%; margin-left:0px; margin-right:0px;">
                <span class="pull-left" style="margin: 2px 0 0 0px; font-size:22px;color:white;">
                        <img class="custom-sb-toggle-left" src="assets/images/button-menu.png" width="24">
                    </span>
                <div style="display: inline-block; width: 60%; text-align: center;">
                    <a href="index.php" style="">
                        <img src="assets/images/hijab-jogja-store-logo.png" />
                    </a>
                </div>

                <div class="pull-right" style="margin-top: 12px; margin-right: 0px;position: relative; display: inline-block;">
                    <?php
                    $sid = session_id();
                    $sql = mysql_query("SELECT * FROM orders_temp, product
                    WHERE id_session='$sid' AND orders_temp.product_id=product.product_id");
                    $ketemu=mysql_num_rows($sql);

                    ?>
                    <a href="cart" style="color: white;"><span class="glyphicon glyphicon-shopping-cart" style="font-size: 22px;"></span>
                    <?php
                    if($ketemu == 0){}else{
                        while($data_order=mysql_fetch_array($sql)){
                            $total_order=$total_order + $data_order['jumlah'];
                        }
                    ?>
                     <span class="badge" style="position: absolute; top:-5px;right:-5px;background-color: orange;"><?php echo $total_order; ?></span> 
                    <?php
                    }
                    ?></a>
                </div>

                <div class="muted pull-right" style="margin-top: 12px; margin-right: 20px; display: inline-block;">
                    <span class="glyphicon glyphicon-heart-empty" style="font-size: 22px;"></span> </div>

            </div>
        </div>
    </div>
