<?php
/**
 * VideoFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * VideoFixture
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @package NetCommons\Videos\Test\Fixture
 */
class VideoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'KEY |  |  | ', 'charset' => 'utf8'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => 'block id |  ブロックID | blocks.id | '),
		'title' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'title | タイトル |  | ', 'charset' => 'utf8'),
		'mp4_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'mp4 id | MP4ファイルID |  | '),
		'mp4_file_size' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'mp4 file size | MP4ファイル容量 |  | '),
		'ogg_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'ogg id | OGGファイルID |  | '),
		'ogg_file_size' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'ogg file size | OGGファイル容量 |  | '),
		'thumbnail_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'thumbnail id | サムネイルファイルID |  | '),
		'video_time' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'video time | 動画時間 |  | '),
		'play_number' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'play number | 再生回数 |  | '),
		'comments_number' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'comment number | コメント数 |  | '),
		'likes_number' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'like number | 高く評価数 |  | '),
		'unlikes_number' => array('type' => 'integer', 'null' => false, 'default' => '0', 'comment' => 'unlike number | 低く評価数 |  | '),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'description | 説明 |  | ', 'charset' => 'utf8'),
		'is_auto_translated' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'translation type. 0:original , 1:auto translation | 翻訳タイプ  0:オリジナル、1:自動翻訳 |  | '),
		'translation_engine' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'translation engine | 翻訳エンジン |  | ', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況  1:公開中、2:公開申請中、3:下書き中、4:差し戻し |  | '),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created datetime | 作成日時 |  | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified datetime | 更新日時 |  | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_videos_blocks1_idx' => array('column' => 'block_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'key' => 'Lorem ipsum dolor sit amet',
			'block_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'mp4_id' => 1,
			'mp4_file_size' => 1,
			'ogg_id' => 1,
			'ogg_file_size' => 1,
			'thumbnail_id' => 1,
			'video_time' => 1,
			'play_number' => 1,
			'comments_number' => 1,
			'likes_number' => 1,
			'unlikes_number' => 1,
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'is_auto_translated' => 1,
			'translation_engine' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'created_user' => 1,
			'created' => '2015-03-17 06:34:44',
			'modified_user' => 1,
			'modified' => '2015-03-17 06:34:44'
		),
	);

}