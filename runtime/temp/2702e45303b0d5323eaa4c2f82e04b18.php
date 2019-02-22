<?php /*a:1:{s:54:"D:\mf\pcnfc\application\open\view\manager\comment.html";i:1542936962;}*/ ?>
<?php if($list): foreach($list as $l): ?>
<div class="info-list-box">
    <div class="info-list-left">
        <div class="info-title"><a href="javascript:;""><?php echo htmlentities($l['title']); ?></a></div>
        <ul class="nav nav-pills info-label">
            <li><?php echo htmlentities($l['statusmsg']); ?></li>
            <li><?php echo htmlentities($l['typemsg']); ?></li>
            <li><?php echo htmlentities($l['channel']); ?></li>
            <li>阅读<span><?php echo htmlentities($l['view']); ?></span></li>
            <li>评论<span><?php echo htmlentities($l['comment']); ?></span></li>
            <li><?php echo htmlentities($l['create_time']); ?></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <?php if($l['comment']): ?>
    <h2>文章评论（共<span><?php echo htmlentities($l['comment']); ?></span>条）</h2>
    <?php foreach($l['comments'] as $c): ?>
    <div class="comment-list row">
        <div class="user-photo col-sm-1">
            <img src="<?php echo htmlentities($c['head_pic']); ?>" alt="<?php echo htmlentities($c['username']); ?>">
        </div>
        <div class="comment-cont col-sm-11">
            <p><span><?php echo htmlentities($c['nickname']); ?>：</span><?php echo htmlentities($c['content']); ?></p>
            <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($c['add_time'])? strtotime($c['add_time']) : $c['add_time'])); ?></div>
            <div class="reply-comment" onclick="replyMore(this)">回复</div>
            <div class="reply-more">
                <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($c['comment_id']); ?>" data-infoid="<?php echo htmlentities($c['goods_id']); ?>" id="<?php echo htmlentities($c['comment_id']); ?>" cols="30" rows="1"></textarea>
                <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if($c['comments']): foreach($c['comments'] as $co): ?>
            <div class="user-photo col-sm-1">
            </div>
            <div class="comment-cont col-sm-11">
                <p><span><?php echo htmlentities($co['nickname']); ?></span> 回复 <span><?php echo htmlentities($co['pnickname']); ?></span>：</span><?php echo htmlentities($co['content']); ?></p>
                <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($co['add_time'])? strtotime($co['add_time']) : $co['add_time'])); ?></div>
                <div class="reply-comment" onclick="replyMore(this)">回复</div>
                <div class="reply-more">
                    <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($co['comment_id']); ?>" data-infoid="<?php echo htmlentities($co['goods_id']); ?>" id="<?php echo htmlentities($co['comment_id']); ?>" cols="30" rows="1"></textarea>
                    <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php endforeach; endif; ?>
        <div class="comment-list-more row">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <button class="more-reply-btn" data-page="1" data-pid="1" data-infoid="<?php echo htmlentities($l['id']); ?>" onclick="infoGetComment(this)">展开更多对话</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="comment-list-more row">
        <div class="col-sm-12 text-center ">
            <button class="more-comment-btn" data-page="1" data-pid="0" data-infoid="<?php echo htmlentities($l['id']); ?>" onclick="infoGetComment(this)">展开更多评论</button>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endforeach; endif; if($comments): foreach($comments as $c): if($c['comments']): ?><div class="comment-list row"><?php endif; ?>
    <div class="user-photo col-sm-1">
        <?php if($c['comments']): ?><img src="<?php echo htmlentities($c['head_pic']); ?>" alt="<?php echo htmlentities($c['username']); ?>"><?php endif; ?>
    </div>
    <div class="comment-cont col-sm-11">
        <p><span><?php echo htmlentities($c['nickname']); ?>：</span><?php echo htmlentities($c['content']); ?></p>
        <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($c['add_time'])? strtotime($c['add_time']) : $c['add_time'])); ?></div>
        <div class="reply-comment" onclick="replyMore(this)">回复</div>
        <div class="reply-more">
            <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($c['comment_id']); ?>" data-infoid="<?php echo htmlentities($c['goods_id']); ?>" id="<?php echo htmlentities($c['comment_id']); ?>" cols="30" rows="1"></textarea>
            <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if($c['comments']): foreach($c['comments'] as $co): ?>
        <div class="user-photo col-sm-1">
        </div>
        <div class="comment-cont col-sm-11">
            <p><span><?php echo htmlentities($co['nickname']); ?></span> 回复 <span><?php echo htmlentities($co['pnickname']); ?></span>：</span><?php echo htmlentities($co['content']); ?></p>
            <div class="comment-time"><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($co['add_time'])? strtotime($co['add_time']) : $co['add_time'])); ?></div>
            <div class="reply-comment" onclick="replyMore(this)">回复</div>
            <div class="reply-more">
                <textarea class="form-control reply-text" name="" data-id="<?php echo htmlentities($co['comment_id']); ?>" data-infoid="<?php echo htmlentities($co['goods_id']); ?>" id="<?php echo htmlentities($co['comment_id']); ?>" cols="30" rows="1"></textarea>
                <button class="reply-btn btn  btn-default" onclick="infoAddComment(this)">提交</button>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php endforeach; endif; if($c['comments']): ?></div><?php endif; endforeach; endif; ?>
