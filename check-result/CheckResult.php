<?php include('setupDB.php'); ?>
<?php
$loaive = 1000;
$loaigiai = "GIẢI ĐẶC BIỆT";
$tenkhachhang = "?????";
$sdt = "?????";
$diachi = "?????";
$tiengiai = 0;
if (!isset($_REQUEST['loaive']) || !isset($_REQUEST['loaigiai'])) {
    echo '<script>window.location.href = "CheckResult.php?loaive=1000&loaigiai=dacbiet";</script>';
    $loaive = 1000;
    $loaigiai = "GIẢI ĐẶC BIỆT";
    $tiengiai = 10;
} else {
    $loaive = $_REQUEST['loaive'];
    if ($_REQUEST['loaigiai'] == "dacbiet"){
        $loaigiai = "GIẢI ĐẶC BIỆT";
        if ($loaive == 1000){
            $tiengiai = 50;
        }else{
            $tiengiai = 80;
        }
    } elseif($_REQUEST['loaigiai'] == "giainhat"){
        $loaigiai = "GIẢI NHẤT";
        if ($loaive == 1000){
            $tiengiai = 30;
        }else{
            $tiengiai = 50;
        }
    }elseif($_REQUEST['loaigiai'] == "giainhi"){
        $loaigiai = "GIẢI NHÌ";
        if ($loaive == 1000){
            $tiengiai = 20;
        }else{
            $tiengiai = 30;
        }
    }elseif($_REQUEST['loaigiai'] == "giaiba"){
        $loaigiai = "GIẢI BA";
        if ($loaive == 1000){
            $tiengiai = 10;
        }else{
            $tiengiai = 20;
        }
    }
}
if (isset($_REQUEST['maso'])){
    $maso = $_REQUEST['maso'];
    $sql = "SELECT * FROM KETQUA WHERE KETQUAQUAY = '$maso' AND LOAIVE = '$loaive'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $loaive = $row['LOAIVE'];
        $loaigiai = $row['KETQUAQUAY'];
        $tenkhachhang = $row['TENKHACHHANG'];
        $sdt = $row['SODIENTHOAI'];
    }
    $sql_khachhang = "SELECT * FROM KHACHHANG WHERE SODIENTHOAI= '$sdt'";
    $result_khachhang = $conn->query($sql_khachhang);
    if ($result_khachhang->num_rows > 0) {
        $row_khachhang = $result_khachhang->fetch_assoc();
        $diachi = $row_khachhang['DIACHI'];
    }
}


?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="web/css/common.css" />
    <link rel="stylesheet" type="text/css" href="web/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="web/css/tailwind.css" />




</head>

