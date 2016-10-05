<?php
//start session
ob_start();
session_start();
error_reporting(0);
//require system files
include "josys/koneksi.php";
include "josys/class_paging.php";
include "josys/paging.php";
include "josys/library.php";
include "josys/fungsi_indotgl.php";
include "josys/fungsi_rupiah.php";
include "josys/fungsi_input.php";
//include template
include "breadcumb.php";
include "template.php";
ob_end_flush();
