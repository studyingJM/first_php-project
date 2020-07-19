<?php
    include ("db.php");
    include ("lib.php");
    include (HOME . "/include/header.php");
    /*이미지 업로드한 순서*/
    $sql = "SELECT * FROM `boards` ORDER BY upload DESC LIMIT 0, 3";
    $list = fetchAll($db,$sql);
    $file = sub_str($list[0]->upload);
?>

<section class="mt-4">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <!--active 메인 으로 양옆을 넘어가게 해주는 역할-->
                    <div class="carousel-item active">
                         <!--list[0]번째는 무조건 main으로 들어가야 하기때문에 active안에 넣는다.-->
                        <?php if($list[0]->upload != "" && is_file("./".$file) == true): ?> <!--is_file : 파일이 존재하면 true 파일 없으면 false반환-->
                            <img src="<?=sub_str($list[0]->upload)?>" class="d-block w-100" width="100%" height="600px">
                        <?php else : ?>
                            <div style="text-align: center; height: 600px; background-color: #888;">
                                <h1 style="line-height: 600px;">사진이 없습니다.</h1>
                            </div>
                        <?php endif;?>
                    </div>
                    <!--서브메뉴 같은 느낌 -->
                    <?php for($i = 1; $i < 3; $i++) : ?>
                        <div class="carousel-item">
                            <?php if(sub_str($list[$i]->upload) != "" && is_file("./".sub_str($list[$i]->upload)) == true): ?>
                                <img src="<?=sub_str($list[$i]->upload)?>" class="d-block w-100" width="100%" height="600px">
                            <?php else : ?>
                                <div style="text-align: center; height: 600px; background-color: #888;">
                                    <h1 style="line-height: 600px;">사진이 없습니다.</h1>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endfor;?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
    include (HOME. "/include/footer.php");
?>              