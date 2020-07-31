<?php

namespace App\Helpers;

use Illuminate\Http\Request;

trait UploadTrait {

	abstract public function uploadPath(): string;
	
	public static function uploadPathFull(): string {
		$upload_path = static::uploadPath();
		return empty($upload_path) ? '' : public_path($upload_path);
	}
	
	public function storeFileFromRequest(string $field_name, Request $request) {
		$file = $request->file($field_name);
		if (empty($file)) {
			return;
		}
		
		if (!empty($this->$field_name)) {
			$this->deleteFile($field_name);
		}
		
		$filename = static::newFileName($file->getClientOriginalName());
		$file->move(static::uploadPathFull(), $filename);
		$this->$field_name = $filename;
		
		$this->save();
	}
	
	protected static function newFileName($old_filename)
    {
        $ts_part = uniqid();
        $fn = sha1($old_filename);
        // sha1 length is 40 symbols
        $fn_part = substr($fn, rand(0, 32), 8);
        $path_part = parse_url($old_filename, PHP_URL_PATH);
        // change file extension case to lower
        $ext = strtolower(pathinfo($path_part, PATHINFO_EXTENSION));

        return sprintf('%s_%s.%s', $ts_part, $fn_part, $ext);
    }
	
	public function deleteFile(string $field_name): int {
		$file_path = $this->verbosePath($field_name);
		
		return empty($file_path) ? -1 : (int)unlink($file_path);
	}
	
	public function verbosePath(string $field_name): string {
		if (empty($this->$field_name)) {
			return '';
		}
		
		$file_path = static::uploadPathFull() . DIRECTORY_SEPARATOR . $this->$field_name;
		return !file_exists($file_path) ? '' : $file_path;
	}
	
	public function verboseUrl(string $field_name): string {
		$file_path = $this->verbosePath($field_name);
		$upload_path = str_replace('\\', '/', static::uploadPath());
		
		return empty($file_path) ? '' : url($upload_path . '/' . $this->$field_name);
	}
}
