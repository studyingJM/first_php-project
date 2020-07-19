<?php
include_once("db.php");
include_once("lib.php");
checkLogin(); //로그인검사하는 로직

$id = $_GET['id'];
$sql = "SELECT * FROM boards WHERE id = ?";

$board = fetch($db, $sql, [$id]);

if ($_SESSION['user']->id != $board->writer) {
    msgAndBack("너아니잖아 돌아가");
    exit;
}

include_once(HOME . "/include/header.php");
?>

<section class="mt-4">
    <div class="row my-5">
        <div class="col-10 offset-1">
            <h1>글 수정하기</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-10 offset-1">
            <form action="/updateProc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $board->id ?>">
                <div class="form-group">
                    <label for="title">제목</label>
                    <input type="text" name="title" id="title" placeholder="글 제목" class="form-control" maxlength="80" value="<?= $board->title ?>" >
                </div>

                <div class="form-group">
                    <label for="content">글 내용</label>
                    <textarea class="DOC_TEXT form-control" name="content" id="content" rows="8"><?= htmlentities($board->content) ?></textarea>
                    <span style="color:#aaa;" id="counter">(0 / 최대 200자)</span>
                </div>
                
                <div class="form-group">
                    <label for="file">업로드 파일</label>
                    <div><input type="file" class="form-control-file" name="pic" id="file"><?=sub_str($board->upload)?></div>
                </div>
                <button type="submit" class="btn btn-success">수정</button>
                <a href="delete.php?id=<?=$board->id?>" class="btn btn-outline-danger">삭제</a>
            </form>
        </div>
    </div>
</section>

<?php
include(HOME . "/include/footer.php");
?>