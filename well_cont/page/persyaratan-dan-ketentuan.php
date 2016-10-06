    <div id="sb-site">
        <div class="overlay-background"></div>
        <h2 class="text-center">Persyaratan & KEtentuan</h2>
        <hr>

        <div class="row-fluid">
       
            <div class="col-md-12 no-pd">
                <div class="container">
        <h5 class="featurette-heading">
       <?php
       $sql="SELECT * FROM mod_page WHERE id_page='14'";
       $result=mysql_query($sql);
       while($data=mysql_fetch_array($result)){
       echo $data['isi'];
       }
       ?>         
        </h5>
        </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>