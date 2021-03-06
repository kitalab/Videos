<?php
/**
 * 権限設定 template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_BLOCK_INDEX); ?>

	<div class="tab-content">
		<?php echo $this->BlockTabs->block(BlockTabsHelper::BLOCK_TAB_PERMISSION); ?>

		<?php echo $this->BlockForm->displayEditForm(array(
			'model' => 'VideoBlockRolePermission',
			'callback' => 'Videos.VideoBlockRolePermissions/edit_form',
			'cancelUrl' => NetCommonsUrl::backToIndexUrl('default_setting_action'),
		)); ?>
	</div>
</div>
