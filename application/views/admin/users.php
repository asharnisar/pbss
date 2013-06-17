<?php
	$this->load->view('admin/header');
	$this->load->view('admin/leftbar');
?>
        <div class="grid_10">
            <div class="box round first">
                <h2><?php echo $title;?></h2>
				<?php echo $output->output;?>
			</div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
<?php
	$this->load->view('admin/footer');
?>
