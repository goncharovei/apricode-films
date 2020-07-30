<?php

namespace App\Helpers;

use Illuminate\Http\Request;

trait UploadTrait {

	abstract public function uploadPath(): string;

	public static function storeFileFromRequest(string $field_name, Request $request): string {
		if (empty($field_name)) {
			return '';
		}
		
		$file = $request->file($field_name);
		if (empty($file)) {
			return '';
		}
		
		$filename = $file->getClientOriginalName();
		$file->move(static::uploadPath(), $filename);
		
		return $filename;
	}

}
