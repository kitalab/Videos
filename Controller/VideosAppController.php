<?php
/**
 * VideosApp Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * VideosApp Controller
 *
 * @author Mitsuru Mutaguchi <mutaguchi@opensource-workshop.jp>
 * @package NetCommons\Videos\Controller
 * @property Category $Category
 * @property ContentComment $ContentComment
 * @property ContentCommentsComponent $ContentComments
 * @property DownloadComponent $Download
 * @property FileUploadComponent $FileUpload
 * @property MailSetting $MailSetting
 * @property NetCommonsComponent $NetCommons
 * @property WorkflowComponent $Workflow
 * @property PermissionComponent $Permission
 * @property PageLayoutComponent $PageLayout
 * @property Video $Video
 * @property VideoBlockSetting $VideoBlockSetting
 * @property VideoFrameSetting $VideoFrameSetting
 */
class VideosAppController extends AppController {

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'Pages.PageLayout',
		'Security',
	);
}