<body class="flex-column">

    <section class="check-result flex flex-col overflow-hidden bg-[rgb(30,158,4)]" style="max-height: 100vh;">
        <!-- Main section for presenting the award details and related content. -->
        <div class="mx-auto mt-7 mb-[107px] flex w-[92.97%] items-center gap-x-[9px] xl-max:justify-center">
            <div class="mb-0.5 flex w-[907px] min-w-0 flex-col">
                <div class="flex w-[71.11%] justify-between gap-x-2.5">
                    <img class="mt-[43px] w-[116px] min-w-0" src="web/assets/666322a6eb9db863d3314746466cd4b3.png" alt="alt text" />
                    <div class="relative mb-2 min-h-[159px] w-[378px] min-w-0">
                        <div class="absolute left-0 right-0 top-0 bottom-[-77px] flex h-[236px] w-[378px] flex-col"><img class="h-[236px] w-[378px]" src="web/assets/8d75d59cfadf452f7802a9406f8f5f4d.png" alt="alt text" /></div>
                    </div>
                </div>
                <div class="mx-auto mt-[9px] flex w-[74.75%] flex-col items-center">
                    <h1 class="font-Montserrat flex justify-center text-center text-[50px] font-bold leading-[1.22] text-white">QUAY SỐ “<?php echo $loaigiai; ?>”</h1>
                    <h1 class="font-Montserrat mt-0.5 flex justify-center text-center text-[35px] font-normal leading-[1.22] text-white">(Lượt quay cho vé <b> <?php echo " <pre> " . $loaive . " điểm" . "</pre>"; ?></b>)</h1>
                    <h1 class="font-Montserrat mt-1.5 flex justify-center text-center text-[50px] font-bold leading-[1.22] text-white">Mỗi giải <?php echo $tiengiai;?>.000.000 VND</h1>
                    <h1 class="font-Montserrat mt-[3px] flex justify-center text-center text-[50px] font-bold leading-[1.22] text-white">Số lượng: 01 giải</h1>
                </div>
                <div class="mt-2.5 flex flex-col gap-y-[15px]">
                    <div class="mr-px flex flex-col rounded-lg bg-[rgb(255,185,0)]">
                        <div class="mt-[27px] mb-4 ml-[34px] flex w-[79.25%] justify-between gap-x-2.5">
                            <form class="mt-2 flex w-[294px] min-w-0 flex-col gap-y-[11px]" action="" type="GET">
                                <div class="relative flex flex-col">
                                    <div class="relative min-h-[105px] rounded-[26px] bg-white shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]"></div>
                                    <input class="font-Montserrat absolute left-[42px] top-0 flex h-[122px] w-[210px] justify-center text-center text-[100px] font-extrabold leading-[1.22] text-[rgb(247,2,2)]" style="max-height: 100px; color: red;" name="maso">
                                </div>
                                <input type="text" name="loaive" value="<?php echo $loaive;?>" hidden>
                                <input type="text" name="loaigiai" value="<?php echo $_REQUEST['loaigiai'];?>" hidden>
                                <button class="font-Montserrat flex justify-center rounded-lg bg-[rgb(160,116,0)] pt-[3.5px] pr-2 pb-[3.5px] pl-2 text-center text-[24px] font-extrabold leading-[1.2] text-white shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-2 outline-offset-[-2px] outline-white">
                                    <!-- TODO -->
                                    XÁC NHẬN
                                </button>
                            </form>
                            <div class="mb-3.5 flex w-[369px] min-w-0 flex-col">
                                <h2 class="font-Actor mx-auto text-[24px] font-normal leading-[1.2] text-white">Xin chúc mừng !</h2>
                                <h2 class="font-Montserrat mt-2 text-[24px] font-black leading-[1.2] text-white" style="text-align: center;"><?php echo $tenkhachhang;?></h2>
                                <h2 class="font-Montserrat mx-[22px] mt-3.5 flex justify-end text-right text-[24px] font-black leading-[1.2] text-white" style="text-align: center;">SĐT: <?php echo $sdt;?></h2>
                                <h3 class="font-Montserrat mt-[13px] mr-px flex justify-center text-center text-[20px] font-medium leading-[1.2] text-white" style="text-align: center;"><?php echo $diachi;?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-x-3">
                        <a href="CheckResult.php?maso=&loaive=<?php echo $loaive?>&loaigiai=dacbiet"><div class="min-h-[54px] w-[218px] min-w-0 rounded-lg bg-[rgb(247,2,2)]"></div></a>
                        <a href="CheckResult.php?maso=&loaive=<?php echo $loaive?>&loaigiai=giainhat"><div class="min-h-[54px] w-[218px] min-w-0 rounded-lg bg-[rgb(255,185,0)]"></div></a>
                        <a href="CheckResult.php?maso=&loaive=<?php echo $loaive?>&loaigiai=giainhi"><div class="min-h-[54px] w-[217px] min-w-0 rounded-lg bg-[rgb(0,64,255)]"></div></a>
                        <a href="CheckResult.php?maso=&loaive=<?php echo $loaive?>&loaigiai=giaiba"><div class="min-h-[54px] w-[217px] min-w-0 rounded-lg bg-white"></div></a>
                    </div>
                </div>  
            </div>
            <div class="mt-[43px] flex w-[274px] min-w-0 flex-col gap-y-[17px]" >
                <div class="flex flex-col rounded-lg outline outline-[5px] outline-offset-[-5px] outline-white" style ="padding-bottom: 60vh;overflow:scroll;">
                    <p class="font-Montserrat mt-2.5 mr-[7px] mb-[529px] ml-3.5 text-[18px] font-bold leading-[1.22] text-white" style="margin-bottom: revert;">1). 299 - CỬA HÀNG VTNN ÁNH DUNG</p>
                    <p class="font-Montserrat mt-2.5 mr-[7px] mb-[529px] ml-3.5 text-[18px] font-bold leading-[1.22] text-white" style="margin-bottom: revert;" >1). 299 - CỬA HÀNG VTNN ÁNH DUNG</p>
                </div>
                
                <div class="ml-0.5 flex gap-x-0.5">
                    <a href="CheckResult.php?loaive=1000&loaigiai=<?php echo $_REQUEST['loaigiai'];?>"><img class="w-[135px] min-w-0" src="web/assets/b691ac608667e3c0f5c44c9bff3edd3e.svg" alt="alt text" /></a>
                    <a href="CheckResult.php?loaive=5000&loaigiai=<?php echo $_REQUEST['loaigiai'];?>"><img class="w-[135px] min-w-0" src="web/assets/b691ac608667e3c0f5c44c9bff3edd3e.svg" alt="alt text" /></a>
                </div>
            </div>
        </div>
    </section>


</body> 

</html>