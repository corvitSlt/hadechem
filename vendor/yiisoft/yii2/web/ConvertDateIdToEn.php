<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\web;

use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * UploadedFile represents the information for an uploaded file.
 *
 * You can call [[getInstance()]] to retrieve the instance of an uploaded file,
 * and then use [[saveAs()]] to save it on the server.
 * You may also query other information about the file, including [[name]],
 * [[tempName]], [[type]], [[size]] and [[error]].
 *
 * For more details and usage information on UploadedFile, see the [guide article on handling uploads](guide:input-file-upload).
 *
 * @property string $baseName Original file base name. This property is read-only.
 * @property string $extension File extension. This property is read-only.
 * @property bool $hasError Whether there is an error with the uploaded file. Check [[error]] for detailed
 * error code information. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ConvertDateIdToEn extends BaseObject
{
     public static function convertDate($date, $format_in = 'j F Y', $format_out = 'Y-m-d') {
		// French to english month names
		$months_to_en = array(
			'januari' => 'january',
			'februari' => 'february',
			'maret' => 'march',
			'april' => 'april',
			'mei' => 'may',
			'juni' => 'june',
			'juli' => 'july',
			'agustus' => 'august',
			'september' => 'september',
			'oktober' => 'october',
			'november' => 'november',
			'desember' => 'december',
		);
		
		$day_to_en = array(
			'minggu' => 'sunday',
			'senin' => 'monday',
			'selasa' => 'tuesday',
			'rabu' => 'wednesday',
			'kamis' => 'thursday',
			'jumat' => 'friday',
			'sabtu' => 'saturday',
		);
		
		// List of available formats for date
		$formats_list = array('d','D','j','l','N','S','w','z','S','W','M','F','m','M','n','t','A','L','o','Y','y','H','a','A','B','g','G','h','H','i','s','u','v','F','e','I','O','P','T','Z','D','c','r','U');
		
		// We get separators between elements in $date, based on $format_in
		$split = str_split($format_in);
		$separators = array();
		$_continue = false;
		foreach($split as $k => $s) {
			if($_continue) {
				$_continue = false;
				continue;
			}
			// For escaped chars (like "\h")
			if($s == '\\' && isset($split[$k+1])) {
				$separators[] = '\\' . $split[$k+1];
				$_continue = true;
				continue;
			}
			if(!in_array($s, $formats_list)) {
				$separators[] = $s;
			}
		}
		
		// Translate month name
		$tmp = preg_split('/('.implode('|', array_map(function($v) {
			if($v == '/') {
				return '\/';
			}
			return str_replace('\\', '\\\\', $v);
		}, $separators)).')/', $date);
		
		foreach($tmp as $k => $v) {
			$v = mb_strtolower($v, 'UTF-8');
			if(isset($months_to_en[$v])) {
				$tmp[$k] = $months_to_en[$v];
			}
			else if(isset($day_to_en[$v])) {
				$tmp[$k] = $day_to_en[$v];
			}
		}
		// Re-construct the date
		$imploded = '';
		foreach($tmp as $k => $v) {
			$imploded .= $v . (isset($separators[$k]) ? str_replace('\\', '', $separators[$k]) : '');
		}
		
		return \DateTime::createFromFormat($format_in, $imploded)->format($format_out);
	}
}
