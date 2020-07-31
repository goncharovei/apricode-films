<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Helpers\UploadTrait;

class Film extends Model {

	use UploadTrait;
	use LogsActivity;

	public const UPLOAD_FOLDER_NAME = 'films';
	public const PAGER_SETTINGS = [
		'cookie' => [
			'param_name' => 'films_pager_list_size',
			'expires' => 365,
		],
		'list_size' => [
			'default' => 10,
			'items' => [10, 25, 50, 100],
		]
	];

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
	/**
	 *  Related actors
	 * 
	 * @return type
	 */
	public function actors() {
		return $this->belongsToMany(Actor::class, 'film_actor');
	}
	/**
	 * The names of actors
	 * 
	 * @return array
	 */
	public function verboseActors(): array {
		if ($this->actors->isEmpty()) {
			return [];
		}

		return $this->actors()->pluck('full_name')->all();
	}
	/**
	 * Date release of film
	 * 
	 * @param type $value
	 * @return string
	 */
	public function getDateReleaseAttribute($value): string {
		return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d') : '';
	}
	/**
	 * The path of upload
	 * 
	 * @return string
	 */
	public static function uploadPath(): string {
		return config('filesystems.upload_folder_name') . DIRECTORY_SEPARATOR . self::UPLOAD_FOLDER_NAME;
	}
	/**
	 * The ruls of validation
	 * 
	 * @return array
	 */
	public static function validationRuls(): array {
		return [
			'name' => 'required|string',
			'image' => 'image|dimensions:min_width=100,max_width=200,min_height=100,max_height=200|max:1024',
			'date_release' => 'date|nullable',
			'description' => 'string|nullable',
		];
	}

}
