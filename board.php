<?php
include("db.php");
include("lib.php");
include(HOME . "/include/header.php");
$sql = "SELECT b.id, b.title,b.content,u.name,b.upload FROM `boards` AS b ,`users` AS u WHERE b.writer = u.id ORDER BY id DESC";
$list = fetchAll($db, $sql);
?>

<section>
    <div class="album py-5 bg-light container">
        <div class="row">
            <?php foreach ($list as $i => $board) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <?php if(sub_str($board->upload) != "" && is_file("./".sub_str($board->upload)) == true) : ?>
                            <img class="card-img-top" src="<?=sub_str($board->upload)?>" alt="Card image cap">
                        <?php else : ?>
                            <div style="text-align: center; height: 200px; background-color: #888;">
                                <h3 style="line-height: 200px;">사진이 없습니다.</h3>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="title">
                                <div><?= $board->title?></div>
                                <div><?=$board->name?></div>
                            </div>
                            <div class="text"><p><?= htmlentities($board->content) ?></p></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary pop" data-toggle="modal" data-target=".modal<?= $i ?>">View</button>
                                    <div class="modal fade modal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"><?=$board->title?></h5>
                                            </div>
                                            <div class="modal-body">
                                            <?php if(sub_str($board->upload) != "" && is_file("./".sub_str($board->upload)) == true) : ?>
                                                <img class="" src="<?=sub_str($board->upload)?>" alt="" width="100%" height="450px">
                                            <?php else : ?>
                                                <div style="text-align: center; height: 450px; background-color: #888;">
                                                        <h3 style="line-height: 450px;">사진이 없습니다.</h3>
                                                </div>
                                            <?php endif; ?>
                                                <p><?= htmlentities($board->content) ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <p>by : <?=$board->name?></p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <a href="update.php?id=<?=$board->id?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </div>
                                <small class="text-muted"><?= $board->id ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>

<?php
include(HOME . "/include/footer.php");
?>