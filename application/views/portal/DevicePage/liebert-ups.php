<?php if(isset($isMobile) && $isMobile){?>
<div class='row-fluid'>
	<div class='rt-data' data_type='liebert-ups'
		data_id='<?php echo $liebertUpsObj->data_id;?>'
		id='liebert-ups-<?php echo $liebertUpsObj->data_id;?>'>
		<h3><?php echo $liebertUpsObj->name;?></h3>
		<ul>
			<li><h5>
					设备状态：<span class="status">在线</span>
				</h5></li>
			<li><h5>
					更新时间：<span class="update_datetime" style='font-size: 20px;'><?php echo date('Y-m-d H:i:s');?></span>
				</h5></li>
		</ul>
<?php }else{?>
<div class="row-fluid ">
			<div class="span3">
				<div class="board-widgets orange small-widget">
					<div class="board-widgets-content">
						<span class="n-counter status">在线</span><span class="n-sources">设备状态</span>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="board-widgets blue small-widget">
					<div class="board-widgets-content">
						<span class="n-counter update_datetime" style='font-size: 20px;'><?php echo date('Y-m-d H:i:s');?></span><span
							class="n-sources">更新时间</span>
					</div>
				</div>
			</div>
		</div>
<?php }?>
<div class='row-fluid'>
			<div class="span6">
				<h4>设备性能指标</h4>
    <?php if($_SESSION['XJTELEDH_USERROLE'] == 'admin'){?>
    <p>
					<a
						href='<?php echo site_url('portal/dynamicSetting/'.$liebertUpsObj->data_id);?>'
						target="_blank" class="btn btn-info">动态设置</a>
					<button class='btn btn-info dev-info'
						data_id='<?php echo $liebertUpsObj->data_id;?>'
						model='<?php echo $liebertUpsObj->model;?>'>详细信息</button>
				</p>    
    <?php }?>
    </div>
			<table
				class="table table-bordered responsive table-striped table-sortable"
				id='tb-<?php echo $liebertUpsObj->data_id;?>-dc'>
				<thead>
					<tr>
						<th>序号</th>
						<th>变量名</th>
						<th>当前值</th>
						<th>告警级别</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<h4>UPS遥测量</h4>
		<table
			class="table table-bordered responsive table-striped table-sortable">
			<thead>
				<tr>
					<th>序号</th>
					<th>信号量</th>
					<th>当前值</th>
					<th>告警状态</th>
            <?php if((!isset($isMobile) || !$isMobile) && $_SESSION['XJTELEDH_USERROLE'] == 'admin'){?>
            <th>设置告警规则</th>
            <?php }?>
        </tr>
			</thead>
			<tbody>
    <?php foreach (Defines::$gLiebertUpsRemoteMesureParams as $key =>$val){?>
        <tr>
					<td><?php echo $key + 1;?></td>
					<td><?php echo $val;?></td>
					<td><span></span></td>
					<td><span></span></td>
            <?php if((!isset($isMobile) || !$isMobile) && $_SESSION['XJTELEDH_USERROLE'] == 'admin'){?>
            <td class="hasThreshold"><button
							data_id='<?php echo $liebertUpsObj->data_id;?>'
							field="a<?php echo $key;?>_value"
							class="btn btn-warning setThreshold">设置告警规则</button></td>
            <?php }?>
        </tr>
    <?php }?>
    </tbody>
		</table>

		<h4>UPS遥信量</h4>
		<table
			class="table table-bordered responsive table-striped table-sortable">
			<thead>
				<tr>
					<th>序号</th>
					<th>信号量</th>
					<th>当前值</th>
					<th>告警状态</th>         
            <?php if(!isset($isMobile) || !$isMobile){?>
            <th>设置告警规则</th>
            <?php }?>
        </tr>
			</thead>
			<tbody>
<?php

$index = 1;
foreach (Defines::$gLiebertUpsRemoteSignalParams as $key => $val) {
    if (strcmp($val, Defines::$gLiebertUpsRemoteSignalParams[0]) == 0)
        continue;
    ?>
    <tr
					id='liebert-ups-<?php echo $liebertUpsObj->data_id.'-field'.$key;?>'>
					<td><?php echo $index++;?></td>
					<td><?php echo $val?></td>
					<td><span></span></td>
					<td><span></span></td>
        <?php if(!isset($isMobile) || !$isMobile){?>
        <td class="hasThreshold"><button
							data_id='<?php echo $liebertUpsObj->data_id;?>'
							field="d_<?php echo $key;?>_value"
							class="btn btn-warning setThreshold">设置告警规则</button></td>
        <?php }?>
    </tr>
<?php }?>
    </tbody>
		</table>
<?php if(isset($isMobile) && $isMobile){?>
    </div>
</div>
<?php }?>
