<?php
    if(isset($_GET['update']) && $_GET['update'] == 1){
        $url = 'https://api.devworksph.com/congress/members';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $curl_errno= curl_errno($ch);

        if($output !== false){
            if(isJson($output)){
                file_put_contents('./assets/json/data.json', $output);
            }
        }
    }
    $data = file_get_contents('./assets/json/data.json');
    $congress_json = json_decode($data);

function isJson($string) {
   json_decode($string);
   return json_last_error() === JSON_ERROR_NONE;
}
?>
<html>
    <head>
        <title>HOR</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            @font-face {
                font-family: 'Breul-Grotesk';
                font-weight: 400;
                src: url('./assets/fonts/Breul-Grotesk/Breul-Grotesk-Regular.ttf');
            }
            @font-face {
                font-family: 'Breul-Grotesk';
                font-weight: 700;
                src: url('./assets/fonts/Breul-Grotesk/Breul-Grotesk-Bold.otf');
            }
            @font-face {
                font-family: 'Andalus';
                font-weight: 400;
                src: url('./assets/fonts/Andalus/andlso.ttf');
            }
            @font-face {
                font-family: 'Aeroport';
                font-weight: 400;
                src: url('./assets/fonts/Aeroport/Aeroport Regular.otf');
            }
            @font-face {
                font-family: 'Aeroport';
                font-weight: 700;
                src: url('./assets/fonts/Aeroport/Aeroport Bold.otf');
            }
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            html, body {
                height: 100%;
            }
            body {
                background: url('<?php echo $congress_json->settings->background_img; ?>') right center no-repeat;
                background-size: cover;
                overflow: hidden;
            }

            .wrapper {
                /* position: absolute; */
                /* top: 100%; */
                /* left: 0; */
                /* right: 0; */
                min-height: 50vh;
                margin: auto;
                width: 95%;
                text-align: center;
                color: #fff;
                /* animation: credits 50s linear infinite; */
                font-family: 'Aeroport';
            }
            #title{
                position: relative;
                display: block;
                margin:  5vh auto 2vh 3vw;
            }
            .legislation_title{
                margin:  0 auto 0 3vw;
                /* position: sticky;
                top: 0; */
            }
            h1{
                margin: 0;
                margin-right: auto;
                font-size: 147px;
                font-weight: bold;
                line-height: 1.3;
                font-family: 'Andalus';
                color: #e6ba22;
                text-transform: uppercase;
            }
            h3{
                font-size: 110px;
                margin: 100px auto 100px;
                font-weight: 400;
            }
            .movie {
                margin-bottom: 50px;
                font-size: 50px;
            }

            .job {
                margin-bottom: 100px;
                line-height: 1.2;
                font-size: 85px;
            }
            .legislation{
                padding-bottom: 50vh;
                position: relative;
            }

            .name {
                margin-bottom: 5px;
                line-height: 1.2;
                text-transform: uppercase;
                font-size: 115px;
                font-weight: 700;
            }

            .building-bg{
                position: absolute;
                bottom: -20%;
                width: 45%;
                background: url('./assets/images/The_House_Building.png') center center no-repeat;
                background-size: cover;
                padding-top: 26%;
                left: 0;
                right: 0;
                margin: auto;
            }
            .house-logo{
                width: 9vw;
                margin: 6vh auto 1vh;
                height: 9vw;
                background: url('./assets/images/The_House_Official_Seal.png') center center no-repeat;
                background-size: cover;
            }
            .main-wrapper{
                width: 100%;
                height: 74vh;
                position: relative;
                overflow: hidden;
            }
            @media (max-width: 2000px){
                h1{
                    font-size: 50px;
                }
                .job {
                    font-size: 35px;
                    margin-bottom: 40px;
                }

                .name {
                    font-size: 55px;
                }
            }
            @media (max-width: 767px) {
                
                h1{
                    font-size: 50px;
                }
                .job {
                    font-size: 22px;
                    margin-bottom: 40px;
                }

                .name {
                    font-size: 25px;
                }
                .building-bg{
                    padding-top: 56%;
                    bottom: -30px;
                    width: 100%;
                }
                .house-logo{
                    width: 28vw;
                    margin: 9vh auto 1vh;
                    height: 28vw;
                }
            }

            #test{
                position: sticky;
                top: 10vh;
            }
            @keyframes credits {
                0% {
                    /* top: 100vh; */
                    transform: translateY(0%);
                }
                100% {
                    transform:  translateY(-150%);
                }
            }
        </style>
    </head>
    <body>
        <div id="title" style="margin-bottom: 0;">
            <h1><?php echo $congress_json->displayTitle; ?></h1>
            <h1 id="current_leg_period"></h1>
        </div>
        <div class="main-wrapper">
            <div class="contents">
                <?php 
                $ctr = 0;
                foreach($congress_json->congress as $congress){ ?> 
                    <?php if(!empty($congress->members)){ ?>
                        <h1 class="legislation_title" id="legislation_title_<?php echo $ctr; ?>"><?php echo $congress->legislative_period; ?></h1>
                        <div class="legislation">
                            <div class='wrapper'>
                                <?php 
                                if($congress->members){
                                    foreach($congress->members as $member){
                                        echo '<div class="name">'.$member->name.'</div>';
                                        echo '<div class="job">'. (!empty($member->province) ? $member->province . (!empty($member->district) ? ', ' . $member->district : '') : (!empty($member->party_list) ? $member->party_list . ' Party-List' : '')) .'</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php 
                $ctr++;
                } ?>
                <?php } ?>
            </div>
        </div>

        <script type="text/javascript" src="assets/js/jquery-3.7.1.min.js"></script>
        <script type="text/javascript">
            $(window).on('load', function() {
                var $container = $('.main-wrapper');
                var $content = $('.contents');
                var itemHeight = $content.children().first().outerHeight(); // Assuming all items have same height
                var scrollSpeed = 2; // Adjust as needed (milliseconds per scroll step)
                var scrollAmount = 1; // Adjust as needed (pixels per scroll step)
                // Clone items for seamless looping
                $content.children().clone().appendTo($content);
                var test = '';


                var titles = [];
                $('.legislation_title').each(function(i, e){
                    titles.push($(e).offset().top);
                });


                function startScrolling() {
                    test = setInterval(function() {
                        var currentScrollTop = $container.scrollTop();
                        var tolerance = $(window).height() * .4; 

                        var maxScrollTop = $content.outerHeight() / 2; // Half the content height (original + cloned)

                        if (currentScrollTop >= maxScrollTop) {
                            $container.scrollTop(0); // Reset to top
                            $('.legislation_title').removeClass('loaded');
                        } else {
                            $.each(titles, function(i, e){
                                var elementTop = e - $('.main-wrapper').offset().top;
                                if( (elementTop >= currentScrollTop && elementTop <= currentScrollTop + tolerance)){
                                    var $e = $("#legislation_title_" +i)
                                    if(!$e.hasClass('loaded')){
                                        $e.addClass('loaded');
                                        $("#current_leg_period").text($e.text());
                                    }
                                }
                            });

                            $container.scrollTop(currentScrollTop + scrollAmount);
                        }
                    }, scrollSpeed);
                }

                startScrolling();
            });
        </script>
    </body>
</html>