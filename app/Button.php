<?php

namespace App;
use URL;
use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    	public static function Detail($id)
		{
			$url = URL::full();
			echo "<button type=\"submit\" class='btn btn-sm btn-secondary'>";
			echo 	"<i class='fas fa-info-circle'></i> ".trans('Detail');
			echo "</a>";
		}

		public static function Deleting($id)
		{
			echo "<button type=\"submit\" class='btn btn-sm btn-danger btn-delete' onclick='return confirm(\"確認刪除?\")'>";
			echo 	"<i class='fas fa-trash-alt'></i> ".trans('Delete');
			echo "</button>";
		}

		public static function Edit($id)
		{
			echo "<button type=\"submit\" class='btn btn-sm btn-success' formtarget='_blank'>";
			echo "<i class='fas fa-pencil-alt'></i> " . trans('Edit');
			echo "</button>";
		}

		public static function Create()
		{
			$url = URL::full();
			echo "<a class='btn btn-sm btn-primary' href='{$url}/create'>";
			echo 	"<i class='fas fa-plus'></i> ".trans('Create');
			echo "</a>";
		}

		public static function Reset()
		{
			echo "<p class='text-right'>";
			echo	"<a class='btn btn-sm btn-reset btn-danger' href='reset.php'>";
			echo		"<i class='fas fa-undo-alt'></i> ".trans('Reset');
			echo 	"</a>";
			echo "</p>";
		}

		public static function To($url=false,$to, $txt, $query="", $class="btn-secondary", $fas="list-ol", $confirm=false)
		{
			$url = $url?URL::full():'';
			if ($confirm == true) {
				$confirm = 'onclick="return confirm(\'確認刪除?\')"';
			}
			if ($url) {
				echo "<a class='btn btn-sm {$class}' href='{$url}/{$to}/{$query}' {$confirm}>";
			}
			else{
				echo "<a class='btn btn-sm {$class}' href='{$to}/{$query}' {$confirm}>";
			}
			echo 	"<i class='fas fa-{$fas}'></i> {$txt}";
			echo "</a>";
		}

		public static function GoBack($url = "#")
		{
			$target_url = ($url) ? $url: URL::previous();

			echo "<a class='btn btn-sm btn-default' href='{$target_url}'>";
			echo 	"<i class='fas fa-arrow-left'></i> ".trans('Previous');
			echo "</a>";
		}
}
