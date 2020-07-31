<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Helpers\UploadTrait;

class Actor extends Model {
	
	use UploadTrait;
	use LogsActivity;
	
	const UPLOAD_FOLDER_NAME = 'actors';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actors';

	/**
	 * The database primary key value.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['full_name', 'date_birth'];

	/**
	 * Change activity log event description
	 *
	 * @param string $eventName
	 *
	 * @return string
	 */
	public function getDescriptionForEvent($eventName) {
		return __CLASS__ . " model has been {$eventName}";
	}

	public function films() {
		return $this->belongsToMany(Film::class, 'film_actor');
	}
	
	public function verboseFilms(): array {
		if ($this->films->isEmpty()) {
			return [];
		}
		
		return $this->films()->pluck('name')->all();
	}
	
	public function getDateBirthAttribute($value) {
		return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d') : '';
	}
	
	public static function uploadPath() {
		return config('filesystems.upload_folder_name') . DIRECTORY_SEPARATOR . self::UPLOAD_FOLDER_NAME;
	}
	
	public static function validationRuls(): array {
		return [
			'full_name' => 'required|string',
			'image' => 'image|dimensions:min_width=100,max_width=200,min_height=100,max_height=200|max:1024',
			'date_birth' => 'date',
		];
	}
}
