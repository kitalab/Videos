<?php
/**
 * VideosEditController::edit()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowControllerEditTest', 'Workflow.TestSuite');

/**
 * VideosEditController::edit()のテスト
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @package NetCommons\Videos\Test\Case\Controller\VideosEditController
 */
class VideosEditControllerEditTest extends WorkflowControllerEditTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.videos.video',
		'plugin.videos.video_setting',
		'plugin.videos.block_setting_for_video',
		'plugin.videos.video_frame_setting',
		'plugin.likes.like',
		'plugin.likes.likes_user',
		'plugin.tags.tag',
		'plugin.tags.tags_content',
		'plugin.workflow.workflow_comment',
		'plugin.files.upload_file',
		'plugin.files.upload_files_content',
		'plugin.content_comments.content_comment',
		'plugin.categories.category',
		'plugin.categories.category_order',
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
	protected $_controller = 'videos_edit';

/**
 * テストDataの取得
 *
 * @param string $role ロール
 * @return array
 */
	private function __data($role = null) {
		$frameId = '6';
		$blockId = '2';
		$blockKey = 'block_1';
		if ($role === Role::ROOM_ROLE_KEY_GENERAL_USER) {
			$contentId = '3';
			$contentKey = 'content_key_2';
		} else {
			$contentId = '2';
			$contentKey = 'content_key_1';
		}

		$data = array(
			'save_' . WorkflowComponent::STATUS_IN_DRAFT => null,
			'Frame' => array(
				'id' => $frameId,
			),
			'Block' => array(
				'id' => $blockId,
				'key' => $blockKey,
				'language_id' => '2',
				'room_id' => '1',
				'plugin_key' => $this->plugin,
			),
			'Video' => array(
				'id' => $contentId,
				'key' => $contentKey,
				'block_id' => $blockId,
				'language_id' => '2',
				'status' => null,
				'title' => 'タイトル編集',
			),
			'WorkflowComment' => array(
				'comment' => 'WorkflowComment save test',
			),
		);

		return $data;
	}

/**
 * editアクションのGETテスト(ログインなし)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditGet() {
		$data = $this->__data();

		//テストデータ
		$results = array();
		// * ログインなし
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1'
			),
			'assert' => null, 'exception' => 'ForbiddenException'
		);

		return $results;
	}

/**
 * editアクションのGETテスト(作成権限のみ)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditGetByCreatable() {
		$data = $this->__data();

		//テストデータ
		// * 作成権限のみ
		$results = array();
		// ** 他人の記事
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1'
			),
			'assert' => null, 'exception' => 'BadRequestException'
		);
		// ** 自分の記事
		$results[1] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_2'
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);

		return $results;
	}

/**
 * editアクションのGETテスト(編集権限あり、公開権限なし)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditGetByEditable() {
		$data = $this->__data();

		//テストデータ
		// * 編集権限あり
		$results = array();
		// ** コンテンツあり
		//$base = 0;
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1'
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);

		// ** コンテンツなし
		$results[count($results)] = array(
			'urlOptions' => array(
				'frame_id' => '14',
				'block_id' => null,
				'key' => null
			),
			'assert' => array('method' => 'assertEquals', 'expected' => 'emptyRender'),
			'exception' => null, 'return' => 'viewFile'
		);

		return $results;
	}

/**
 * editアクションのGETテスト(公開権限あり)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditGetByPublishable() {
		$data = $this->__data();

		//テストデータ
		// * フレームID指定なしテスト
		$results = array();
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => null,
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1'
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);

		return $results;
	}

/**
 * editアクションのPOSTテスト用DataProvider
 *
 * ### 戻り値
 *  - data: 登録データ
 *  - role: ロール
 *  - urlOptions: URLオプション
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderEditPost() {
		$data = $this->__data();

		//テストデータ
		$results = array();
		// * ログインなし
		$contentKey = 'content_key_1';
		array_push($results, array(
			'data' => $data,
			'role' => null,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => $contentKey,
			),
			'exception' => 'ForbiddenException'
		));
		// * 作成権限のみ
		// ** 他人の記事
		$contentKey = 'content_key_1';
		array_push($results, array(
			'data' => $data,
			'role' => Role::ROOM_ROLE_KEY_GENERAL_USER,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => $contentKey,
			),
			'exception' => 'BadRequestException'
		));
		// ** 自分の記事
		$contentKey = 'content_key_2';
		array_push($results, array(
			'data' => $this->__data(Role::ROOM_ROLE_KEY_GENERAL_USER),
			'role' => Role::ROOM_ROLE_KEY_GENERAL_USER,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => $contentKey,
			),
		));
		// * 編集権限あり
		// ** コンテンツあり
		$contentKey = 'content_key_1';
		array_push($results, array(
			'data' => $data,
			'role' => Role::ROOM_ROLE_KEY_EDITOR,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => $contentKey,
			),
		));
		// ** フレームID指定なしテスト
		$contentKey = 'content_key_1';
		array_push($results, array(
			'data' => $data,
			'role' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'urlOptions' => array(
				'frame_id' => null,
				'block_id' => $data['Block']['id'],
				'key' => $contentKey,
			),
		));

		return $results;
	}

/**
 * editアクションのValidationErrorテスト用DataProvider
 *
 * ### 戻り値
 *  - data: 登録データ
 *  - urlOptions: URLオプション
 *  - validationError: バリデーションエラー
 *
 * @return array
 */
	public function dataProviderEditValidationError() {
		$data = $this->__data();
		$result = array(
			'data' => $data,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1',
			),
			'validationError' => array(),
		);

		//テストデータ
		$results = array();
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'Video.title',
				'value' => '',
				'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('videos', 'title'))
			)
		)));

		return $results;
	}

