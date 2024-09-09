<?php include('setupDB.php'); ?>
<?php
if (isset($_REQUEST['phone'])) {
    if (!empty($_REQUEST['phone'])) {
        $sql = 'SELECT TENKHACHHANG, SOLOAIVE5000, SOLOAIVE1000 FROM KHACHHANG WHERE SODIENTHOAI = "' . $_REQUEST['phone'] . '"';
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $trangthai = 'yes';
        }

        $sql_spinnerData = 'SELECT * FROM soquay';
        $result_spinnerData = $conn->query($sql_spinnerData);

        $numbers = [];
        if ($result_spinnerData->num_rows > 0) {
            while ($row_spinnerData = $result_spinnerData->fetch_assoc()) {
                $numbers[] = (int)$row_spinnerData['SOCHUAQUAY'];
            }
        }
        $jsonNumbers = json_encode($numbers);
    } else {
        echo '<script> window.location.href="../login/randomwheel.php";</script>';
    }
} else {
    echo '<script> window.location.href="../login/randomwheel.php";</script>';
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

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .number-box {
            padding: 20px;
            background-color: #cc0000;
            /* Màu đỏ đậm */
            color: white;
            /* Màu chữ trắng */
            font-size: 60px;
            /* Kích thước chữ lớn hơn */
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            height: 100px;
            /* Chiều cao lớn hơn */
            width: 95%;
            /* Chiều rộng lớn hơn */

        }

        .number {
            position: absolute;
            width: 100%;
            text-align: center;
            /* Căn giữa chữ */
            transition: transform 0.3s ease;
            top: 50%;
            /* Căn giữa theo chiều dọc */
            left: 50%;
            /* Căn giữa theo chiều ngang */
            transform: translate(-50%, -50%);
            /* Đưa số lên giữa */
        }

        .selected {
            background-color: #4CAF50;
            /* Màu xanh */
            color: white;
            /* Màu chữ trắng */
        }

        .popup {
            display: none;
            /* Ẩn pop-up ban đầu */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            /* Màu xanh lá cây */
            color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }

        .overlay {
            display: none;
            /* Ẩn overlay ban đầu */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .close-btn {
            margin-top: 15px;
            background-color: white;
            color: #4CAF50;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 27%;
        }

        .center-text {
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            flex-wrap: wrap;
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>


</head>

<body class="flex-column">

    <section class="spiner relative flex h-[844px] min-h-[844px] flex-col overflow-hidden bg-white">
        <!-- Section containing information about the company and ticket options. -->
        <img class="xxs-sm:left-2/5 absolute left-[30%] top-8 w-40 xxs-xxxl:left-[46%] xxs-xxl:left-[45%] xxs-lg:left-[43%] xxs-md:left-[42%]" src="web/assets/427ddff977dab296c5d8e2b5ff9c956b.png" alt="alt text" />
        <div class="relative mt-32 mr-[15px] mb-[61px] ml-[29px] flex flex-col">
            <p class="font-Montserrat mx-auto text-sm font-bold tracking-[-0.24px] text-[rgb(0,165,81)]">CÔNG TY TNHH KIÊN NAM</p>
            <div class="number-box" id="numberBox">
                <div class="number" id="currentNumber">0</div>
            </div>
            <audio id="spinSound" src="src/assets/spinner-sound-36693.mp3"></audio>
            <div class="mt-3.5 mr-4 ml-[5px] flex justify-between gap-x-2.5 xxs-xxxl:justify-center xxs-lg:items-center xxs-lg:gap-x-5">
                <div class="font-Montserrat mb-2 min-w-0 text-[12px] font-semibold leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">Loại vé</div>
                <button class="font-Montserrat flex min-w-[115px] justify-center rounded-md bg-white pt-1 pr-4 pb-1 pl-4 text-center text-[12px] font-semibold leading-[1.66] tracking-[-0.64px] text-[rgb(0,165,81)] outline outline-1 outline-offset-[-1px] outline-[rgb(0,165,81)]" id="ve1000">
                    <!-- TODO -->
                    Vé 1000 điểm
                </button>
                <div class="my-1 flex w-[92px] min-w-0 gap-x-0.5">
                    <h3 class="font-Montserrat min-w-0 text-justify text-[20px] font-extrabold leading-none tracking-[-0.24px] text-[rgb(255,2,2)]"><?php echo $row['SOLOAIVE1000']; ?> </h3>
                    <div class="font-Montserrat min-w-0 text-justify text-[12px] font-semibold italic leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">lượt quay</div>
                </div>
            </div>
            <div class="mt-[18px] mr-4 ml-auto flex w-[71.1%] justify-between gap-x-2.5 xxs-xxxl:w-full xxs-xxxl:justify-center xxs-lg:gap-x-5">
                <button class="font-Montserrat flex min-w-[115px] justify-center rounded-md bg-white pt-1 pr-4 pb-1 pl-4 text-center text-[12px] font-semibold leading-[1.66] tracking-[-0.44px] text-[rgb(0,165,81)] outline outline-1 outline-offset-[-1px] outline-[rgb(0,165,81)]" id="ve5000">
                    <!-- TODO -->
                    Vé 5000 điểm
                </button>
                <div class="my-1 flex w-[92px] min-w-0 gap-x-0.5">
                    <h3 class="font-Montserrat min-w-0 text-justify text-[20px] font-extrabold leading-none tracking-[-0.24px] text-[rgb(255,2,2)]"><?php echo $row['SOLOAIVE5000']; ?> </h3>
                    <div class="font-Montserrat min-w-0 text-justify text-[12px] font-semibold italic leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">lượt quay</div>
                </div>
            </div>
            <p class="font-Montserrat mt-[25px] mr-5 ml-1.5 text-justify text-[12px] font-semibold italic leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">Quý khách hàng vui lòng tích vào loại vé trước khi nhấn quay !</p>
            <button class="font-Montserrat mt-[15px] mr-5 ml-1.5 flex justify-center rounded-md bg-[rgb(0,165,81)] pt-[9px] pr-2 pb-[9px] pl-2 text-center text-[16px] font-bold leading-tight tracking-[-0.24px] text-white outline outline-1 outline-offset-[-1px] outline-[rgb(0,165,81)]" id="randomButton">
                <!-- TODO -->
                NHẤN ĐỂ QUAY
            </button>
            <p class="mt-[15px] mr-5 ml-1.5">
                <span class="font-Montserrat text-justify text-[12px] font-medium leading-tight text-black">
                    <span class="font-medium">Mọi thắc mắc xin vui lòng liên hệ </span>
                    <span class="font-bold text-[rgb(0,165,81)]">Ms. Hue</span>
                    <span class="font-medium"> theo số điện thoại </span>
                    <span class="font-bold text-[rgb(0,165,81)] underline">0964 648 581</span>
                    <span class="font-medium"> để được hỗ trợ kịp thời !</span>
                </span>
            </p>
        </div>
    </section>
    <div class="overlay" id="overlay" style="display: none;"></div>
    <div class="popup" id="popup" style="display: none;">
        <h2>Xin thông báo !</h2>
        <p>Bạn đã <strong>HẾT</strong> vé này</p>
        <button class="close-btn" onclick="closePopup()">Đóng</button>
    </div>
    <script>
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('popup').style.display = 'none';
        // Danh sách số để quay
        // php array to javascript array
        const numbers = <?php echo $jsonNumbers; ?>;
        const currentNumber = document.getElementById('currentNumber');
        const randomButton = document.getElementById('randomButton');
        const spinSound = document.getElementById('spinSound');

        // Hàm hiển thị pop-up
        function showPopup(message) {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
            document.querySelector('#popup p').innerHTML = message; // Thay đổi nội dung thông báo
        }

        // Hàm đóng pop-up
        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }


        function getRandomNumber() {
            const randomIndex = Math.floor(Math.random() * numbers.length);
            return numbers[randomIndex];
        }

        let selectedTicket = null;

        document.getElementById('ve1000').addEventListener('click', () => {
            console.log(<?php echo $row['SOLOAIVE1000'] ?>);
            if (<?php echo $row['SOLOAIVE1000'] ?> > 0) {
                selectedTicket = '1000';
                document.getElementById('ve1000').classList.add('selected');
                document.getElementById('ve5000').classList.remove('selected');
                randomButton.disabled = false; // Kích hoạt nút quay
            } else {
                showPopup("Bạn đã <strong>HẾT</strong> vé 1000 điểm !");

            }
        });

        document.getElementById('ve5000').addEventListener('click', () => {
            console.log(<?php echo $row['SOLOAIVE5000'] ?>);
            if (<?php echo $row['SOLOAIVE5000'] ?> > 0) {

                selectedTicket = '5000';
                document.getElementById('ve5000').classList.add('selected');
                document.getElementById('ve1000').classList.remove('selected');
                randomButton.disabled = false; // Kích hoạt nút quay

            } else {
                showPopup("Bạn đã <strong>HẾT</strong> vé 5000 điểm !");

            }
        });

        randomButton.addEventListener('click', () => {
            if (!selectedTicket) {
                alert("Vui lòng chọn loại vé trước!");
                return;
            }
            spinSound.currentTime = 0;
            spinSound.play();

            let count = 0;
            const interval = setInterval(() => {
                const randomNum = Math.floor(Math.random() * 999);
                currentNumber.textContent = randomNum;

                currentNumber.style.transform = 'translate(-50%, -150%)';
                setTimeout(() => {
                    currentNumber.style.transform = 'translate(-50%, -50%)';
                }, 100);

                count++;
                if (count >= 30) {
                    clearInterval(interval);
                    const finalNumber = getRandomNumber();
                    currentNumber.textContent = finalNumber;
                    // Gửi lựa chọn vé qua URL
                    window.location.href = "spiner.php?phone=" + <?php echo json_encode($_REQUEST['phone']); ?> + "&maso=" + finalNumber + "&loaive=" + selectedTicket;
                }
            }, 100);
        });
        
    </script>

    <?php 
    
        if(isset($_REQUEST['loaive']) && isset($_REQUEST['maso'])){
            
            if (!empty($_REQUEST['loaive'])&&!empty($_REQUEST['maso'])) {
                $sql_ketqua = "INSERT INTO ketqua (SODIENTHOAI, LOAIVE, KETQUAQUAY, THOIGIANQUAY, tenkhachhang) VALUES('".$_REQUEST['phone']."','".$_REQUEST['loaive']."', ".$_REQUEST['maso'].", 'NOW()','".$row['TENKHACHHANG']."')";
                if ($conn->query($sql_ketqua) === TRUE) {
                    echo "<script>showPopup('Quay số thành công với số: <b>".$_REQUEST['maso']."</b>');</script>";
                } else {
                    echo "<script>showPopup('Quay số chưa thành công !');</script>";
                }
                if ( $_REQUEST['loaive'] == '1000'){
                    echo '<script>console.log("'.$row['TENKHACHHANG'].'")</script>';
                    $sql_update = "UPDATE khachhang SET SOLOAIVE1000 = ".$row['SOLOAIVE1000']." - 1 WHERE SODIENTHOAI = ".$_REQUEST['phone'];
                    if ($conn->query($sql_update) === TRUE) {
                        echo "<script>console.log('Update thành công !')</script>";
                    } else {
                        echo "<script>console.log('Update khoong thanh cong!')</script>";
                        echo "<script>console.log('".$conn->error."')</script>";
    
                    }
                }

                if ( $_REQUEST['loaive'] == '5000'){
                    $sql_update = "UPDATE khachhang SET SOLOAIVE5000 = ".$row['SOLOAIVE5000']." - 1 WHERE SODIENTHOAI = ".$row['SODIENTHOAI'];
                    if ($conn->query($sql_update) === TRUE) {
                        echo "<script>console.log('Update thành công !')</script>";
                    } else {
                        echo "<script>console.log('Update thành công !')</script>";
                        echo "<script>console.log('".$conn->error."')</script>";
    
                    }
                }
                
            }
        
        }
    ?>
</body>

</html>