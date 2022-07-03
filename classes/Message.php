<?php
class Message
{
	public static $primary = 0;
	public static $secondary = 1;
	public static $success = 2;
	public static $danger = 3;
	public static $warning = 4;
	public static $info = 5;
	public static $light = 6;
	public static $dark = 7;


	public static function Show($message, $type = 3, $size = 75, $dataTarget = "", $isReturn = false)
	{
		if (!empty($message)) {

			$str = '<div class="row justify-content-center mt-1">';
			$str .= '<div class="offset-1 col-6">';

			switch ($type) {
				case 0:
					$alertType = "primary";
					break;

				case 1:
					$alertType = "secondary";
					break;

				case 2:
					$alertType = "success";
					break;

				case 3:
					$alertType = "warning";
					break;

				case 4:
					$alertType = "light";
					break;

				case 5:
					$alertType = "dark";
					break;

				case 5:
					$alertType = "danger";
					break;

				default:
					$alertType = "info";
					break;
			}


			$str .= '<div class="alert alert-' . $alertType . ' alert-dismissible fade show w-' . $size . '" role="alert">';
			// echo '<strong>' . ucwords($alertType) . '</strong></br>';
			$str .= '<div class="row">';
			$str .= '<div class="col-12">';
			$str .= $message . '  ';
			if (!empty($dataTarget)) {
				$str .= '<a href="#" class="alert-link" id="alertLink" data-toggle="modal" data-target="#' . $dataTarget . '">Click To Login</a>';
			}
			$str .= '</div>';
			$str .= '</div>';
			$str .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			$str .= '<span aria-hidden="true">&times;</span></button>';
			$str .= '</div></div></div>';

			if ($isReturn != false) {
				return $str;
			} else {
				echo $str;
			}
		}
	}
}
