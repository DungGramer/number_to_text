<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        html {
            font-family: 'Open Sans', sans-serif;
            font-size: 62.5%;
            font-weight: 500;
        }
        .container {
            display: block;
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(90deg, rgba(36,198,220,1) 0%, rgba(81,74,157,1) 100%);
        }
        .content {
            display: block;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 45vw;
            min-height: 50vh;
            margin: 0 auto;
            padding: 42px 55px 45px 55px;
            border-radius: 10px;
            background-color: #fff;
        }
        h1 {
            font-size: 2.5em;
            font-weight: 600;
            text-align: center;
        }
        form {
            position: absolute;
            top: 110px;
            left: 20%;
            width: 70%;
        }
        #text{
            font-size:1.8em;
            padding:10px 10px 10px 5px;
            display:block;
            width: 50%;
            border:none;
            border-bottom:1px solid #757575;
        }
        #text:focus {
            outline:none;
        }
        label {
            color:#999;
            font-size:1.5em;
            font-weight:normal;
            position:absolute;
            pointer-events:none;
            left:5px;
            top:10px;
            transition:0.2s ease all;
            -moz-transition:0.2s ease all;
            -webkit-transition:0.2s ease all;
        }
        #text:focus ~ label, #text:valid ~ label {
            top:-20px;
            font-size:1.4em;
            color:#5264AE;

        }
        .bar { position:relative; display:block; width:calc(50% + 15px); }
        .bar:before, .bar:after 	{
            content:'';
            height:2px;
            width:0;
            bottom:1px;
            position:absolute;
            background:#5264AE;
            transition:0.2s ease all;
            -moz-transition:0.2s ease all;
            -webkit-transition:0.2s ease all;
        }
        .bar:before {
            left:50%;
        }
        .bar:after {
            right:50%;
        }
        #text:focus ~ .bar:before, #text:focus ~ .bar:after {
            width:50%;
        }
        .highlight {
            position:absolute;
            height:60%;
            width:100px;
            top:25%;
            left:0;
            pointer-events:none;
            opacity:0.5;
        }
        #text:focus ~ .highlight {
            -webkit-animation:inputHighlighter 0.3s ease;
            -moz-animation:inputHighlighter 0.3s ease;
            animation:inputHighlighter 0.3s ease;
        }
        #submit {
            margin-top: 18px;
            padding: 6px;
            justify-content: center;
            align-items: center;
            background-color: #3b88bd;
            border-radius:28px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-size:17px;
            text-decoration:none;
            text-shadow:0px 1px 2px #3d3d7b;
            outline-color: transparent;
            border-style: none;
            width: 110px;
            height: 36px;
        }
        #submit:hover {
            background-color: rgba(59, 136, 189, 0.91);
        }

        #submit:active {
            position:relative;
            top:1px;
        }
        .result {
            position: absolute;
            font-size: 1.6em;
            top: 115px;
        }
        .result p:first-child {
            margin-bottom: 5px;
        }
        .result p {
            padding-top: 4px;
            /*margin-top: 5px;*/
        }
        .result--text {
            overflow: auto;
        }
    </style>
