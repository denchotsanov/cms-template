<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'User profile: '.$model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->email;
$directoryAsset = Url::to('@web');
?>
<script>
    window.user = <?php echo Json::htmlEncode($user); ?>;
    window.opts = <?php echo Json::htmlEncode(['items' => $modelAssigment->getItems()]); ?>;
</script>
<section ng-controller="UpdateUserController">
    <div class="row">
        <div class="col-sm-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-responsive img-circle" ng-src="{{user.avatar}}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{user.email}}</h3>
                        <p class="text-muted text-center">{{user.username}}</p>
                        <a ng-if="!user.blockedUser" href="#" ng-click="blockUser(user.id)" class="btn btn-danger btn-block "><b><?php echo Yii::t('admin', 'Block User'); ?></b></a>
                        <a ng-if="user.blockedUser" href="#" ng-click="blockUser(user.id)" class="btn btn-success btn-block "><b><?php echo Yii::t('admin', 'Restore User'); ?></b></a>
                        <a href="#" class="btn btn-primary btn-block "><b>Reset Password</b></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" ng-class="{'active' : openTab == 1 }" href="#" ng-click="openTab = 1">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" ng-class="{'active' : openTab == 2 }" href="#" ng-click="openTab = 2">Assigment</a></li>
                        <li class="nav-item"><a class="nav-link" ng-class="{'active' : openTab == 3 }" href="#" ng-click="openTab = 3">Settings</a></li>
                        <li class="nav-item"><a class="nav-link" ng-class="{'active' : openTab == 4 }" href="#" ng-click="openTab = 4">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" ng-class="{'active' : openTab == 5 }" href="#" ng-click="openTab = 5">Timeline</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="settings" ng-class="{'active' : openTab == 1 }">
                            <?php $form = ActiveForm::begin(); ?>
                                <?php echo $form->field($model, 'email')->textInput(['ng-model'=>'user.email']); ?>
                                <?php echo $form->field($model, 'username')->textInput(['ng-model'=>'user.name']); ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="avatar" ng-class="{'active' : openTab == 2 }">
                            <div class="assignment-index">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <input class="form-control search" data-target="available"
                                               placeholder="<?php echo Yii::t('admin', 'Search for available'); ?>">
                                        <br/>
                                        <select multiple size="20" class="form-control list" data-target="available"></select>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="move-buttons">
                                            <br><br>
                                            <?php echo Html::a('&gt;&gt;',  ['assign-assigment', 'id' => $modelAssigment->userId], [
                                                'class' => 'btn btn-success btn-assign',
                                                'data-target' => 'available',
                                                'title' => Yii::t('admin', 'Assign'),
                                            ]); ?>
                                            <br/><br/>
                                            <?php echo Html::a('&lt;&lt;',  ['remove-assigment', 'id' => $modelAssigment->userId], [
                                                'class' => 'btn btn-danger btn-assign',
                                                'data-target' => 'assigned',
                                                'title' => Yii::t('admin', 'Remove'),
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <input class="form-control search" data-target="assigned"
                                               placeholder="<?php echo Yii::t('admin', 'Search for assigned'); ?>">
                                        <br/>
                                        <select multiple size="20" class="form-control list" data-target="assigned"></select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="avatar1" ng-class="{'active' : openTab == 3 }"></div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="activity" ng-class="{'active' : openTab == 4 }" >
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user1-128x128.jpg" alt="user image">
                                    <span class="username">
                              <a href="#">Jonathan Burke Jr.</a>
                              <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                            </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>
                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                    </li>
                                    <li class="pull-right">
                                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                            (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user7-128x128.jpg" alt="User Image">
                                    <span class="username">
                              <a href="#">Sarah Ross</a>
                              <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                            </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                    <div class="form-group margin-bottom-none">
                                        <div class="col-sm-9">
                                            <input class="form-control input-sm" placeholder="Response">
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user6-128x128.jpg" alt="User Image">
                                    <span class="username">
                              <a href="#">Adam Jones</a>
                              <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                            </span>
                                    <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row margin-bottom">
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo1.png" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo2.png" alt="Photo">
                                                <br>
                                                <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo3.jpg" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo4.jpg" alt="Photo">
                                                <br>
                                                <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <ul class="list-inline">
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                                    </li>
                                    <li class="pull-right">
                                        <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                            (5)</a></li>
                                </ul>

                                <input class="form-control input-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline" ng-class="{'active' : openTab == 5 }">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                            <span class="bg-red">
                              10 Feb. 2014
                            </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                        <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-primary btn-xs">Read more</a>
                                            <a class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                            <span class="bg-green">
                              3 Jan. 2014
                            </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>