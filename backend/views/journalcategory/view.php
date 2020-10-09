<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        List Journal of Category <?php echo $model->journal_category_name; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Blog</a></li>
        <li><a href="#">Journal Author</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
                <div class="box-body">
                    <table id="data-grid" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="5%">Journal Title</th>
                                <th width="1%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $journal = \backend\models\JournalDetailCategory::find()->where(['journal_category_id' => $model->journal_category_id])->all();
                            foreach ($journal as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->journalDetail->journal_detail_title; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" onclick="javascript:location.href='../../journal/view/<?php echo $row->journalDetail->journal->journal_id; ?>'"><i class="fa fa-fw fa-eye"></i> View</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="../../journal/update/<?php echo $row->journalDetail->journal->journal_id; ?>"><i class="fa fa-fw fa-pencil"></i> Update</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
