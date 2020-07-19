<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>치킨이냐 돈이냐</title>
    <!--기본css 가져오기 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">

    <!--footer-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">치킨이다</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/board.php">게시판</a>
                        </li>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/write.php">글쓰기</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="account collapse navbar-collapse" id="navbarSupportedContent">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <div class="navbar-item ml-auto action-buttons">
                            <div class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Login</a>
                                <div class="dropdown-menu action-form">
                                    <form action="/loginProc.php" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="UserAccountID" id="id" name="id" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-block" value="Login">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Sign up</a>
                            <div class="dropdown-menu action-form">
                                <form action="/regProc.php" method="post">
                                    <p class="hint-text">회원가입을 하고 싶다면 하세요 <br /> -돈 안나가요-</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="UserAccountID" id="id" name="id"required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" id="name" name="name"required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="passck" name="passck" required="required">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Sign up">
                                </form>
                            </div>
                        </div>

                    <?php else : ?>
                        <div class="navbar-item ml-auto action-buttons">
                            <button class="btn btn-outline-success">
                                <?= $_SESSION['user']->name ?>님
                            </button>
                            <a class="btn btn-outline-danger" href="/logout.php">로그아웃</a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
        <?php if (isset($_SESSION['msg'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>메시지</strong> <?= $_SESSION['msg'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
                unset ($_SESSION['msg']);
            ?>
        <?php endif; ?>