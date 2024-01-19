<?php
namespace ypmDataTable;
use \YpmAdminHelper as AdminHelper;

require_once dirname(__FILE__).'/Table.php';

class Subscribers extends YPMTable
{
	public function __construct()
	{
		global $wpdb;
		parent::__construct('');

		$this->setRowsPerPage(20);
		$this->setTablename($wpdb->prefix.YPM_SUBSCRIBERS_TABLE_NAME);
		$this->setColumns(array(
			$this->tablename.'.id',
			$this->tablename.'.email',
			$this->tablename.'.cDate',
			'postTitle'
		));
		$this->setDisplayColumns(array(
			'bulk'=>'<input class="subs-bulk" type="checkbox" autocomplete="off">',
			'id' => 'ID',
			'email' => __('Email', YPM_POPUP_TEXT_DOMAIN),
			'cDate' => __('Date', YPM_POPUP_TEXT_DOMAIN),
			'subscriptionType' => __('Subscription', YPM_POPUP_TEXT_DOMAIN),
			'view' => __('View', YPM_POPUP_TEXT_DOMAIN),
		));
		$this->setSortableColumns(array(
			'id' => array('id', false),
			'email' => array('email', true),
			'cDate' => array('cDate', true),
			'subscriptionType' => array('subscriptionType', true),
			$this->setInitialSort(array(
				'id' => 'DESC'
			))
		));
	}

	public function customizeRow(&$row)
	{
		$title = $row[3];
		if (empty($title)) {
			$title = __('(no title)', YPM_POPUP_TEXT_DOMAIN);
		}
		$id = $row[0];
		$contentPopup = $this->getPopupContent($row);
		$row[5] = "<button class='button view-subscription-details' data-id='".esc_attr($row[0])."'>View</button>".
		"<div style='height: 0px;width: 300px; visibility: hidden;display:flex;'>
			<div id='ypm-subscription-details-".esc_attr($id)."' style='width: 300px;' class='ycf-bootstrap-wrapper'>
				".wp_kses($contentPopup, \YpmAdminHelper::getAllowedTags())."
			</div>
		</div>";
		$row[4] = $title;
		$row[3] = AdminHelper::getFormattedDate($row[2]);
		$row[2] = $row[1];
		$row[1] = $row[0];
		$id = $row[0];
		$row[0] = '<input type="checkbox" name="ypm-delete-checkbox[]" value="'.esc_attr($id).'" class="ypm-delete-checkbox" data-delete-id="'.esc_attr($id).'">';
	}

	public function customizeQuery(&$query)
	{
		global $wpdb;
		$columns = $this->columns;
		array_pop($columns);
		$subscribersTableName = $wpdb->prefix . YPM_SUBSCRIBERS_TABLE_NAME;
		$postsTableName = $wpdb->prefix . 'posts';
		$query = 'SELECT '.implode(', ', $columns).', 
			'.esc_attr($postsTableName).'.post_title as postTitle,
			'.esc_attr($this->tablename).'.firstName,
			'.esc_attr($this->tablename).'.lastName
			from ' . esc_attr($subscribersTableName) . ' 
			LEFT JOIN ' . esc_attr($postsTableName) . ' ON ' . esc_attr($subscribersTableName) . '.formId = ' . esc_attr($postsTableName) . '.ID';
	}

	public function getPopupContent($row) {
		ob_start();
		?>
		<div class="row">
			<div class="col-md-12">
				<h3 style="margin-bottom: 25px;">Subscription details</h3>
			</div>
		</div><div class="row">
			<div class="col-md-6">
				<label>Email</label>
			</div>
			<div class="col-md-6">
				<span><?php echo esc_attr_e($row[1]);?></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>First name</label>
			</div>
			<div class="col-md-6">
				<span><?php echo esc_attr_e($row[5]);?></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label>Last name</label>
			</div>
			<div class="col-md-6">
				<span><?php echo esc_attr_e($row[5]);?></span>
			</div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
