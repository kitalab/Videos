<?php
/**
 * VideoBlocksController::index()のPaginatorテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('BlocksControllerPaginatorTest', 'Blocks.TestSuite');

/**
 * VideoBlocksController::index()のPaginatorテスト
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @package NetCommons\Videos\Test\Case\Controller\VideoBlocksController
 */
class VideoBlocksControllerIndexPaginatorTest extends BlocksControllerPaginatorTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.videos.video',
		'plugin.videos.video_setting_for_paginator',
		'plugin.videos.block_setting_for_video',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'videos';

/**
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'video_blocks';

/**
 * Edit controller name
 *
 * @var string
 */
	protected $_editController = 'video_blocks';

}