/**
 * Viewのアサーション
 *
 * @param array $data テストデータ
 * @return void
 */
	private function __assertEditGet($data) {
		//debug($this->view);

		$this->assertInput(
			'input', 'data[Video][block_id]', $data['Block']['id'], $this->view
		);
	}

/**
 * view(ctp)ファイルのテスト(公開権限なし)
 *
 * @return void
 */
	public function testViewFileByEditable() {
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_EDITOR);

		//テスト実行
		$data = $this->__data();
		$this->_testGetAction(
			array(
				'action' => 'edit',
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
				'key' => 'content_key_1',
			),
			array('method' => 'assertNotEmpty')
		);

		//チェック
		$this->__assertEditGet($data);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_IN_DRAFT, null, $this->view);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_APPROVED, null, $this->view);
		$this->assertNotRegExp('/<input.*?name="_method" value="DELETE".*?>/', $this->view);

		TestAuthGeneral::logout($this);
	}

/**
 * view(ctp)ファイルのテスト(公開権限なし) - FFMPEG=ON
 *
 * @return void
 */
	public function testViewFileByEditableFfmpegOn() {
		$this->controller->Video->isFfmpegEnable = true;
		$this->testViewFileByEditable();
	}

/**
 * view(ctp)ファイルのテスト(公開権限なし) - FFMPEG=OFF
 *
 * @return void
 */
	public function testViewFileByEditableFfmpegOff() {
		$this->controller->Video->isFfmpegEnable = false;
		$this->testViewFileByEditable();
	}

/**
 * view(ctp)ファイルのテスト(公開権限あり)
 *
 * @return void
 */
	public function testViewFileByPublishable() {
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$data = $this->__data();
		$urlOptions = array(
			'action' => 'edit',
			'block_id' => $data['Block']['id'],
			'frame_id' => $data['Frame']['id'],
			'key' => 'content_key_1',
		);
		$this->_testGetAction($urlOptions, array('method' => 'assertNotEmpty'));

		//チェック
		$this->__assertEditGet($data);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_IN_DRAFT, null, $this->view);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_PUBLISHED, null, $this->view);
		$this->assertInput('input', '_method', 'DELETE', $this->view);

		//debug($this->view);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

}