</head>
<body>
    <?php
        $number = 101010010200;
        $dic = [
            0 => "không",
            1 => "một",
            2 => "hai",
            3 => "ba",
            4 => "bốn",
            5 => "năm",
            6 => "sáu",
            7 => "bảy",
            8 => "tám",
            9 => "chín"
        ];
        function cutLast($num) {
            $array = array_map('intval', str_split($num)); //Chuyển number thành array
            $newNum = null;
            for($i = 0; $i < 3; $i++){
                $newNum .= array_pop($array);
            }
            return strrev($newNum);
        }
        function read3($num, $dic) {
            global $number;
            $num = strval($num);
            $num = str_pad($num, 3, 0, STR_PAD_LEFT);

            $digit_0    = substr($num, 2, 1);
            $digit_00   = substr($num, 1, 1);
            $digit_000  = substr($num, 0 ,1);

            $str_000 = $dic[$digit_000] . " trăm ";

            //0: linh; 1: mười; 2-9: 2-9 + mươi;
            $str_00 = $dic[$digit_00] . " mươi ";
            if ($digit_00 == 0) $str_00 = " linh ";
            if ($digit_00 == 1) $str_00 = " mười ";

            //1: mốt ? $digit_00 > 1; 5: lăm ? $digit_00 > 0
            $str_0 = $dic[$digit_0];
            if ($digit_00 > 1 && $digit_0 == 1) $str_0 = " mốt";
            if ($digit_00 > 0 && $digit_0 == 5) $str_0 = " lăm";

            if ($digit_00 == 0 && $digit_0 == 0 && $digit_000 == 0) {
                $str_0 = "";
                $str_00 = "";
                $str_000 = "";
            }
            if ($digit_00 == 0 && $digit_0 == 0) {
                $str_0 = "";
                $str_00 = "";
            }
            if ($digit_0 == 0){
                $str_0 = "";
            }
            if( $number >= 100){
                return $str_000 . $str_00 . $str_0;
            } elseif ($number >= 10 && $number<= 99){
                return $str_00 . $str_0;
            } elseif ($number <= 9) {
                return $str_0;
            }
        }
        function read3f($num, $dic) {
            $num = strval($num);
            $num = str_pad($num, 3, 0, STR_PAD_LEFT);

            $digit_0    = substr($num, 2, 1);    //(int)($number % 100);
            $digit_00   = substr($num, 1, 1);   // (int)($number % 100 / 10);
            $digit_000  = substr($num, 0 ,1);  // (int)($number / 100);

            $str_000 = $dic[$digit_000] . " trăm ";
            //0: linh; 1: mười; 2-9: 2-9 + mươi;
            $str_00 = $dic[$digit_00] . " mươi ";
            if ($digit_00 == 0) $str_00 = " linh ";
            if ($digit_00 == 1) $str_00 = " mười ";

            //1: mốt ? $digit_00 > 1; 5: lăm ? $digit_00 > 0
            $str_0 = $dic[$digit_0];
            if ($digit_00 > 1 && $digit_0 == 1) $str_0 = " mốt";
            if ($digit_00 > 0 && $digit_0 == 5) $str_0 = " lăm";

            if ($digit_00 == 0 && $digit_0 == 0) {
                $str_0 = "";
                $str_00 = "";
            }
            if ($digit_0 == 0){
                $str_0 = "";
            }
            if($num >= 100 && $num<= 999) {
                return $str_000 . $str_00 . $str_0;
            } elseif ($num >= 10 && $num<= 99){
                return $str_00 . $str_0;
            } else {
                return $str_0;
            }
        }
        function read6($num, $dic){
            global $number;
            $num = strval($num);
            $num = str_pad($num, 6, 0, STR_PAD_LEFT);
            if( $number >= 1000 && $number <= 999999) {
                return read3f(substr($num, 0, 3), $dic) . " nghìn " . read3(substr($num, 3, strlen($num) - 3), $dic);
            } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0){
                return read3(substr($num, 0, 3), $dic) . read3(substr($num, 3, strlen($num) - 3), $dic);
            } else {
                return read3(substr($num, 0, 3), $dic). " nghìn " . read3(substr($num, 3, strlen($num) - 3), $dic);
            }
        }
        function read9($num, $dic){
            global $number;
            $num = strval($num);
            $num = str_pad($num, 9, 0, STR_PAD_LEFT);
            if ($number >= 1000000 && $number <= 999999999) {
                return read3f(substr($num, 0, 3), $dic) . " triệu " . read6(substr($num, 3, strlen($num) - 3), $dic);
            } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0) {
                return read3(substr($num, 0, 3), $dic) . read6(substr($num, 3, strlen($num) - 3), $dic);
            }else {
                return read3(substr($num, 0, 3), $dic) . " triệu " . read6(substr($num, 3, strlen($num) - 3), $dic);
            }
        }
        function read12($num, $dic){
            global $number;
            $num = strval($num);
            $num = str_pad($num, 12, 0, STR_PAD_LEFT);
            if ($number >= 1000000000 && $number <= 999999999999) {
                return read3f(substr($num, 0, 3), $dic) . " tỷ " . read9(substr($num, 3, strlen($num) - 3), $dic);
            } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0) {
                return read3(substr($num, 0, 3), $dic) . read9(substr($num, 3, strlen($num) - 3), $dic);
            }else {
                return read3(substr($num, 0, 3), $dic) . " tỷ " . read9(substr($num, 3, strlen($num) - 3), $dic);
            }
        }
        function readNumber($num, $dic) {
            if ($num >= 1000000000 && $num <= 999999999999){
                return read12($num, $dic);
            }
            if ($num >= 1000000 && $num <= 999999999) {
                return read9($num, $dic);
            }
            if( $num >= 1000 && $num<= 999999){
                return read6($num, $dic);
            }
            if( $num >= 0 && $num <= 999){
                return read3f($num, $dic);
            }
        }
    ?>
    <div class="container">
        <div class="content">
            <h1>Chuyển Đổi Số Thành Chữ</h1>
            <form action="readnumberIndex.php" method="get">
                <div class="group">
                    <input type="text" name="number" id = "text"required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Nhập số</label>
                </div>
                <input type="submit" value="Chuyển đổi" id="submit">
                <?php
                echo "<div class='result'>";
                if($_GET["number"] >= 0 && $_GET["number"] <= 999999999999){

                    echo "<p>Kết quả: </p>";
                    echo "<p>" .$_GET["number"] . "<br /></p>";
                    echo "<p class='result--text'>" .readNumber($_GET["number"], $dic). "<br /></p>";

                } else {
                    echo "<p> Số này đếm không nổi! </p>";
                }
                echo "</div>";
                ?>
            </form>

        </div>
    </div>


</body>
</html>