<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Helpers\UploadTrait;

class Film extends Model {
	
	use UploadTrait;
	use LogsActivity;
	
	const UPLOAD_FOLDER_NAME = 'films';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'films';

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
	protected $fillable = ['name', 'date_release', 'description'];
	
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

	public function actors() {
		return $this->belongsToMany(Actor::class, 'film_actor');
	}
	
	public function verboseActors(): array {
		if ($this->actors->isEmpty()) {
			return [];
		}
		
		return $this->actors()->pluck('full_name')->all();
	}

	public function getDateReleaseAttribute($value) {
		return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d') : '';
	}
	
	public static function uploadPath() {
		return config('filesystems.upload_folder_name') . DIRECTORY_SEPARATOR . self::UPLOAD_FOLDER_NAME;
	}
	
	public static function validationRuls(): array {
		return [
			'name' => 'required|string',
			'image' => 'image|dimensions:min_width=100,max_width=200,min_height=100,max_height=200|max:1024',
			'date_release' => 'date',
			'description' => 'string|nullable',
		];
	}

}
