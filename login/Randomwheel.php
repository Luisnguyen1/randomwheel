<?php include('setupDB.php'); ?>
<?php

if (isset($_REQUEST['phone'])) {
    if (!empty($_REQUEST['phone'])) {
        $sql = 'SELECT TENKHACHHANG, SOLOAIVE5000, SOLOAIVE1000 FROM KHACHHANG WHERE SODIENTHOAI = "' . $_REQUEST['phone'] . '"';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2>Chúc Mừng!</h2>
        <p>Bạn đã đăng nhập thành công!</p>
        <p>Xin chào <b>'.$row['TENKHACHHANG'].'</b></p>
        <button class="close-btn" onclick="closePopup()">Đóng</button>
    </div>';
        } else {
            echo '<div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
            <h2>Thông Báo!</h2>
            <p>Số điện thoại không tồn tại trong hệ thống!</p>
            <button class="close-btn" onclick="closePopup()">Đóng</button>
        </div>';
        }
    } else {
        echo '<div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
            <h2>Thông Báo!</h2>
            <p>Vui lòng nhập số điện thoại !</p>
            <button class="close-btn" onclick="closePopup()">Đóng</button>
        </div>';
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

    <style>
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
        }
    </style>


</head>

<body class="flex-column">

    <section class="randomwheel relative flex flex-col overflow-hidden bg-[rgb(252,247,247)]">
        <!-- This section contains the company information, including the logo, company name, and additional details. -->
        <img class="absolute left-[110px] top-8 aspect-[1.52] w-40 object-contain xxs-xxxl:left-[45%] xxs-xxxl:w-[159.92px] xxs-xxl:left-[44%] xxs-lg:left-[42%] xxs-lg:w-40 xxs-md:left-[38%] xxs-xs:left-[169px]" src="src/assets/5ea1457d59afbdf0a0906073f0fa2b59.png" alt="alt text" />
        <!-- Figure element displaying the company&#x27;s logo. -->
        <div class="relative mt-32 mb-[61px] ml-[9.5px] flex flex-col items-center gap-y-[143px]">
            <!-- Container for organizing flexible columns of content. -->
            <div class="flex w-full flex-col items-center">
                <!-- First flexible column containing company details. -->
                <div class="flex w-full flex-col items-center gap-y-[70px]">
                    <!-- Second flexible column containing company name and headings. -->
                    <div class="font-Montserrat text-sm font-bold tracking-[-0.24px] text-[rgb(0,165,81)]">
                        <!-- Displays the company&#x27;s legal name. -->
                        CÔNG TY TNHH KIÊN NAM
                    </div>
                    <div class="flex w-full flex-col gap-y-[26px]">
                        <!-- Third flexible column containing headings and buttons. -->
                        <h1 class="font-DancingScript flex w-full justify-center text-center text-[64px] font-normal leading-[0.31] tracking-[-0.24px] text-[rgb(255,225,0)]">
                            <!-- Main heading for the section indicating the main topic. -->
                            Vòng quay
                        </h1>
                        <h1 class="font-Montserrat mt-5 flex w-full justify-center text-center text-[30px] font-normal leading-[0.54] tracking-[-0.24px] text-[rgb(0,165,81)] bold">
                            <!-- Heading indicating the reward code information. -->
                            MÃ SỐ DỰ THƯỞNG
                        </h1>
                    </div>
                </div>
                <form action="" type="GET">
                    <div class="mt-[146px] flex w-[84.36%] flex-col gap-y-1">
                        <!-- Fourth flexible column containing additional contact information. -->
                        <div class="font-Montserrat flex justify-center text-center text-[12px] font-semibold leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">
                            <!-- Displays the phone number of the dealer. -->
                            Số điện thoại đại lý
                        </div>
                        <input type="text" name="phone" id="phone" placeholder="  Hãy nhập số điện thoại của bạn !" class="ml-px min-h-[38px] rounded-md bg-white outline outline-1 outline-offset-[-1px] outline-[rgb(0,165,81)]">
                    </div>
                    <!-- Formatting element for visual design. -->
                    <button class="font-Montserrat mt-9 mr-[35px] ml-[25.5px] flex w-80 max-w-full justify-center rounded-md bg-[rgb(0,165,81)] pt-[9px] pr-2 pb-[9px] pl-2 text-center text-[16px] font-bold leading-tight tracking-[-0.24px] text-white outline outline-1 outline-offset-[-1px] outline-[rgb(0,165,81)]">
                        <!-- Button for submitting the form. -->
                        NHẤN ĐỂ GỬI
                    </button>
                </form>
            </div>

            <p class="font-Montserrat mt-1 flex w-[84.1%] justify-center text-center text-[12px] font-semibold italic leading-[1.66] tracking-[-0.24px] text-[rgb(0,165,81)]">
                <!-- Note for customers reminding them to verify their information. -->
                Quý khách hàng vui lòng kiểm tra lại thông tin trước khi gửi !
            </p>
        </div>
        <p class="w-[84.1%]">
            <!-- Summary paragraph containing contact information for support. -->
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


    <script>
        // Hàm hiển thị pop-up
        function showPopup() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        }

        // Hàm đóng pop-up
        function closePopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }

        // Hiển thị pop-up sau khi tải trang
        window.onload = function() {
            showPopup();
        };
    </script>

</body>

</html>