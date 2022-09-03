<?php

require('./parts/_header.php');

?>

<div class="main">
    <!-- 要素としては残しておきつつ隠す -->
    <button class="edit-wrapper" style="display:none">
        <p class="edit-button">プロフィールを変更する</p>
    </button>
    <div class="modal" style="display:none">
        <i class="fa-solid fa-circle-xmark close"></i>
        <form action="#" method="post" class="modal-form">
            <div class="post-header_logo_wrapper">
                <label class="post-header_logo img_wrap">
                    <img src=<?= $icon_karen_img ?> alt="" id="postHeaderLogo" class="post-header_logo" title="画像を選択">
                    <input type="file" name="iconImg" id="filesend" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
                </label>
                <div class="modal-text">
                    <textarea name="introText" placeholder="自己紹介をしよう"><?= $introduction ?></textarea>
                </div>
            </div>
            <button class="modal-button">保存する</button>
        </form>
    </div>
    <!-- 要素としては残しておきつつ隠す -->
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>40m</span></p>
        </div>
        <div class="post-body">
            <p>水族館のあるお店で夜ご飯を食べたよ！とてもきれいでおいしかったです。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>1h</span></p>
        </div>
        <div class="post-body">
            <p>神宮の花火が自分が見てきたのと違っていろんな種類の花火が見れず、スポンサーお膳立て花火ばっかだった。なんか違う</p>
            <a href="#">#想いの丈</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>2h</span></p>
        </div>
        <div class="post-body">
            <p>今日はVRの研究室で電波を発する銃を作りました。電気パッドで電気が流れてくるのがとても気持ちいいです。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
    <section class="post">
        <div class="post-header">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <p class="post-header_title">karen@Hyogo<span>4h</span></p>
        </div>
        <div class="post-body">
            <p>やっぱり作るものが決まるとやる気が出ますなぁ。ということで見た目だけSNS作ってみました。PHPとGitHubの復習も頑張りたいと思います。</p>
            <a href="#">#Good&New</a>
        </div>
        <div class="post-items">
            <i class="fa-solid fa-comment"></i>
            <i class="fa-solid fa-couch"></i>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </section>
</div>
<div class="create">
    <i class="fa-solid fa-plus"></i>
</div>
<div class="modal">
    <i class="fa-solid fa-circle-xmark close"></i>
    <form action="./index.php" method="post" class="modal-form">
        <div class="post-header_logo_wrapper">
            <img src=<?= $icon_karen_img ?> alt="" class="post-header_logo">
            <div class="modal-text">
                <textarea name="postText" placeholder="ここに記入してください"></textarea>
                <div class="hashTag_wrapper">
                    <select name="hashTag" class="hashTag">
                        <option>#good&new</option>
                        <option>#思いの丈</option>
                    </select>
                </div>
            </div>
        </div>
        <button class="modal-button">投稿</button>
    </form>
</div>
<div class="blackFilm"></div>


<?php

require('./parts/_footer.php');

?>